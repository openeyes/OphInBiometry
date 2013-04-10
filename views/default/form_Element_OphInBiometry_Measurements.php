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
	
	<div class="eventDetail">
		<div class="label">
		</div>
		<div>
			<button type="button" class="classy blue mini" title="Import data from IOL Master" id="clear_prescription" name="clear_prescription" onclick="importBiometry();">
				<span class="button-span button-span-blue">Import</span>
			</button>
		</div>
	</div>
		
	<!-- Split into two columns -->
	<div style="width:1032; height:130px;" align="left">
	
		<!-- Right eye -->
		<div style="width:514px; float:left;">
			<?php echo $form->textField($element, 'right_axial_length', array('size' => '10','maxlength' => '4'))?>
			<?php echo $form->textField($element, 'right_k1', array('size' => '10','maxlength' => '4'))?>
			<?php echo $form->textField($element, 'right_k2', array('size' => '10','maxlength' => '4'))?>
		</div>
		
		<!-- Left eye -->
		<div style="width:514px; float:left;">
			<?php echo $form->textField($element, 'left_axial_length', array('size' => '10','maxlength' => '4'))?>
			<?php echo $form->textField($element, 'left_k1', array('size' => '10','maxlength' => '4'))?>
			<?php echo $form->textField($element, 'left_k2', array('size' => '10','maxlength' => '4'))?>
		</div>
		
	</div>		
	
</div>
