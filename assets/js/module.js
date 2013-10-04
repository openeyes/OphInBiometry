
/* Module-specific javascript can be placed here */

$(document).ready(function() {
	$('#et_save').unbind('click').click(function() {
		if (!$(this).hasClass('inactive')) {
			disableButtons();

			
			return true;
		}
		return false;
	});

	$('#et_cancel').unbind('click').click(function() {
		if (!$(this).hasClass('inactive')) {
			disableButtons();

			if (m = window.location.href.match(/\/update\/[0-9]+/)) {
				window.location.href = window.location.href.replace('/update/','/view/');
			} else {
				window.location.href = baseUrl+'/patient/episodes/'+et_patient_id;
			}
		}
		return false;
	});

	$('#et_deleteevent').unbind('click').click(function() {
		if (!$(this).hasClass('inactive')) {
			disableButtons();
			return true;
		}
		return false;
	});

	$('#et_canceldelete').unbind('click').click(function() {
		if (!$(this).hasClass('inactive')) {
			disableButtons();

			if (m = window.location.href.match(/\/delete\/[0-9]+/)) {
				window.location.href = window.location.href.replace('/delete/','/view/');
			} else {
				window.location.href = baseUrl+'/patient/episodes/'+et_patient_id;
			}
		} 
		return false;
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

	$('select#Element_OphInBiometry_Calculation_iol_type').change(function(e) {
		iolType($(this).val());
	});

	$('select#Element_OphInBiometry_Calculation_iol_type').change();
});

function ucfirst(str) { str += ''; var f = str.charAt(0).toUpperCase(); return f + str.substr(1); }

function eDparameterListener(_drawing) {
	if (_drawing.selectedDoodle != null) {
		// handle event
	}
}

// Collection of Lenses
var lensSet = 
[
	{model: "CZ70BD", description: "Single-Piece PMMA", position: "Posterior chamber", comments: "", acon: 118.8},
	{model: "MC50BD", description: "Single-Piece PMMA", position: "Posterior chamber", comments: "", acon: 118.7},
	{model: "MTA3U0", description: "Anterior chamber", position: "Anterior chamber", comments: "", acon: 115.3},
	{model: "MTA4U0", description: "Anterior chamber", position: "Anterior chamber", comments: "", acon: 115.3},
	{model: "MA30AC", description: "ACRYSOF® Multipiece", position: "Anterior chamber", comments: "", acon: 118.4},
	{model: "MA60AC", description: "ACRYSOF® Multipiece", position: "Anterior chamber", comments: "", acon: 118.4},
	{model: "MA60MA", description: "ACRYSOF® Multipiece - EXpand® Series", position: "Anterior chamber", comments: "", acon: 118.9},
	{model: "SA60AT", description: "ACRYSOF® Single-Piece IOL", position: "Anterior chamber", comments: "", acon: 118.4},
	{model: "SN60AT", description: "ACRYSOF® Single-Piece - Natural IOL", position: "Anterior chamber", comments: "", acon: 118.4},
];
		
/* Called by import button on edit page */
function importBiometry()
{
	document.getElementById("Element_OphInBiometry_Measurements_right_axial_length").value = 23.5;
	document.getElementById("Element_OphInBiometry_Measurements_left_axial_length").value = 24.2;
	document.getElementById("Element_OphInBiometry_Measurements_right_k1").value = 44.5;
	document.getElementById("Element_OphInBiometry_Measurements_right_k2").value = 44.5;
	document.getElementById("Element_OphInBiometry_Measurements_left_k1").value = 43.5;
	document.getElementById("Element_OphInBiometry_Measurements_left_k2").value = "44.0";
}

// Sets IOL type
function iolType(_index)
{
	var acon = document.getElementById('iolAcon');
	var type = document.getElementById('iolType');
	var position = document.getElementById('iolPosition');
	var comments = document.getElementById('iolComments');

	if (typeof(this.lensSet[_index]) == 'undefined') {
		acon.innerHTML = '';
		type.innerHTML = '';
		position.innerHTML = '';
		comments.innerHTML = '';
	} else {
		acon.innerHTML = this.lensSet[_index].acon.toFixed(1);
		type.innerHTML = this.lensSet[_index].model + " " + this.lensSet[_index].description;
		position.innerHTML = this.lensSet[_index].position;
		comments.innerHTML = this.lensSet[_index].comments;
	}
}
        
function refreshCalculation()
{
}

function calculate()
{
	addRow('20.5', -1.30, false);
	addRow('20.0', -0.93, false);
	addRow('19.5', -0.57, false);
	addRow('19.0', -0.22, true);
	addRow('18.5', +0.14, false);
}

// Add row
function addRow(_dioptresIOL, _dioptresRefraction, _bold)
{
	// Get reference to table
	var table = document.getElementById('iolTable');
	
	// Index of next row is equal to number of rows
	var nextRowIndex = table.tBodies[0].rows.length;
	
	// Add new row
	var newRow = table.tBodies[0].insertRow(nextRowIndex);
	
	// IOL
	var cell0 = newRow.insertCell(0);
	cell0.setAttribute('style', 'padding-left: 20px');
	var node = document.createElement('button');
	node.setAttribute('onclick', 'iolSelected(this.innerHTML); return false;');
	node.innerHTML = _dioptresIOL;
	cell0.appendChild(node);
				
	// Refraction
	var cell1 = newRow.insertCell(1);
	cell1.setAttribute('align', 'right');
	cell1.setAttribute('style', 'padding-right: 20px');
	node = document.createElement('p');
	node.setAttribute('style', 'padding: 0px;');
	if (!_bold) node.innerHTML = _dioptresRefraction;
	else node.innerHTML = '<b>' + _dioptresRefraction + '</b>';
	cell1.appendChild(node);						
}

// Selects IOL
function iolSelected(_value)
{
	var power = parseFloat(_value);
	var powerString = power.toFixed(2);
	var selection = document.getElementById("Element_OphInBiometry_Calculation_iol_power");
	selection.value = powerString;
	
	var refraction = -1.30;
	if (_value == '20.0') refraction = -0.93;
	if (_value == '19.5') refraction = -0.57;
	if (_value == '19.0') refraction = -0.22;
	if (_value == '18.5') refraction = +0.14;
	
	var predicted_refraction = document.getElementById("Element_OphInBiometry_Calculation_predicted_refraction");
	predicted_refraction.value = refraction > 0?"+" + refraction.toFixed(2):refraction.toFixed(2);
	
// 	// Calculate predicted refraction
// 	var al = parseFloat(document.getElementById('ral').value);
// 	var r1 = parseFloat(document.getElementById('rr1').value);
// 	var r2 = parseFloat(document.getElementById('rr2').value);
// 	var acon = parseFloat(document.getElementById('iolAcon').innerHTML);
// 	var tr = parseFloat(document.getElementById('rtr').value);
// 	var refraction = calculate(al, r1, r2, acon, power, null, BI.Formula.SRKT);
// 	
// 	// Set value of display
// 	var pred = document.getElementById('rpr');
// 	pred.innerHTML = refraction > 0?"+" + refraction.toFixed(2):refraction.toFixed(2);
}
