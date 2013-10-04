<?php
/**
 * OpenEyes
 *
 * (C) Moorfields Eye Hospital NHS Foundation Trust, 2008-2011
 * (C) OpenEyes Foundation, 2011-2012
 * This file is part of OpenEyes.
 * OpenEyes is free software: you can redistribute it and/or modify it under the terms of the GNU General Public License as published by the Free Software Foundation, either version 3 of the License, or (at your option) any later version.
 * OpenEyes is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU General Public License for more details.
 * You should have received a copy of the GNU General Public License along with OpenEyes in a file titled COPYING. If not, see <http://www.gnu.org/licenses/>.
 *
 * @package OpenEyes
 * @link http://www.openeyes.org.uk
 * @author OpenEyes <info@openeyes.org.uk>
 * @copyright Copyright (c) 2008-2011, Moorfields Eye Hospital NHS Foundation Trust
 * @copyright Copyright (c) 2011-2012, OpenEyes Foundation
 * @license http://www.gnu.org/licenses/gpl-3.0.html The GNU General Public License V3.0
 */
?>

<div class="element <?php echo $element->elementType->class_name?>"
	data-element-type-id="<?php echo $element->elementType->id?>"
	data-element-type-class="<?php echo $element->elementType->class_name?>"
	data-element-type-name="<?php echo $element->elementType->name?>"
	data-element-display-order="<?php echo $element->elementType->display_order?>">
	<h4 class="elementTypeName"><?php echo $element->elementType->name; ?></h4>

	<?php echo $form->dropDownList($element,'iol_type',array('CZ70BD','MC50BD','MTA3U0','MTA4U0','MA30AC','MA60AC','MA60MA','SA60AT','SN60AT'),array('empty'=>'- Select -'))?>

	<div style="width:1032; height:130px;" align="left">
		<div style="width:548px; float:left;">
			<div class="eventDetail">
				<div class="label">Description:</div>
				<div class="data"><p id="iolType" class="readonly">MA60AC Acrysof® Multi-Piece Intraocular Lens</p></div>
			</div>
			<div class="eventDetail">
				<div class="label">A constant:</div>
				<div class="data"><p id="iolAcon" class="readonly">118.9</p></div>
			</div>
		</div>
		
		<div style="width:480px; float:left;">
			<div class="eventDetail">
				<div class="label">Position:</div>
				<div class="data"><p id="iolPosition" class="readonly">Posterior chamber</p></div>
			</div>
			<div class="eventDetail">
				<div class="label">Comments:</div>
				<div class="data"><p id="iolComments" class="readonly">Available from 5 to 35D</p></div>
			</div>
		</div>
	</div>

	
	<?php echo $form->textField($element, 'target_refraction', array('size' => '10','maxlength' => '6'))?>
	
	<?php echo $form->dropDownList($element, 'formula_id', CHtml::listData(Element_OphInBiometry_Calculation_Formula::model()->findAll(array('order'=> 'display_order asc')),'id','name'), array('onchange' => 'refreshCalculation();'))?>
	
	<div class="eventDetail">
		<div style="float: right; margin-right: 5em;">
			<span style="color: #f00; font-weight: bold; font-size: 14px;">The calculation of lens power is for demonstration purposes only.</span>
		</div>
		<div class="label">
			<button type="button" class="classy blue mini" id="clear_prescription" name="clear_prescription" onclick="calculate();">
				<span class="button-span button-span-blue">Calculate</span>
			</button>
		</div>
		<div>
			<table name="table" id="iolTable" cellspacing="0" width="180">
				<thead>
					<tr>
						<td align="left" width="60%" style="margin-left:20px;"><h4 style="margin-left: 4px">IOL power</h4></td>
						<td align="right" width="40%"><h4>Refraction</h4></td>					
					</tr>
				</thead>
				<tbody id="tableBody">
				</tbody>
			</table>
		</div>
	</div>

	<!-- Result -->
	<div style="width:1032; height:80px;" align="left">
		<div style="width:514px; float:left;">
			<?php echo $form->textField($element, 'iol_power', array('size' => '10','maxlength' => '4'))?>
		</div>
		<div style="width:514px; float:left;">
			<?php echo $form->textField($element, 'predicted_refraction', array('size' => '10','maxlength' => '4'))?>
		</div>
	</div>
</div>
