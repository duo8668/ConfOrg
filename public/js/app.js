$(document).ready(function() {

    //confirm all destroys
    $('form').submit(function( event ) {
        var method = $(this).children(':hidden[name=_method]').val();
        if ($.type(method) !== 'undefined' && method == 'DELETE') {
            if (!confirm('Are You Sure?')){
                event.preventDefault();
            }
        }
    });

});

// script for adding/removing author fields
var rowNum = 0;
function addRow(frm) {
	rowNum ++;
	var row = '<div class="row" id="rowNum'+rowNum+'" style="margin-top:10px; "><input name="author_fname[]" type="text" value=" " id="author_fname'+rowNum+'" class="col-sm-2"><input name="author_lname[]" type="text" value=" " id="author_lname'+rowNum+'" class="col-sm-2"><input name="author_org[]" type="text" value=" " id="author_org'+rowNum+'" class="col-sm-3"><input name="author_email[]" type="text " value=" " id="author_email'+rowNum+'" class="col-sm-2"><div class="radio-inline col-sm-2 text-center "><input name="author_ispresenting[]" type="checkbox" value="1" id="author_ispresenting'+rowNum+' "> Yes</div><input type="button " class="btn btn-default btn-xs col-sm-1" value="Remove" onclick="removeRow('+rowNum+');"></div>';

	jQuery('#author_row').append(row);	
}

function removeRow(rnum) {
	console.log('#rowNum'+rnum);
	jQuery('#rowNum'+rnum).remove();
}