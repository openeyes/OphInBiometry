
/* Module-specific javascript can be placed here */

$(document).ready(function() {
			handleButton($('#et_save'),function() {
					});
	
	handleButton($('#et_cancel'),function(e) {
		if (m = window.location.href.match(/\/update\/[0-9]+/)) {
			window.location.href = window.location.href.replace('/update/','/view/');
		} else {
			window.location.href = baseUrl+'/patient/episodes/'+et_patient_id;
		}
		e.preventDefault();
	});

	handleButton($('#et_deleteevent'));

	handleButton($('#et_canceldelete'),function(e) {
		if (m = window.location.href.match(/\/delete\/[0-9]+/)) {
			window.location.href = window.location.href.replace('/delete/','/view/');
		} else {
			window.location.href = baseUrl+'/patient/episodes/'+et_patient_id;
		}
		e.preventDefault();
	});

	handleButton($('#et_print'),function(e) {
		printIFrameUrl(OE_print_url, null);
		enableButtons();
		e.preventDefault();
	});

	$('select.populate_textarea').unbind('change').change(function() {
		if ($(this).val() != '') {
			var cLass = $(this).parent().parent().parent().attr('class').match(/Element.*/);
			var el = $('#'+cLass+'_'+$(this).attr('id'));
			var currentText = el.text();
			var newText = $(this).children('option:selected').text();

			if (currentText.length == 0) {
				el.text(ucfirst(newText));
			} else {
				el.text(currentText+', '+newText);
			}
		}
	});

	$('#Element_OphInBiometry_IolCalculation_axial_length').change(function() {
		update_biometry_data();
	})

	$('#Element_OphInBiometry_IolCalculation_r1').change(function() {
		update_biometry_data();
	})

	$('#Element_OphInBiometry_IolCalculation_r2').change(function() {
		update_biometry_data();
	})

	function update_biometry_data()
	{
		var r1 = parseFloat($('#Element_OphInBiometry_IolCalculation_r1').val());
		var k1Value = 337.5 / r1;
		$('#div_Element_OphInBiometry_IolCalculation_r1').find('.field-info').text(k1Value.toFixed(2) + " D @ 54°");

		var r2 = parseFloat($('#Element_OphInBiometry_IolCalculation_r2').val());
		var k2Value = 337.5 / r2;
		$('#div_Element_OphInBiometry_IolCalculation_r2').find('.field-info').text(k1Value.toFixed(2) + " D @ 144°");


		var se = document.getElementById('rse');
		var cyl = document.getElementById('cyl');

		var seValue = (r1 + r2) / 2;
		se.innerHTML = seValue.toFixed(2) + " mm";

		var cylValue = k1Value - k2Value;
		cyl.innerHTML = cylValue.toFixed(2) + " @ 54°";
	}
});

function ucfirst(str) { str += ''; var f = str.charAt(0).toUpperCase(); return f + str.substr(1); }

function eDparameterListener(_drawing) {
	if (_drawing.selectedDoodle != null) {
		// handle event
	}
}
