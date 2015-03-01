/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function loadEditDescription(_confId, _updateUrl, _registerUrl, _uploadImageUrl) {

    $('#summernote').summernote({
        height: 'calc(100vh - 210px)',
        onImageUpload: function (files, editor, welEditable) {
            //sendFile(files[0], editor, welEditable);
            sendFile(_confId, _registerUrl, _uploadImageUrl, files[0], editor, welEditable);
        }
    }).code($('#descriptionContent').html());



    $('#btnEditDescription').on('click', function (e) {
// raise ajax request here and set text
        $('#summernote').code($('#descriptionContent').html());

        $('#descriptionEditor').modal({
            keyboard: false
            , backdrop: 'static'
            , show: true});

    });
     
//* Save Description
    $('#btnSaveDescription').on('click', function (e) {
        $.ajax({url: _updateUrl
            , data: {conf_id: _confId, description: $('#summernote').code()}
            , type: 'get'
            , beforeSend: function () {
                $('#modalMessage').html('Loading...');
                $('#resultModal').modal({
                    keyboard: false
                    , backdrop: 'static'});
            }
        })
                .done(function (data) {
                    //change the current
                    var message = 'Record updated successfully !!!';
                    $('#modalMessage').html(message);
                    $('#descriptionContent').html($('#summernote').code());
                    setTimeout(function () {
                        $('#resultModal').modal('hide');
                        $('#descriptionEditor').modal('hide');
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
}

function sendFile(_confId, _registerUrl, _uploadImageUrl, file, editor, weleditable) {
    data = new FormData();
    data.append("image", file);
    $.ajax({
        url: _registerUrl,
        type: "GET",
        data: {conf_id: _confId},
        success: function (response) {
            if (response.success) {
                $.ajax({
                    url: _uploadImageUrl,
                    type: "POST",
                    data: data,
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: function (response) {
                        if (response.success) {

                            editor.insertImage(weleditable, response.file);
                        }
                    }
                });
            }
        }
    });
}
