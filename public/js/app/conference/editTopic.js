/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
function loadEditTopic(_confId, _updateUrl) {
//* Required Scripting
    $('#btnTopicsEdit').on('click', function (e) {

        $('#topicsEditor').modal({keyboard: false, backdrop: 'static', show: true});
        
    });

    //* Save
    $('#btnSaveTopics').on('click', function (e) {

        $.ajax({
            url: _updateUrl,
            data: $( "#edit_topics_form" ).serialize().replace(/%5B%5D/g, '[]'),
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
