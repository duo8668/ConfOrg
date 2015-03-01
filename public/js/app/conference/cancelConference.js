function loadCancelConference(urlToCancel, confId){
	$('#btnCancelConf').on('click',function(evt){

			bootbox.confirm("Are you sure you want to cancel this conference? </br> </br> <strong>The action is not revertable ! </strong>", function(result) {

				if(result){
					$('#modalMessage').html('Cancelling...');
					$.post( urlToCancel, {conf_id: confId }, function (returnResult) {
						if(returnResult.success.updateResult){
							$('#modalMessage').html('Conference cancelled...<br> Reloading...');
							setTimeout(function(){
								location.reload();
							},250);
						}
					});
				}else{
					$('#modalMessage').html('Return to page...');
					setTimeout(function(){ $('#resultModal').modal('hide') },300);
				}
				$('#resultModal').modal({ keyboard: false , backdrop: 'static'}); });
		});
}