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
	<div class="element-fields">
		<div class="row">
			<div class="large-8 column">
				<?php echo $form->textField($element, 'axial_length', array('size' => '10','maxlength' => '5', 'append-text'=>'SNR = 193.0'), null, array('label'=>2, 'field'=>2, 'append-text'=>8))?>
				<?php echo $form->textField($element, 'r1', array('size' => '10','maxlength' => '5', 'append-text'=>'0 D @ 54°'), null, array('label'=>2, 'field'=>2, 'append-text'=>8))?>
				<?php echo $form->textField($element, 'r2', array('size' => '10','maxlength' => '5', 'append-text'=>'0 D @ 144° '), null, array('label'=>2, 'field'=>2, 'append-text'=>8))?>
				<?php echo $form->textField($element, 'r1_axis', array('size' => '10','maxlength' => '5'), null, array('label'=>2, 'field'=>2))?>
				<?php echo $form->textField($element, 'r2_axis', array('size' => '10','maxlength' => '5'), null, array('label'=>2, 'field'=>2))?>
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
				<?php echo $form->textField($element, 'acd', array('size' => '10','maxlength' => '5'), null, array('label'=>2, 'field'=>2))?>
				<?php echo $form->textField($element, 'scleral_thickness', array('size' => '10','maxlength' => '5'), null, array('label'=>2, 'field'=>2))?>

				<?php
				$this->widget('application.modules.eyedraw.OEEyeDrawWidget', array(
						'onReadyCommandArray' => array(
								array('addDoodle', array('AxialLengthGraph')),
								array('deselectDoodles', array()),
						),
						'bindingArray' => array(
								'AxialLengthGraph' => array(
										'axialLength' => array('id' => 'Element_OphInBiometry_BiometryData_axial_length'),
								),
						),
						'width' => 300,
						'height' => 100,
						'idSuffix'=>'slider',
						'mode' => 'edit',
						'toolbar'=>false,

				));
				?>
				<?php
				$this->widget('application.modules.eyedraw.OEEyeDrawWidget', array(
						'onReadyCommandArray' => array(
								array('addDoodle', array('SteepAxis')),
								array('deselectDoodles', array()),
						),
						'bindingArray' => array(
								'SteepAxis' => array(
										'axis' => array('id' => 'Element_OphInBiometry_BiometryData_r1_axis'),
								),
						),
						'width' => 100,
						'height' => 100,
						'mode' => 'edit',
						'idSuffix'=>'left-axis',
						'toolbar'=>false,

				));
				?>
				<?php
				$this->widget('application.modules.eyedraw.OEEyeDrawWidget', array(
						'onReadyCommandArray' => array(
								array('addDoodle', array('SteepAxis')),
								array('deselectDoodles', array()),
						),
						'bindingArray' => array(
								'SteepAxis' => array(
										'axis' => array('id' => 'Element_OphInBiometry_BiometryData_r2_axis'),
								),
						),
						'width' => 100,
						'height' => 100,
						'mode' => 'edit',
						'idSuffix'=>'right-axis',
						'toolbar'=>false,

				));
				?>
			</div>
		</div>
	</div>
</section>
