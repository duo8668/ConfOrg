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
	var row = '<div class="form-inline" id="rowNum'+rowNum+'" style="margin-top:10px;"> <div class="form-group author-inline-form"> <label>Author '+ (rowNum + 1) +': </label></div><div class="form-group author-inline-form"><label class="sr-only" for="author_fname'+rowNum+'">First Name</label><input type="text" value="" class="form-control" id="author_fname'+rowNum+'" placeholder="First name" name="author_fname[]" required> </div> <div class="form-group author-inline-form"> <label class="sr-only" for="author_lname'+rowNum+'">Last Name</label> <input type="text" value="" class="form-control" id="author_lname'+rowNum+'" placeholder="Last name" name="author_lname[]" required> </div> <div class="form-group author-inline-form"> <label class="sr-only" for="author_org'+rowNum+'">Organization</label> <input type="text" value="" class="form-control" id="author_org'+rowNum+'" placeholder="Organization" name="author_org[]" required> </div> <div class="form-group author-inline-form"> <label class="sr-only" for="author_email'+rowNum+'">Email</label><input type="email" value="" class="form-control" id="author_email'+rowNum+'" placeholder="Email" name="author_email[]" required> </div> <div class="checkbox"> <label> <input type="checkbox" name="author_ispresenting[]" value="1" id="author_ispresenting'+rowNum+'"> This author is presenting </label> </div> <div class="form-group author-inline-form"><input type="button" class="btn btn-default btn-xs" value="Remove" onclick="removeRow('+rowNum+');"></div>';

	jQuery('#author_row').append(row);	
}

function removeRow(rnum) {
	console.log('#rowNum'+rnum);
	jQuery('#rowNum'+rnum).remove();
}