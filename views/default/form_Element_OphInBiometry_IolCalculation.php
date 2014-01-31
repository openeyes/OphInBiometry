<?php
/**
 * OpenEyes
 *
 * (C) Moorfields Eye Hospital NHS Foundation Trust, 2008-2011
 * (C) OpenEyes Foundation, 2011-2013
 * This file is part of OpenEyes.
 * OpenEyes is free software: you can redistribute it and/or modify it under the terms of the GNU General Public License as published by the Free Software Foundation, either version 3 of the License, or (at your option) any later version.
 * OpenEyes is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU General Public License for more details.
 * You should have received a copy of the GNU General Public License along with OpenEyes in a file titled COPYING. If not, see <http://www.gnu.org/licenses/>.
 *
 * @package OpenEyes
 * @link http://www.openeyes.org.uk
 * @author OpenEyes <info@openeyes.org.uk>
 * @copyright Copyright (c) 2008-2011, Moorfields Eye Hospital NHS Foundation Trust
 * @copyright Copyright (c) 2011-2013, OpenEyes Foundation
 * @license http://www.gnu.org/licenses/gpl-3.0.html The GNU General Public License V3.0
 */
?>

<section class="element <?php echo $element->elementType->class_name?>"
		 data-element-type-id="<?php echo $element->elementType->id?>"
		 data-element-type-class="<?php echo $element->elementType->class_name?>"
		 data-element-type-name="<?php echo $element->elementType->name?>"
		 data-element-display-order="<?php echo $element->elementType->display_order?>">
	<header class="element-header">
		<h3 class="element-title"><?php echo $element->elementType->name; ?></h3>
	</header>
	<div class="element-fields">
		<div class="row">
			<div class="large-8 column">
				<h2>Biometry Data</h2>
				<?php echo $form->textField($element, 'axial_length', array('size' => '10','maxlength' => '4', 'append-text'=>'SNR = 193.0'), null, array('label'=>2, 'field'=>2, 'append-text'=>8))?>
				<?php echo $form->textField($element, 'r1', array('size' => '10','maxlength' => '4', 'append-text'=>'0 D @ 54°'), null, array('label'=>2, 'field'=>2, 'append-text'=>8))?>
				<?php echo $form->textField($element, 'r2', array('size' => '10','maxlength' => '4', 'append-text'=>'0 D @ 144° '), null, array('label'=>2, 'field'=>2, 'append-text'=>8))?>
			</div>
		</div>
		<div class="row">
			<div class="large-8 column">
				<div class="row field-row">
					<div class="large-2 column">
						<span class="field-info">R/SE:</span>
					</div>
					<div class="large-2 column">
						<span id="rse" class="field-info"></span>
					</div>
					<div class="large-8 column collapse end">
						<span class="field-info">SD = 43.16 mm</span>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="large-8 column">
				<div class="row field-row">
					<div class="large-2 column">
						<span class="field-info">Cyl:</span>
					</div>
					<div class="large-10 column">
						<span id="cyl" class="field-info"></span>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="large-8 column">
				<div class="row field-row">
					<div class="large-2 column">
						<span class="field-info">Acd:</span>
					</div>
					<div class="large-10 column">
						<span id="arc" class="field-info">2.28mm</span>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="large-8 column">
				<h2>Lens Selection</h2>
				<?php echo $form->dropDownList($element, 'iol_selection_id', CHtml::listData(OphInBiometry_IolCalculation_IolSelection::model()->findAll(array('order'=> 'display_order asc')),'id','name'),array('empty'=>'- Please select -'),null,array('label'=>2, 'field'=>6))?>
			</div>
		</div>
		<div class="row">
			<div class="large-8 column">
				<div class="row field-row">
					<div class="large-2 column">
						<span class="field-info">Description:</span>
					</div>
					<div class="large-10 column">
						<span id="type" class="field-info"></span>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="large-8 column">
				<div class="row field-row">
					<div class="large-2 column">
						<span class="field-info">A constant:</span>
					</div>
					<div class="large-10 column">
						<span id="acon" class="field-info"></span>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="large-8 column">
				<div class="row field-row">
					<div class="large-2 column">
						<span class="field-info">Position:</span>
					</div>
					<div class="large-10 column">
						<span id="position" class="field-info"></span>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="large-8 column">
				<div class="row field-row">
					<div class="large-2 column">
						<span class="field-info">Comments:</span>
					</div>
					<div class="large-10 column">
						<span id="comments" class="field-info"></span>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="large-8 column">

				<h2>Calculation</h2>
				<?php echo $form->textField($element, 'targeted_refraction', null, null, array('label'=>2, 'field'=>2))?>
				<?php echo $form->dropDownList($element, 'formula_id', CHtml::listData(OphInBiometry_IolCalculation_Formula::model()->findAll(array('order'=> 'display_order asc')),'id','name'),array('empty'=>'- Please select -'),null,array('label'=>2, 'field'=>6))?>
			</div>
		</div>
		<div class="row">
			<div class="large-4 column">
				<table name="table" id="iol-table" align="center" cellspacing="0" width="200" style="margin-top: 10px">
					<thead>
					<tr>
						<td align="left" width="60%"><h4 style="margin-left: 4px">IOL power</h4></td>
						<td align="right" width="40%"><h4>Refraction</h4></td>
					</tr>
					</thead>
					<tbody id="tableBody">
					<tr>
						<td>
							<button>25.0</button>
						</td>
						<td>
							<p>-1.49</p>
						</td>
					</tr>
					<tr>
						<td>
							<button onclick="iolSelected(this.innerHTML)">24.5</button>
						</td>
						<td>
							<p>-0.97</p>
						</td>
					</tr>
					<tr>
						<td>
							<button onclick="iolSelected(this.innerHTML)">24.0</button>
						</td>
						<td>
							<p><b>-0.47</b></p>
						</td>
					</tr>
					<tr>
						<td>
							<button onclick="iolSelected(this.innerHTML)">23.5</button>
						</td>
						<td>
							<p>+0.03</p>
						</td>
					</tr>
					<tr>
						<td>
							<button onclick="iolSelected(this.innerHTML)">23.0</button>
						</td>
						<td>
							<p>+0.53</p>
						</td>
					</tr>
					</tbody>
				</table>
			</div>
		</div>
		<div class="row">
			<div class="large-8 column">

					<?php echo $form->textField($element, 'iol_power', null, null, array('label'=>2, 'field'=>2))?>
			</div>
		</div>
		<div class="row">
			<div class="large-8 column">
				<div class="row field-row">
					<div class="large-2 column">
						<span class="field-info">Predicted Refraction:</span>
					</div>
					<div class="large-10 column">
						<span id="rpr" class="field-info"></span>
					</div>
				</div>
			</div>
		</div>
	</div>

</section>
