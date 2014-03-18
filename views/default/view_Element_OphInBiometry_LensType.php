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
	<div class="element-data">
		<div class="row data-row">
			<div class="large-2 column"><div class="data-label"><?php echo CHtml::encode($element->getAttributeLabel('lens_id_'.$side))?></div></div>
			<div class="large-10 column end"><div class="data-value" id="lens_<?php echo $side?>"><?php echo $element->lens ? $element->lens->name : 'None'?></div></div>
		</div>
		<div class="row field-row">
			<div class="large-2 column">
				<div class="data-label">Description</div>
			</div>
			<div class="large-10 column">
				<div class="data-value" id="type_<?php echo $side?>"></div>
			</div>
		</div>
		<div class="row field-row">
			<div class="large-2 column">
				<div class="data-label">A constant</div>
			</div>
			<div class="large-10 column">
				<div class="data-value" id="acon_<?php echo $side?>"></div>
			</div>
		</div>
		<div class="row field-row">
			<div class="large-2 column">
				<div class="data-label">SF</div>
			</div>
			<div class="large-10 column">
				<div class="data-value" id="sf_<?php echo $side?>"></div>
			</div>
		</div>
		<div class="row field-row">
			<div class="large-2 column">
				<div class="data-label">Position</div>
			</div>
			<div class="large-10 column">
				<div class="data-value" id="position_<?php echo $side?>"></div>
			</div>
		</div>
		<div class="row field-row">
			<div class="large-2 column">
				<div class="data-label">Comments</div>
			</div>
			<div class="large-10 column">
				<div class="data-value" id="comments_<?php echo $side?>"></div>
			</div>
		</div>
	</div>
</section>
