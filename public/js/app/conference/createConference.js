var loadedJson;

function loadDateTimePicker() {
    $('#datetimepickerBegin').datetimepicker({useCurrent: false, pickTime: false, pickDate: true});
    $('#datetimepickerEnd').datetimepicker({useCurrent: false, pickTime: false, pickDate: true});
    $('#datetimepickerCutOffDate').datetimepicker({useCurrent: false, pickTime: true, pickDate: true});
    $("#datetimepickerBegin").on("dp.hide", function (e) {
        $('#datetimepickerEnd').data("DateTimePicker").setMinDate(e.date);
        $('#datetimepickerEnd').data("DateTimePicker").setViewDate(e.date);
        $('#datetimepickerCutOffDate').data("DateTimePicker").setMinDate(e.date);
        $('#datetimepickerCutOffDate').data("DateTimePicker").setViewDate(e.date);
    });
    $("#datetimepickerEnd").on("dp.change", function (e) {
        $('#datetimepickerBegin').data("DateTimePicker").setMaxDate(e.date);
    });
}

function loadVenueDropDownListAction() {
    $("#ddlVenue").off('change').on('change', function (event, item) {
        var field = $(this).attr('name');
        $('#frmCreateConf').formValidation('revalidateField', field);
        var _rentalCost = $(this).find('option:selected').data('rental_cost');
        var end = $('#datetimepickerEnd').data("DateTimePicker").getDate();
        var start = $('#datetimepickerBegin').data("DateTimePicker").getDate();

        $('#price').val('S$ ' + _rentalCost);
        $('#quantity').val(end.diff(start, 'days'));
        $('#total').val('S$ ' + (_rentalCost * end.diff(start, 'days')));
    });
}

function loadPayNowbutton(createInvoiceUrl) {

    $('#btnPayNow').off('click').on('click', function (evt) {

        evt.preventDefault();
        $('#modalMessage').html('Making Payment...');
        $('#resultModal').modal('show');

        Stripe.card.createToken($('#billing-form'), function (status, response) {
            var $form = $('#billing-form');
            if (response.error) {
                // Show the errors on the form
                $form.find('.payment-errors').text(response.error.message);
                $form.find('button').prop('disabled', false);
            } else {
                // token contains id, last4, and card type
                var token = response.id;
                // Insert the token into the form so it gets submitted to the server
                $form.append($('<input type="hidden" name="stripeToken" />').val(token))

                //create the conference first
                // if the conference created, then create the invoice

                $.post(createInvoiceUrl, '', function (createInvoiceResult) {
                    console.log('==========     Create Invoice    ==========');
                    console.log(createInvoiceResult);
                    if (createInvoiceResult.createResult) {
                        // charge user to the card
                        var $billingForm = $('#billing-form');

                        // append invoice id to the create conference page
                        $('#frmCreateConf').append($('<input type="hidden" name="invoice_id" />').val(createInvoiceResult.invoiceId));
                        $billingForm.append($('<input type="hidden" name="invoice_id" />').val(createInvoiceResult.invoiceId));

                        $.post($billingForm.attr('action'), $billingForm.serialize(), function (createPaymentResult) {
                            console.log('==========     Charge Credit Card    ==========');
                            console.log(createPaymentResult);
                            $('#modalMessage').html('Payment made, creating confernece...');
                            setTimeout(function () {
                                postToCreateConference($('#frmCreateConf'));
                            }, 200);

                        });
                    }
                });
            }
        });
    });
}


