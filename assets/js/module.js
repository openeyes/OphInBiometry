
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

	function ucfirst(str) { str += ''; var f = str.charAt(0).toUpperCase(); return f + str.substr(1); }

	function eDparameterListener(_drawing) {
		if (_drawing.selectedDoodle != null) {
			// handle event
		}
	}

	$('#Element_OphInBiometry_BiometryData_axial_length').change(function() {
		update();
	})

	$('#Element_OphInBiometry_BiometryData_r1').change(function() {
		update();
	})

	$('#Element_OphInBiometry_BiometryData_r2').change(function() {
		update();
	})

	$('#Element_OphInBiometry_Calculation_target_refraction').change(function() {
		update();
	})

	$('#Element_OphInBiometry_Calculation_formula_id').change(function() {
		update();
	})

	$('#Element_OphInBiometry_LensType_lens_id').change(function() {
		update();
	})

	renderCalculatedValues();

});

function update()
{
	clearChoice();
	renderCalculatedValues();
}

function clearChoice() {
	var lens = document.getElementById('Element_OphInBiometry_LensSelection_lens');
	lens.value = "";
	var iolPower = document.getElementById('Element_OphInBiometry_LensSelection_iol_power');
	iolPower.value = "";
	var refraction = document.getElementById('Element_OphInBiometry_LensSelection_predicted_refraction');
	refraction.value = "";
}

function renderCalculatedValues()
{
	updateBiometryData();
	updateIolData($('#Element_OphInBiometry_LensType_lens_id').val());
	updateSuggestedPowerTable();
}

function updateBiometryData()
{
	var r1 = parseFloat($('#Element_OphInBiometry_BiometryData_r1').val());
	var k1Value = 337.5 / r1;
	$('#div_Element_OphInBiometry_BiometryData_r1').find('.field-info').text(k1Value.toFixed(2) + " D @ 54°");

	var r2 = parseFloat($('#Element_OphInBiometry_BiometryData_r2').val());
	var k2Value = 337.5 / r2;
	$('#div_Element_OphInBiometry_BiometryData_r2').find('.field-info').text(k2Value.toFixed(2) + " D @ 144°");

	var se = document.getElementById('rse');
	var cyl = document.getElementById('cyl');

	var seValue = (r1 + r2) / 2;
	se.innerHTML = seValue.toFixed(2) + " mm";

	var cylValue = k1Value - k2Value;
	cyl.innerHTML = cylValue.toFixed(2) + " @ 54°";
}

function updateIolData(_index) {
	var acon = document.getElementById('acon');
	var sf = document.getElementById('sf');
	var type = document.getElementById('type');
	var position = document.getElementById('position');
	var comments = document.getElementById('comments');

	var lens = [
		{model: "", description: "", position: "", comments: "", acon: 0},
		{model: "MA60AC", description: "Acrysof® Multi-Piece Intraocular Lens", position: "Posterior chamber", comments: "Available from 5 to 35D", acon: 118.9, sf: 1.90},
		{model: "SN60WF", description: "Acrysof® IQ Intraocular lens", position: "Posterior chamber", comments: "Available from 5 to 35D", acon: 118.0, sf: 1.85}
	];

	acon.innerHTML = lens[_index].acon.toFixed(1);
	sf.innerHTML = lens[_index].sf.toFixed(2);
	type.innerHTML = lens[_index].model + " " + lens[_index].description;
	position.innerHTML = lens[_index].position;
	comments.innerHTML = lens[_index].comments;
}

function updateSuggestedPowerTable()
{
	executeFormula($('#Element_OphInBiometry_Calculation_formula_id option:selected').text());
}

function executeFormula(formula)
{
	var formulae = [];
	formulae['SRK/T'] = 'SRKT';
	formulae['Holladay 1'] = 'Holladay1';
	formulae['T2'] = 'T2';
	fillTableUsingFormula(formulae[formula]);
}

function fillTableUsingFormula(formulaName)
{
	clearTable();
	// Get values
	var e = new EyeMeasurements();
	var iol = new IolConstants();
	var formulaClass = this[formulaName];
	var formula = new formulaClass(e,iol);

	// Calculate lens power for target refraction
	var powerIOL = formula.suggestedPower();
	if (powerIOL) {
		// Round to nearest 0.5
		var roundIOL = Math.round(powerIOL * 2) / 2;

		// Get power for that IOL
		var refraction = formula.powerFor(roundIOL);

		// Iterate towards myopia until value is less than target
		while (refraction > e.tr) {
			roundIOL = roundIOL + 0.5;
			refraction = formula.powerFor(roundIOL);
		}

		// Produce results for range of refraction around this one
		var startPower = roundIOL + 1.0;

		for (var i = 0; i < 5; i++) {
			refraction = formula.powerFor(startPower);

			// Enforce plus sign
			var refString = refraction > 0 ? "+" + refraction.toFixed(2) : refraction.toFixed(2);

			addRow(startPower.toFixed(1), refString, i == 2 ? true : false);
			startPower = startPower - 0.5;
		}
	}
	else {
		console.log('Unable to calculate power');
	}
}

// Delete all rows
function clearTable() {
	// Get reference to table
	var table = document.getElementById('iol-table');

	// Get number of rows
	var numberOfRows = table.tBodies[0].rows.length;

	// Delete them
	for (var i = 0; i < numberOfRows; i++) {
		table.deleteRow(1);
	}
}

