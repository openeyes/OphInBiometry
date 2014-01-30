
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
		$('#div_Element_OphInBiometry_IolCalculation_r2').find('.field-info').text(k2Value.toFixed(2) + " D @ 144°");


		var se = document.getElementById('rse');
		var cyl = document.getElementById('cyl');

		var seValue = (r1 + r2) / 2;
		se.innerHTML = seValue.toFixed(2) + " mm";

		var cylValue = k1Value - k2Value;
		cyl.innerHTML = cylValue.toFixed(2) + " @ 54°";
	}

	$('#Element_OphInBiometry_IolCalculation_iol_selection_id').change(function() {
		iolType($(this).val());
	})
});

function iolType(_index) {
	var acon = document.getElementById('acon');
	var type = document.getElementById('type');
	var position = document.getElementById('position');
	var comments = document.getElementById('comments');


	var lens = [
		{model: "MA60AC", description: "Acrysof® Multi-Piece Intraocular Lens", position: "Posterior chamber", comments: "Available from 5 to 35D", acon: 118.9},
		{model: "SN60WF", description: "Acrysof® IQ Intraocular lens", position: "Posterior chamber", comments: "Available from 5 to 35D", acon: 118.0},
		{model: "MTA3U0", description: "Acrysof® Anterior Chamber Intraocular lens", position: "Anterior chamber", comments: "Default AC Lens", acon: 115.8}
	];

	acon.innerHTML = lens[_index].acon.toFixed(1);
	type.innerHTML = lens[_index].model + " " + lens[_index].description;
	position.innerHTML = lens[_index].position;
	comments.innerHTML = lens[_index].comments;
}



function ucfirst(str) { str += ''; var f = str.charAt(0).toUpperCase(); return f + str.substr(1); }

function eDparameterListener(_drawing) {
	if (_drawing.selectedDoodle != null) {
		// handle event
	}
}
