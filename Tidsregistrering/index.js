import { timeToMinutes } from './timeConverter.js'


$(function() {
	//input fields for form in index.js
	const $workStart = $('#worktimestart');
    const $workEnd = $('#worktimeend');
    const $lunchStart = $('#lunchbreakstart');
    const $lunchEnd = $('#lunchbreakend');
	
	// This will run when page is ready.
	
	// Validate form on submit.
	$('#timeregistration_edit_form').submit( function(event) {
		let valid = true;
		let errorMessage = 'Udfyld alle felter';

		//converts time from hours to minutes 
		const workStartInMinutes = timeToMinutes($workStart.val());
        const workEndInMinutes = timeToMinutes($workEnd.val());
        const lunchStartInMinutes = timeToMinutes($lunchStart.val());
        const lunchEndInMinutes = timeToMinutes($lunchEnd.val());

		// Check if there is input in every field
		$('#timeregistration_edit_form input[type!="submit"]').each(function() {
			if (! $(this).val()) {
				valid = false;
				return false;
			}
		});
//============================================ START AND END TIME VALIDATION ====================================================
		if(valid){
			if(workStartInMinutes >= workEndInMinutes){
				errorMessage = "Arbejds startstid skal være før du har fri";
				valid = false;
			}
			else if(lunchStartInMinutes >= lunchEndInMinutes){
				errorMessage = "Frokost startstid skal være før frokost slutter";
				valid = false;
			}
			else if(lunchStartInMinutes && lunchEndInMinutes > workEndInMinutes ){
				errorMessage = "Sæt frokost start og sluttid før du har fri";
				valid = false;		
					
			}else if(lunchStartInMinutes && lunchEndInMinutes < workStartInMinutestes ){
				errorMessage = "Sæt frokost start og sluttid efter arbejdsdag starter";
				valid = false;			
			}
			
		} 

		// ============================================Output to user, if form did not validate.====================================================
		if (! valid) {
			event.preventDefault();
			alert (errorMessage);
			return false;
		}
		return true;
	});

});