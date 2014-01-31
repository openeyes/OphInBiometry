
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

$('#Element_OphInBiometry_IolCalculation_r2').change(function() {
	refreshCalculation();
})

// Calculate lens powers
function refreshCalculation() {
	// Clear existing values
	clearTable();

	// Get values
	var al = parseFloat(document.getElementById('ral').value);
	var r1 = parseFloat(document.getElementById('rr1').value);
	var r2 = parseFloat(document.getElementById('rr2').value);
	var acon = parseFloat(document.getElementById('iolAcon').innerHTML);
	var tr = parseFloat(document.getElementById('rtr').value);

	// Calculate lens power for target refraction
	var powerIOL = calculate(al, r1, r2, acon, null, tr, BI.Formula.SRKT);
	if (powerIOL) {
		// Round to nearest 0.5
		var roundIOL = Math.round(powerIOL * 2) / 2;

		// Get power for that IOL
		var refraction = calculate(al, r1, r2, acon, roundIOL, null, BI.Formula.SRKT);

		// Iterate towards myopia until value is less than target
		while (refraction > tr) {
			roundIOL = roundIOL + 0.5;
			refraction = calculate(al, r1, r2, acon, roundIOL, null, BI.Formula.SRKT);
		}

// Produce results for range of refraction around this one
		var startPower = roundIOL + 1.0;

		for (var i = 0; i < 5; i++) {
			refraction = calculate(al, r1, r2, acon, startPower, null, BI.Formula.SRKT);

			// Enforce plus sign
			var refString = refraction > 0 ? "+" + refraction.toFixed(2) : refraction.toFixed(2);

			addRow(startPower.toFixed(1), refString, i == 2 ? true : false);
			startPower = startPower - 0.5;
		}
	}
	else {
		console.log('Unable to calculate power');
	}

// Clear choice
	var selection = document.getElementById('rsi');
	selection.value = "";
	var pred = document.getElementById('rpr');
	pred.innerHTML = "";

	// Glaucoma: add scleral thickness input if axial length low
	scleralThickness(al);
}

function calculate(_axialLength, _radius1, _radius2, _aConstant, _dioptresIOL, _dioptresRefraction, _formula) {
	// Fixed parameters here (could come from parameter file)
	var cornealRI = 1.333;	//Refractive index of the cornea as set in IOL Master

	// Calculate average radius of curvature
	var averageRadius = (_radius1 + _radius2) / 2;
	//var R1 = 337.5 / 42.88;
	//var R2 = 337.5 / 43.44;
	//averageRadius = (R1 + R2) / 2;
	var dioptresCornea = 337.5 / averageRadius;

	// Difference in refrative indices
	var diffRI = cornealRI - 1;

	// Calculate average power of cornea in dioptres
	//var dioptresCornea = 1000 * diffRI / averageRadius;
	//var dioptresCornea = 337.5 / averageRadius;
	//var dioptresCornea = 43.15818350324374;

	// Define result
	var returnPower = false;

	// Calculate IOL power for a given refraction
	if (_dioptresIOL == null) {
		switch (_formula) {
			case BI.Formula.SRK:
				returnPower = _aConstant - 0.9 * dioptresCornea - 2.5 * _axialLength;
				break;
			case BI.Formula.SRKT:
				var na = 1.336; // ***TODO***  What is this?
				var vertexDistance = 12;
				var retinalThickness = 0.65696 - 0.02029 * _axialLength;
				var opticalAxialLength = _axialLength + retinalThickness;

				// 'A' constant correction
				if (_aConstant > 100) {
					var aConstantSRK = _aConstant * 0.62467 - 68 - 0.74709;
				}
				else {
					var aConstantSRK = _aConstant
				}

				// Difference between natural lens and IOL to cornea
				var diff = aConstantSRK - 3.3357;

				// Axial length correction for high myopes
				var axialLength;
				if (_axialLength > 24.2) {
					axialLength = -3.446 + 1.716 * _axialLength - 0.0237 * _axialLength * _axialLength;
				}
				else {
					axialLength = _axialLength;
				}

				// Corneal width
				var cornealWidth = -5.40948 + 0.58412 * axialLength + 0.098 * dioptresCornea;

				// Corneal dome height
				var cornealDomeHeight = averageRadius - Math.sqrt(averageRadius * averageRadius - cornealWidth * cornealWidth / 4);
				if (cornealDomeHeight > 5.5) cornealDomeHeight = 5.5;

				// Post-op anterior chamber depth
				var postopACDepth = cornealDomeHeight + diff;

				var top = 1000 * na * (na * averageRadius - diffRI * opticalAxialLength - 0.001 * _dioptresRefraction * (vertexDistance * (na * averageRadius - diffRI * opticalAxialLength) + opticalAxialLength * averageRadius));
				var bottom = (opticalAxialLength - postopACDepth) * (na * averageRadius - diffRI * postopACDepth - 0.001 * _dioptresRefraction * (vertexDistance * (na * averageRadius - diffRI * postopACDepth) + postopACDepth * averageRadius));

				returnPower = top / bottom;
				break;
			default:
				console.log('Unknown formula');
				break;
		}
	}
	// Calculate Refractive result for a given IOL
	else {
		switch (_formula) {
			case BI.Formula.SRK:
				returnPower = _aConstant - 0.9 * dioptresCornea - 2.5 * _axialLength;
				break;
			case BI.Formula.SRKT:

				var na = 1.336; // ***TODO***  What is this?
				var vertexDistance = 12;
				var retinalThickness = 0.65696 - 0.02029 * _axialLength;
				var opticalAxialLength = _axialLength + retinalThickness;

				// 'A' constant correction
				if (_aConstant > 100) {
					var aConstantSRK = _aConstant * 0.62467 - 68 - 0.74709;
				}
				else {
					var aConstantSRK = _aConstant;
				}

				// Difference between natural lens and IOL to cornea
				var diff = aConstantSRK - 3.3357;

				// Axial length correction for high myopes
				var axialLength;
				if (_axialLength > 24.2) {
					axialLength = -3.446 + 1.716 * _axialLength - 0.0237 * _axialLength * _axialLength;
				}
				else {
					axialLength = _axialLength;
				}

				// Corneal width
				var cornealWidth = -5.40948 + 0.58412 * axialLength + 0.098 * dioptresCornea;

				// Corneal dome height
				var cornealDomeHeight = averageRadius - Math.sqrt(averageRadius * averageRadius - cornealWidth * cornealWidth / 4);
				if (cornealDomeHeight > 5.5) cornealDomeHeight = 5.5;

				// Post-op anterior chamber depth
				var postopACDepth = cornealDomeHeight + diff;

				var top = 1000 * na * (na * averageRadius - diffRI * opticalAxialLength) - _dioptresIOL * (opticalAxialLength - postopACDepth) * (na * averageRadius - diffRI * postopACDepth);
				var bottom = (na * (vertexDistance * (na * averageRadius - diffRI * opticalAxialLength) + opticalAxialLength * averageRadius) - 0.001 * _dioptresIOL * (opticalAxialLength - postopACDepth) * (vertexDistance * (na * averageRadius - diffRI * postopACDepth) + postopACDepth * averageRadius));

				returnPower = top / bottom;
				break;
			default:
				console.log('Unknown formula');
				break;
		}

	}

	return returnPower;
}



function ucfirst(str) { str += ''; var f = str.charAt(0).toUpperCase(); return f + str.substr(1); }

function eDparameterListener(_drawing) {
	if (_drawing.selectedDoodle != null) {
		// handle event
	}
}
