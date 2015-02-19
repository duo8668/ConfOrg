/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
function loadEditParticular(_confId, _updateUrl) {
//* Required Scripting

    $('#innerCutOffDate').datetimepicker({useCurrent: false, pickTime: true, pickDate: true});
    $('#btnEditParticular').on('click', function (e) {

        $('#innerCutOffDate').data('DateTimePicker').setValue(new Date($('#cutOffValue').html()));
        $('#innerCutOffDate').data('DateTimePicker').setMinDate(new Date());
        var d = new Date($('#beginDate').html());
        d.setDate(d.getDate() - 5);
        $('#innerCutOffDate').data('DateTimePicker').setMaxDate(d);
        $('#innerMinScore > input').val($('#minScoreValue').html());
        $('#particularEditor').modal({keyboard: false, backdrop: 'static', show: true});
    });
//* Validation
    $('#confParticularField').formValidation({
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
            }
        }
    }).on('err.field.fv err.validator.fv', function (e, data) {
        $('#btnSaveConfParticular').prop('disabled', true);
    }).on('success.field.fv', function (e, data) {
        $('#btnSaveConfParticular').prop('disabled', false);
    });

    //* Save
    $('#btnSaveConfParticular').on('click', function (e) {

        $.ajax({
            url: _updateUrl,
            data: {
                conf_id: _confId,
                cutOffDate: $("#innerCutOffDate").data("DateTimePicker").getDate().format('DD-MMM-YYYY HH:mm'),
                minScore: $('#innerMinScore > input').val()
            },
            type: 'get',
            beforeSend: function () {
                $('#modalMessage').html('Loading...');
                $('#resultModal').modal({
                    keyboard: false,
                    backdrop: 'static'
                });
            }
        }).done(function (data) {
//change the current
            if (data.success !== undefined) {
                var message = data.success.numRowUpdated + ' record(s) updated successfully !!!';
                $('#modalMessage').html(message);
                $('#cutOffValue').html('');
                $('#minScoreValue').html('');
                if (data.success.conf !== undefined) {
//* put back all into front page

                    if (data.success.conf.cutoff_time !== undefined && data.success.conf.min_score !== undefined) {
                        $('#cutOffValue').append(new moment(data.success.conf.cutoff_time).format('DD-MMM-YYYY HH:mm'));
                        $('#minScoreValue').append(data.success.conf.min_score);
                    }

                }
            }
            setTimeout(function () {
                $('#resultModal').modal('hide');
                $('#particularEditor').modal('hide');
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
}
