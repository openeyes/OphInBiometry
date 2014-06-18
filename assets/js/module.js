
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

	// extend the removal behaviour to affect the dependent elements
	$(this).delegate('#event-content .side .active-form .remove-side', 'click', function(e) {
		side = getSplitElementSide($(this));

		var other_side = 'left';
		if (side == 'left') {
			other_side = 'right';
		}
		OphInBiometry_hide(side,  this);
		OphInBiometry_show(other_side);
	});

	// extend the adding behaviour to affect dependent elements
	$(this).delegate('#event-content .inactive-form a', 'click', function(e) {
		side = getSplitElementSide($(this));
		OphInBiometry_show(side);
	});

	function OphInBiometry_hide(side, el) {
		hideSplitElementSide('Element_OphInBiometry_LensType', side);
		hideSplitElementSide('Element_OphInBiometry_Calculation', side);
		hideSplitElementSide('Element_OphInBiometry_Selection', side);
	}

	function OphInBiometry_show(side) {
		showSplitElementSide('Element_OphInBiometry_LensType', side);
		showSplitElementSide('Element_OphInBiometry_Calculation', side);
		showSplitElementSide('Element_OphInBiometry_Selection', side);
	}

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

	$('#Element_OphInBiometry_BiometryData_axial_length_left').change(function() {
		update('left');
	})

	$('#Element_OphInBiometry_BiometryData_axial_length_right').change(function() {
		update('right');
	})

	$('#Element_OphInBiometry_BiometryData_r1_left').change(function() {
		update('left');
	})

	$('#Element_OphInBiometry_BiometryData_r1_right').change(function() {
		update('right');
	})


	$('#Element_OphInBiometry_BiometryData_r2_left').change(function() {
		update('left');
	})

	$('#Element_OphInBiometry_BiometryData_r2_right').change(function() {
		update('right');
	})


	$('#Element_OphInBiometry_Calculation_target_refraction_left').change(function() {
		update('left');
	})

	$('#Element_OphInBiometry_Calculation_target_refraction_right').change(function() {
		update('right');
	})

	$('#Element_OphInBiometry_Calculation_formula_id_left').change(function() {
		update('left');
	})

	$('#Element_OphInBiometry_Calculation_formula_id_right').change(function() {
		update('right');
	})

	$('#Element_OphInBiometry_LensType_lens_id_left').change(function() {
		update('left');
	})

	$('#Element_OphInBiometry_LensType_lens_id_right').change(function() {
		update('right');
	})

	renderCalculatedValues('left');
	renderCalculatedValues('right');

});

function update(side)
{
	clearChoice(side);
	renderCalculatedValues(side);
}

function clearChoice(side) {
	var iolPower = document.getElementById('Element_OphInBiometry_Selection_iol_power_'+side);
	iolPower.value = "";
	var refraction = document.getElementById('Element_OphInBiometry_Selection_predicted_refraction_'+side);
	refraction.value = "";
}

function renderCalculatedValues(side)
{
	updateBiometryData(side);

	if(isView()){
		updateIolData($('#lens_'+side).html(),side);
	}

	if(isCreate()) {
		updateIolData($('#Element_OphInBiometry_LensType_lens_id_' + side + ' option:selected').text(),side);
		updateSuggestedPowerTable(side);
	}
}

function updateBiometryData(side)
{
	var eyeMeasurements = new EyeMeasurements(side)
	var k1Text;
	var k2Text;

	if(eyeMeasurements.r1){
		var k1Value = 337.5 / eyeMeasurements.r1;
		k1Text = k1Value.toFixed(2) + " D @ 54°";
	}

	if(eyeMeasurements.r2){
		var k2Value = 337.5 / eyeMeasurements.r2;
		k2Text = k2Value.toFixed(2) + " D @ 144°";
	}

	if(isCreate()) {
	$('#div_Element_OphInBiometry_BiometryData_r1_'+side).find('.field-info').text(k1Text);
	$('#div_Element_OphInBiometry_BiometryData_r2_'+side).find('.field-info').text(k2Text);
	}

	if(isView()) {
		$('#r1info_'+side).html(k1Text);
		$('#r2info_'+side).html(k2Text);
	}

	var se = document.getElementById('rse_'+side);
	var cyl = document.getElementById('cyl_'+side);

	var seValue = (eyeMeasurements.r1 + eyeMeasurements.r2) / 2;
	if(seValue) se.innerHTML = seValue.toFixed(2) + " mm";

	if(cyl){
		cyl.value ='';
		var cylValue = k1Value - k2Value;
		if(cylValue) cyl.innerHTML = cylValue.toFixed(2) + " @ 54°";
	}

}

