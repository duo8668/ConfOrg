var loadedJson;

function loadDateTimePicker(_minDate, _cutOffDays,_offSetDays) {
    var minConfDate = new moment(_minDate).add(_offSetDays,'day'); 

    $('#datetimepickerBegin').datetimepicker({useCurrent: false, pickTime: false, pickDate: true, minDate:minConfDate });
    $('#datetimepickerEnd').datetimepicker({useCurrent: false, pickTime: false, pickDate: true, minDate:minConfDate });
    $('#datetimepickerCutOffDate').datetimepicker({useCurrent: false, pickTime: true, pickDate: true, minDate:_minDate});

    $('#datetimepickerBegin').data("DateTimePicker").setViewDate(minConfDate);
    $('#datetimepickerEnd').data("DateTimePicker").setViewDate(minConfDate);
    $('#datetimepickerCutOffDate').data("DateTimePicker").setViewDate(_minDate);
    $('#datetimepickerCutOffDate').data("DateTimePicker").setMinDate(new moment(_minDate.add(1,'day').toArray()).add(-1,'minute'));
    $("#datetimepickerBegin").on("dp.hide", function (e) {
        $('#datetimepickerEnd').data("DateTimePicker").setMinDate(e.date);
        $('#datetimepickerEnd').data("DateTimePicker").setViewDate(e.date);

        $('#datetimepickerCutOffDate').data("DateTimePicker").setViewDate(new moment(e.date.add(1,'day').toArray()).add(-1,'minute'));
        $('#frmCreateConf').formValidation('revalidateField','beginDate');
    });
    $("#datetimepickerEnd").on("dp.change", function (e) {
        $('#datetimepickerCutOffDate').data("DateTimePicker").setMaxDate(new moment(e.date.toArray().slice(0, 3)).subtract(_cutOffDays, 'day'));
        $('#datetimepickerBegin').data("DateTimePicker").setMaxDate(e.date);
        $('#frmCreateConf').formValidation('revalidateField','endDate');
    });
}

function loadVenueDropDownListAction() {

    $("#ddlVenue").selectBoxIt({
        showEffect: "fadeIn",
        showEffectSpeed: 220,
        hideEffect: "fadeOut",
        hideEffectSpeed: 110 ,
        showFirstOption : true
    });

    $("#ddlVenue").off('change').on('change', function (event, item) {
        var field = $(this).attr('name');
        $('#frmCreateConf').formValidation('revalidateField', 'venue');
        //$('#frmCreateConf').formValidation('disableSubmitButtons',false);
        
        var _rentalCost = $(this).find('option:selected').data('rental_cost');
        var end = $('#datetimepickerEnd').data("DateTimePicker").getDate();
        var start = $('#datetimepickerBegin').data("DateTimePicker").getDate();
        var days = end.add(1,'day').diff(start, 'days');

        $('#price').val('S$ ' + _rentalCost);
        $('#quantity').val(days);
        $('#total').val('S$ ' + (_rentalCost * days));
    });

    $('.venueContainer').width($('#ddlVenueSelectBoxItContainer').width());
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
                setTimeout(function () {
                    $('#resultModal').modal('hide');
                }, 350);
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
        excluded: [''],
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
                   callback: {
                    message: 'Please select a venue',
                    callback: function(value, validator, $field) {
                            // Get the selected options
                            return  value !== null &&  value > 0;
                        }
                    }
                }
            }
        }
    }).on('status.field.fv',function(e,data){

        if(data.status === 'VALID'){
            $(e.delegateTarget).formValidation('disableSubmitButtons',false);
        }

    }).on('err.form.fv', function(e) {

        $(e.target).data('formValidation').disableSubmitButtons(false);

    }).on('err.field.fv', function (e, data) {
        if (data.fv.getSubmitButton()) {
            data.fv.disableSubmitButtons(false);
        }
    }).on('success.field.fv', function (e, data) {
        if (data.fv.getSubmitButton()) {
            data.fv.disableSubmitButtons(false);
        }
        if (data.fv._cacheFields.beginDate.val() !== '' && data.fv._cacheFields.endDate.val() !== '' && data.fv._cacheFields.maxSeats.val() !== '') {
            if(data.field !== 'venue')
                loadVenueIntoDropDownBox(availableRoomsUrl);
        }else if(data.fv._cacheFields.beginDate.val() === '' || data.fv._cacheFields.endDate.val() === '' || data.fv._cacheFields.maxSeats.val() === ''){
            //$("#ddlVenue").data("selectBox-selectBoxIt").remove();
            //$("#ddlVenue").data("selectBox-selectBoxIt").disable();
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

                console.log(data);

                var curGroup = '', _optgroup = null;
                $("#ddlVenue").empty();
                $("#ddlVenue").append($("<option></option>").val(-1).html('-- Please Select Your Venue --'));
                $.each(data, function (key, value) {

                    if(_optgroup === null){
                        _optgroup = $('<optgroup>');                        
                        _optgroup.attr('label',value.venue_name);
                        curGroup = value.venue_name; 
                    }else{
                        if(curGroup !== value.venue_name){
                            if(_optgroup !== null){
                                $("#ddlVenue").append(_optgroup);
                                _optgroup = $('<optgroup>');                        
                                _optgroup.attr('label',value.venue_name);
                                curGroup = value.venue_name; 
                            }
                        }
                    }                    

                    var $option = $("<option></option>").val(value.room_id).text(value.room_name + '(S$ ' + value.rental_cost + '/day, capacity: '+ value.capacity +')');
                    $option.data('rental_cost', value.rental_cost);
                    _optgroup.append($option);                        

                });
                $("#ddlVenue").data("selectBox-selectBoxIt").destroy();

                $("#ddlVenue").selectBoxIt({
                    showEffect: "fadeIn",
                    showEffectSpeed: 220,
                    hideEffect: "fadeOut",
                    hideEffectSpeed: 110 ,
                    showFirstOption : true
                });
                $('.venueContainer').width($('#ddlVenueSelectBoxItContainer').width());
            }
        }).fail(function (xhr, stat, msg) {
            alert(xhr.responseText);
        }).always(function (data) {

        });
    }
}