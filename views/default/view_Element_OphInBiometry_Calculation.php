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

<h4 class="elementTypeName"><?php echo $element->elementType->name?></h4>

<table class="subtleWhite normalText">
	<tbody>
		<tr>
			<td width="15%"><?php echo CHtml::encode($element->getAttributeLabel('formula_id'))?>:</td>
			<td><span class="big"><?php echo $element->formula ? $element->formula->name : 'None'?></span></td>
			<td width="15%"><?php echo CHtml::encode($element->getAttributeLabel('target_refraction'))?>:</td>
			<td><span class="big"><?php echo $element->target_refraction?></span></td>
		</tr>
		<tr>
			<td width="15%">IOL type</td>
			<td><span class="big">SA60</span></td>
			<td width="15%"><?php echo CHtml::encode($element->getAttributeLabel('iol_power'))?>:</td>
			<td><span class="big" style="background-color:yellow;font-size:50px;padding:10px;"><?php echo $element->iol_power?></span></td>
			<td width="15%"><?php echo CHtml::encode($element->getAttributeLabel('predicted_refraction'))?>:</td>
			<td><span class="big"><?php echo $element->predicted_refraction?></span></td>
		</tr>
		<tr>
			<td width="15%">Alternative IOL type:</td>
			<td><span class="big">MTA3U0</span></td>
			<td width="15%"><?php echo CHtml::encode($element->getAttributeLabel('iol_power'))?>:</td>
			<td><span class="big">17.0</span></td>
			<td width="15%"><?php echo CHtml::encode($element->getAttributeLabel('predicted_refraction'))?>:</td>
			<td><span class="big">-0.33</span></td>
		</tr>
		
	</tbody>
</table>

