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

<section class="element">
	<header class="element-header">
		<h3 class="element-title"><?php echo $element->elementType->name?></h3>
	</header>
	<div class="element-data">
		<div class="row">
			<div class="large-8 column">
				<div class="row data-row">
					<div class="large-2 column"><div class="data-label"><?php echo CHtml::encode($element->getAttributeLabel('axial_length'))?></div></div>
					<div class="large-2 column"><div class="data-value" id="al"><?php echo CHtml::encode($element->axial_length)?></div></div>
					<div class="large-8 column"><div class="data-value">SNR = 193.0</div></div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="large-8 column">
				<div class="row data-row">
					<div class="large-2 column"><div class="data-label"><?php echo CHtml::encode($element->getAttributeLabel('r1'))?></div></div>
					<div class="large-2 column"><div class="data-value" id="r1"><?php echo CHtml::encode($element->r1)?></div></div>
					<div class="large-8 column"><div class="data-value" id="r1info"></div></div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="large-8 column">
				<div class="row data-row">
					<div class="large-2 column"><div class="data-label"><?php echo CHtml::encode($element->getAttributeLabel('r2'))?></div></div>
					<div class="large-2 column"><div class="data-value" id="r2"><?php echo CHtml::encode($element->r2)?></div></div>
					<div class="large-8 column"><div class="data-value" id="r2info"></div></div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="large-8 column">
				<div class="row data-row">
					<div class="large-2 column">
						<div class="data-label">R/SE:</div>
					</div>
					<div class="large-2 column">
						<div class="data-value"  id="rse" class="field-info"></div>
					</div>
					<div class="large-8 column">
						<div class="data-value">SD = 43.16 mm</div>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="large-8 column">
				<div class="row data-row">
					<div class="large-2 column">
						<div class="data-label">Cyl:</div>
					</div>
					<div class="large-10 column">
						<div class="data-value" id="cyl"></div>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="large-8 column">
				<div class="row data-row">
					<div class="large-2 column">
						<div class="data-label">Acd:</div>
					</div>
					<div class="large-10 column">
						<div class="data-value" id="arc">2.28mm</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>