function updateIolData(index,side) {

	var acon = document.getElementById('acon_'+side);
	var sf = document.getElementById('sf_'+side);
	var type = document.getElementById('type_'+side);
	var position = document.getElementById('position_'+side);
	var comments = document.getElementById('comments_'+side);

	var lens = {
		"": {model: "", description: "", position: "", comments: "", acon: 0},
		"MA60AC": {model: "MA60AC", description: "Acrysof® Multi-Piece Intraocular Lens", position: "Posterior chamber", comments: "Available from 5 to 35D", acon: 118.9, sf: 1.90},
		"SN60WF": {model: "SN60WF", description: "Acrysof® IQ Intraocular lens", position: "Posterior chamber", comments: "Available from 5 to 35D", acon: 118.0, sf: 1.85},
		"SA60AT": {model: "SA60AT", description: "Acrysof® Intraocular lens", position: "Posterior chamber", comments: "+6.0 to +30.0 in 0.5D steps, +31.0 to +40.0 in 1D steps", acon:118.7, pACD:5.41, a0:-0.091, a1:0.231, a2:0.179},
		"MTA3UO":	{model: "MTA3UO", description: "Acrysof® Intraocular lens", position: "Anterior chamber", comments: "+6.0 to +30.0 in 0.5D steps, +31.0 to +40.0 in 1D steps", acon:115.54, pACD:3.53, a0:-0.705, a1:0.4, a2:0.1}
	};


	if(acon) acon.innerHTML = lens[index].acon.toFixed(1);

	if(sf) {
		if(lens[index].sf) {
			sf.innerHTML = lens[index].sf.toFixed(2);
		} else {
			sf.innerHTML = 'Unknown';
		}
	}
	if(type) type.innerHTML = lens[index].model + " " + lens[index].description;
	if(position) position.innerHTML = lens[index].position;
	if(comments) comments.innerHTML = lens[index].comments;
}

function updateSuggestedPowerTable(side)
{
	executeFormula($('#Element_OphInBiometry_Calculation_formula_id_'+side+' option:selected').text(),side);
}

function executeFormula(formula,side)
{
	var formulae = [];
	formulae['SRK/T'] = 'SRKT';
	formulae['Holladay 1'] = 'Holladay1';
	formulae['T2'] = 'T2';

	fillTableUsingFormula(formulae[formula],side);
}

function fillTableUsingFormula(formulaName, side)
{
	clearTable(side);
	// Get values
	var e = new EyeMeasurements(side);
	var iol = new IolConstants(side);
	var formulaClass = this[formulaName];
	var formula = new formulaClass(e,iol);

	// Calculate lens power for target refraction
	var powerIOL = formula.suggestedPower();
	if (powerIOL) {

		// Round to nearest 0.5
		var roundIOL = Math.round(powerIOL * 2) / 2;

		// Produce results for range of refraction around this one
		var startPower = roundIOL + 1;
		for (var i = 0; i < 5; i++) {
			var power = startPower - (0.5 * i);
			var refraction = formula.powerFor(power);
			addRow(power.toFixed(1),enforceSign(refraction.toFixed(2)), i == 2,side);
		}
	}
	else {
		console.log('Unable to calculate power');
	}
}

function enforceSign(value)
{
	return value > 0 ? "+" + value : value;
}

// Delete all rows
function clearTable(side) {
	// Get reference to table
	var table = document.getElementById('iol-table_'+side);

	// Get number of rows
	var numberOfRows = table.tBodies[0].rows.length;

	// Delete them
	for (var i = 0; i < numberOfRows; i++) {
		table.deleteRow(1);
	}
}

function addRow(power, refraction, _bold, side) {

	// Get reference to table
	var table = document.getElementById('iol-table_'+side);

	// Index of next row is equal to number of rows
	var nextRowIndex = table.tBodies[0].rows.length;

	// Add new row
	var newRow = table.tBodies[0].insertRow(nextRowIndex);

	// IOL
	var cell0 = newRow.insertCell(0);
	var node = document.createElement('button');
	node.setAttribute('onclick', 'iolSelected(' + power + ',' + refraction + ',"' + side +'")');
	node.innerHTML = power;
	cell0.appendChild(node);

	// Refraction
	var cell1 = newRow.insertCell(1);
	node = document.createElement('p');
	if (!_bold) node.innerHTML = refraction;
	else node.innerHTML = '<b>' + refraction + '</b>';
	cell1.appendChild(node);
}

function iolSelected(power, refraction, side) {
	event.preventDefault();
	clearChoice(side);

	var iolPower = document.getElementById('Element_OphInBiometry_Selection_iol_power_'+side);
	iolPower.value = power;
	var predictedRefraction = document.getElementById('Element_OphInBiometry_Selection_predicted_refraction_'+side);
	predictedRefraction.value = refraction;
}

function EyeMeasurements(side)
{
	if(isView()) {
		this.al=parseFloat($('#al_'+side).html());
		this.r1=parseFloat($('#r1_'+side).html());
		this.r2=parseFloat($('#r2_'+side).html());
		this.tr=parseFloat($('#tr_'+side).html());
	}

	if(isCreate()){
		this.al=parseFloat($('#Element_OphInBiometry_BiometryData_axial_length_'+side).val());
		this.r1=parseFloat($('#Element_OphInBiometry_BiometryData_r1_'+side).val());
		this.r2=parseFloat($('#Element_OphInBiometry_BiometryData_r2_'+side).val());
		this.tr=parseFloat($('#Element_OphInBiometry_Calculation_target_refraction_'+side).val());
	}
}

function isCreate()
{

	return( $('#al_left').length==0 && $('#al_right').length==0);
}

function isView()
{
	return ($('#al_left').length!=0 || $('#al_right').length!=0);
}

function IolConstants(side)
{
	if(isCreate()) {
	this.acon=parseFloat(document.getElementById('acon_'+side).innerHTML);
	this.sf=parseFloat(document.getElementById('sf_'+side).innerHTML);
	}
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



