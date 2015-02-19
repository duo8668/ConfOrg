/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function loadEditReviewPanel(_confId, _dataUrl, _updateUrl, _searchUrl) {

    $('#btnReviewPanelEdit').on('click', function (e) {
// raise ajax request here and set text
        $(this).find('#reviewPanel > > [name=emails]').tagsinput('removeAll');
        $.ajax({url: _dataUrl
            , data: {conf_id: _confId}
            , type: 'get'
            , beforeSend: function () {
                $('#modalMessage').html('Loading...');
                $('#resultModal').modal({
                    keyboard: false
                    , backdrop: 'static'});
            }
        })
                .done(function (data) {

                    $.each(data, function (key, value) {
                        $('#reviewPanel > > [name=emails]').tagsinput('add', value);
                    });
                    setTimeout(function () {
                        $('#resultModal').modal('hide');
                        $('#reviewPanelEditor').modal({keyboard: false, backdrop: 'static', show: true});
                    }, 1000);
                })
                .fail(function (data) {
                    if (data.responseJSON !== undefined) {
                        if (data.responseJSON.error !== undefined) {
                            var message = data.responseJSON.error.type + ' : ' + data.responseJSON.error.message;
                            $('#modalMessage').html(message);
                            setTimeout(function () {
                                $('#resultModal').modal('hide');
                            }, 1500);
                        }
                    }
                });
    });
    //* Validate
    $('#reviewPanel').formValidation({
        framework: 'bootstrap',
        excluded: ':disabled',
        err: {
            container: 'tooltip'
        },
        icon: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
            emails: {
                validators: {
                    callback: {
                        message: 'Invalid emails',
                        callback: function (value, validator, $field) {
                            // Determine the numbers which are generated in captchaOperation
                            var ok = true;
                            var regexp = RegExp(/(?:[a-z0-9!#$%&'*+\/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+\/=?^_`{|}~-]+)*|"(?:[\x01-\x08\x0b\x0c\x0e-\x1f\x21\x23-\x5b\x5d-\x7f]|\\[\x01-\x09\x0b\x0c\x0e-\x7f])*")@(?:(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?|\[(?:(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.){3}(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?|[a-z0-9-]*[a-z0-9]:(?:[\x01-\x08\x0b\x0c\x0e-\x1f\x21-\x5a\x53-\x7f]|\\[\x01-\x09\x0b\x0c\x0e-\x7f])+\]))/);
                            var options = validator.getFieldElements('emails').tagsinput('items');
                            var errEmails = 'Invalid emails are ';
                            $.each(options, function (key, val) {

                                if (!regexp.test(val)) {
                                    errEmails += '\'' + val + '\' ,  ';
                                    ok = false;
                                }
                            });
                            return {valid: ok, message: errEmails};
                        }
                    }
                }
            }
        }
    }).on('err.field.fv err.validator.fv', function (e, data) {
        $('#btnSaveReviewPanel').prop('disabled', true);
    }).on('success.field.fv', function (e, data) {
        $('#btnSaveReviewPanel').prop('disabled', false);
    }).find('[name=emails]').tagsinput({
        typeahead: {
            maxTags: 3,
            trimValue: true,
            source: function (query) {

                return $.ajax({url: _searchUrl
                    , data: {partialname: query, conf_id: _conf_id}
                    , type: 'get'});
            }
        }
    });

    $('#btnSaveReviewPanel').on('click', function (e) {

        $.ajax({url: _updateUrl
            , data: {conf_id: _confId, emails: $('#reviewPanel').find('[name=emails]').tagsinput('items')}
            , type: 'get'
            , beforeSend: function () {
                $('#modalMessage').html('Loading...');
                $('#resultModal').modal({
                    keyboard: false
                    , backdrop: 'static'});
            }}).done(function (data) {
//change the current
            if (data.success !== undefined) {
                var message = data.success.numRowUpdated + ' record(s) updated successfully !!!';
                $('#modalMessage').html(message);
                $('#allReviewPanelContainer').html('');
                if (data.success.conStaffs !== undefined) {
//* put back all into front page
                    $.each(data.success.conStaffs, function (key, value) {

                        if (value.firstname !== undefined && value.lastname !== undefined) {
                            $('#allReviewPanelContainer').append('<span  class=\'staffInfo label label-info\'  style=\'color:black;margin:2px;\'>' + value.firstname + ', ' + value.lastname + '</span>');
                        }
                    });
                }
            }
            setTimeout(function () {
                $('#resultModal').modal('hide');
                $('#reviewPanelEditor').modal('hide');
            }, 1000);
        }).fail(function (data) {

            if (data.responseJSON !== undefined) {
                if (data.responseJSON.error !== undefined) {
                    var message = data.responseJSON.error.type + ' : ' + data.responseJSON.error.message;
                    $('#modalMessage').html(message);
                    setTimeout(function () {
                        $('#resultModal').modal('hide');
                    }, 1500);
                }
            }
        });
    });

    $('#reviewPanel').find('[name=emails]').on('change', function () {
        var field = $(this).attr('name');
        $('#reviewPanel').formValidation('revalidateField', field);
    });
}
