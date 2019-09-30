jQuery(document).ready(function ($) {	 

	function deleteField(){
		$( "#ajaxCallResult .deleteField" ).click(function(ev) {
				ev.preventDefault();
				$(this).parent('.fieldContainer').slideUp("slow").remove();

			}
		 );
	}
	deleteField();
	
	function execAjaxCall(url){
		 var service = {
			ajaxCall: function (data) {
				$.ajax({
				url: url,
				cache: false,
				data: data.serialize(),
				success: function (result) {
					resultContainer.append(result).fadeIn('fast');
					$("#ajaxCallResult").sortable();
					deleteField();
				},
				error: function (jqXHR, textStatus, errorThrow) {
					resultContainer.html('Ajax request - ' + textStatus + ': ' + errorThrow).fadeIn('fast');
				}
			});
			}
		};
		service.ajaxCall($(this));
	}

	var form = $('#editForm');
	var selectForm = $('.ajaxFormOption');
	var resultContainer = $('#ajaxCallResult');
	var formId = $('#form-id').val();
	
	$( ".ajaxCall" ).click(function(ev) {
		ev.preventDefault();
			execAjaxCall($(this).attr('href'));
		}
	);
  

	$("#ajaxCallResult").sortable();

	$('.tx-formcreator .date-picker').datepicker({
		dateFormat: "dd-mm-yy",
		changeMonth: true,
		changeYear: true,
		showButtonPanel: true
	});

	$.validate({
		modules : 'date'
	});
			
			
});