function loadFormValidation(availableRoomsUrl) {
    $('#frmCreateConf').formValidation({
        err: {
            container: 'tooltip'
        },
        icon: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
            conferenceTitle: {
                validators: {
                    notEmpty: {
                        message: 'The Conference Title is required'
                    },
                    stringLength: {
                        min: 6,
                        max: 30,
                        message: 'The Conference Title must be more than 6 and less than 30 characters long'
                    },
                    regexp: {
                        regexp: /^[a-zA-Z0-9 ]+$/,
                        message: 'The Conference Title can only consist of alphabetical, number, and space'
                    },
                    remote: {
                        message: 'The Conference Title is not available',
                        url: 'validateConference',
                        type: 'POST'
                    }
                }
            },
            'chkField[]': {
                validators: {
                    choice: {
                        min: 2,
                        max: 4,
                        message: 'Please choose 2 - 4 interest field'
                    }
                }
            },
            beginDate: {
                validators: {
                    notEmpty: {
                        message: 'The Begin Date is required'
                    }, date: {
                        format: 'DD-MM-YYYY',
                        message: 'The value is not a valid date'
                    }
                }
            },
            endDate: {
                validators: {
                    notEmpty: {
                        message: 'The End Date is required'
                    }, date: {
                        format: 'DD-MM-YYYY',
                        message: 'The value is not a valid date'
                    }
                }
            },
            cutOffDate: {
                validators: {
                    date: {
                        format: 'DD-MM-YYYY HH:mm',
                        message: 'The value is not a valid datetime'
                    }
                }
            },
            minScore: {
                validators: {
                    numeric: {
                        separator: '.',
                        message: 'The value is not a valid numeric'
                    }
                }
            },
            maxSeats: {
                validators: {
                    notEmpty: {
                        message: 'The Max Seats is required'
                    }, integer: {
                        message: 'This value must be integer'
                    }, greaterThan: {
                        inclusive: false,
                        value: 0.0,
                        message: 'This value must be greater than zero'
                    }
                }
            },
            venue: {
                validators: {
                    notEmpty: {
                        message: 'Please select one venue'
                    }, greaterThan: {
                        inclusive: false,
                        value: 0.0,
                        message: 'This value must be greater than zero'
                    }
                }
            }
        }
    }).on('err.field.fv err.validator.fv success.validator.fv', function (e, data) {
        if (data.fv.getSubmitButton()) {
            data.fv.disableSubmitButtons(false);
        }
    }).on('success.field.fv', function (e, data) {

        if (data.fv._cacheFields.beginDate.val() !== '' && data.fv._cacheFields.endDate.val() !== ''
                && data.fv._cacheFields.maxSeats.val() !== '') {
            loadVenueIntoDropDownBox(availableRoomsUrl);
        }

        if (data.fv.getSubmitButton()) {
            data.fv.disableSubmitButtons(false);
        }
    }).on('success.form.fv', function (e, data) {
        // Prevent form submission         
        e.preventDefault();
        //** show the modal of the payment
        $('#paymentPanel').modal({
            keyboard: false
            , backdrop: 'static'
            , show: true});

    }).find('input[name="chkField[]"]').iCheck({
        checkboxClass: 'icheckbox_square-green'
    }
    ).on('ifChanged', function (e) {
        // Called when the radios/checkboxes are changed
        // Get the field name
        var field = $(this).attr('name');
        $('#frmCreateConf').formValidation('revalidateField', field);
    });
}

function postToCreateConference(theTarget) {
    // Get the form instance
    var $form = $(theTarget);
    // Get the FormValidation instance
    var bv = $form.data('formValidation');

    $('#resultModal').modal({
        keyboard: false
        , backdrop: 'static'});
    // Use Ajax to submit form data
    $.post($form.attr('action'), $form.serialize(), function (result) {
        // ... Process the result ...
        var message = '';
        if (result.success !== undefined) {
            message += 'Conference created. Redirecting to detail page ...';
        } else if (result.invalidFields !== undefined) {
            $.each(result.invalidFields, function (key, value) {
                message += '<p>' + key + ':' + value + '</p>';
            });
        } else {
            message = 'Unknown error occurred. Please contact System Administrator.'
        }
        $('#modalMessage').html(message);
        $('#resultModal').modal('show');
        if (result !== undefined && result.success) {
            setTimeout(function () {
                if (result.success !== undefined) {
                    window.location.href = '../detail?conf_id=' + result.success.createdConf.conf_id;
                } else {
                    $('#resultModal').modal('hide');
                }
            }, 1000);

        }
    }, 'json').fail(function () {

        var message = 'System fatal error, please contact your System Administrator ...';
        $('#resultModal').modal({
            keyboard: false
            , backdrop: 'static'});
        $('#modalMessage').html(message);
        setTimeout(function () {
            $('#resultModal').modal('hide');
        }, 1000);
        return undefined;
    }).always(function () {

    });

}

function loadVenueIntoDropDownBox(availableRoomsUrl) {

    var beginDate = $("#datetimepickerBegin").data("DateTimePicker").getDate().format('DD-MM-YYYY');
    var endDate = $("#datetimepickerEnd").data("DateTimePicker").getDate().format('DD-MM-YYYY');
    var maxSeats = $("#maxSeats").val();
    if (beginDate !== undefined && endDate !== undefined) {
        $.ajax({
            type: "GET",
            url: availableRoomsUrl,
            data: {date_start: beginDate, date_end: endDate, max_seats: maxSeats}
        }).done(function (data) {
            var canload = false;
            if (loadedJson === undefined) {
                canload = true;
            } else {
                canload = (JSON.stringify(loadedJson) !== JSON.stringify(data));
            }
            if (canload) {
                loadedJson = data;
                $("#ddlVenue").empty();
                $("#ddlVenue").append($("<option></option>").val(-1).html('-- Please Select --'));
                $.each(data, function (key, value) {
                    var $_option = $("<option></option>").val(value.room_id).html(value.room_name + '(S$ ' + value.rental_cost + '/day)');
                    $_option.data('rental_cost', value.rental_cost);
                    $("#ddlVenue").append($_option);
                });
            }
        }).fail(function (xhr, stat, msg) {
            alert(xhr.responseText);
        }).always(function (data) {

        });
    }
}