function addRow(_dioptresIOL, _dioptresRefraction, _bold) {

	// Get reference to table
	var table = document.getElementById('iol-table');

	// Index of next row is equal to number of rows
	var nextRowIndex = table.tBodies[0].rows.length;

	// Add new row
	var newRow = table.tBodies[0].insertRow(nextRowIndex);

	// IOL
	var cell0 = newRow.insertCell(0);
	var node = document.createElement('button');
	node.setAttribute('onclick', 'iolSelected(' + _dioptresIOL + ',' + _dioptresRefraction +')');
	node.innerHTML = _dioptresIOL;
	cell0.appendChild(node);

	// Refraction
	var cell1 = newRow.insertCell(1);
	node = document.createElement('p');
	if (!_bold) node.innerHTML = _dioptresRefraction;
	else node.innerHTML = '<b>' + _dioptresRefraction + '</b>';
	cell1.appendChild(node);
}

function iolSelected(power, refraction) {
	event.preventDefault();
	clearChoice();
	var lens = document.getElementById('Element_OphInBiometry_LensSelection_lens');
	lens.value =  document.getElementById('type').innerHTML;
	var iolPower = document.getElementById('Element_OphInBiometry_LensSelection_iol_power');
	iolPower.value = power;
	var predictedRefraction = document.getElementById('Element_OphInBiometry_LensSelection_predicted_refraction');
	predictedRefraction.value = refraction;
}

function EyeMeasurements()
{
	this.al=parseFloat($('#Element_OphInBiometry_BiometryData_axial_length').val());
	this.r1=parseFloat($('#Element_OphInBiometry_BiometryData_r1').val());
	this.r2=parseFloat($('#Element_OphInBiometry_BiometryData_r2').val());
	this.tr=parseFloat($('#Element_OphInBiometry_Calculation_target_refraction').val());
}

function IolConstants()
{
	this.acon=parseFloat(document.getElementById('acon').innerHTML);
	this.sf=parseFloat(document.getElementById('sf').innerHTML);
}

function Holladay1 (eyeMeasurements, iolConstants) {

	var r = (eyeMeasurements.r1 + eyeMeasurements.r2) / 2;
	var AL = eyeMeasurements.al;
	var RefTgt = eyeMeasurements.tr;

	var SF = iolConstants.sf;

	var Alm = AL + 0.2;
	var Rag = r < 7.0 ? 7.0 : r;
	var AG = (12.5 * AL / 23.45 > 13.5) ? 13.5 : 12.5 * AL / 23.45;
	var BF7 = (Rag * Rag - (AG * AG / 4.0));
	var BF8 = Math.sqrt(BF7);
	var ACD = 0.56 + Rag - BF8;
	const na = 1.336;
	const nc_1 = 1.0 / 3.0;

	this.suggestedPower = function() {
		var numerator = (1000.0 * na * (na * r - nc_1 * Alm - 0.001 * RefTgt * (12.0 * (na * r - nc_1 * Alm) + Alm * r)));
		var denominator = ((Alm - ACD - SF) * (na * r - nc_1 * (ACD + SF) - 0.001 * RefTgt * (12.0 * (na * r - nc_1 * (ACD + SF)) + (ACD + SF) * r)));
		return numerator / denominator;	};

	this.powerFor = function(lensPower) {
		var Numerator = (1000.0 * na * (na * r - (nc_1) * Alm) - lensPower * (Alm - ACD - SF) * (na * r - (nc_1) * (ACD + SF)));
		var Denominator = (na * (12.0 * (na * r - (nc_1) * Alm) + Alm * r) - 0.001 * lensPower * (Alm - ACD - SF) * (12.0 * (na * r - (nc_1) * (ACD + SF)) + (ACD + SF) * r));
		return Numerator / Denominator;
	};
}

function SRKT (eyeMeasurements, iolConstants) {

	var e = eyeMeasurements;
	var _axialLength = eyeMeasurements.al;
	var _radius1 = eyeMeasurements.r1;
	var _radius2 = eyeMeasurements.r2;
	var _aConstant = iolConstants.acon;

	// Fixed parameters here (could come from parameter file)
	var cornealRI = 1.333;	//Refractive index of the cornea as set in IOL Master

	// Calculate average radius of curvature
	var averageRadius = (_radius1 + _radius2) / 2;

	var dioptresCornea = 337.5 / averageRadius;

	// Difference in refrative indices
	var diffRI = cornealRI - 1;

	// Define result
	var returnPower = false;

	// Calculate IOL power for a given refraction
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

	this.suggestedPower = function() {
		var top = 1000 * na * (na * averageRadius - diffRI * opticalAxialLength - 0.001 * e.tr * (vertexDistance * (na * averageRadius - diffRI * opticalAxialLength) + opticalAxialLength * averageRadius));
		var bottom = (opticalAxialLength - postopACDepth) * (na * averageRadius - diffRI * postopACDepth - 0.001 * e.tr * (vertexDistance * (na * averageRadius - diffRI * postopACDepth) + postopACDepth * averageRadius));
		returnPower = top / bottom;
		return returnPower;
	}

	this.powerFor = function(lensPower) {
		var top = 1000 * na * (na * averageRadius - diffRI * opticalAxialLength) - lensPower * (opticalAxialLength - postopACDepth) * (na * averageRadius - diffRI * postopACDepth);
		var bottom = (na * (vertexDistance * (na * averageRadius - diffRI * opticalAxialLength) + opticalAxialLength * averageRadius) - 0.001 * lensPower * (opticalAxialLength - postopACDepth) * (vertexDistance * (na * averageRadius - diffRI * postopACDepth) + postopACDepth * averageRadius));
		returnPower = top / bottom;
		return returnPower;
	}
}



