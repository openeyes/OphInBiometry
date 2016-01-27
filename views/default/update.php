<?php
/**
 * OpenEyes
 *
 * (C) Moorfields Eye Hospital NHS Foundation Trust, 2008-2013
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
$this->beginContent('//patient/event_container', array());
	$form = $this->beginWidget('BaseEventTypeCActiveForm', array(
		'id'=>'update-form',
		'enableAjaxValidation'=>false,
		'layoutColumns' => array(
			'label' => 2,
			'field' => 10
		)
	));
		$this->event_actions[] = EventAction::button('Save', 'save', array('level' => 'save'), array('form'=>'update-form'));
		$this->displayErrors($errors);
		if($this->is_auto) {
			?>
			<div id="surgeon" class="row data-row"  style="margin-left: 0.025rem; margin-right: 0.025rem; margin-top: 0.025rem; background: #dae6f1;">
				<div class="large-2 column">
					<div class="data-label" style="margin-top: 1rem;">Surgeon:</div>
				</div>
				<div class="large-9 column end">
					<div class="data-value"  style="margin-top: 1rem;">&nbsp;&nbsp;<b><?php echo OphInBiometry_Imported_Events::model()->findByAttributes(array('event_id' => $this->event->id))->surgeon_name; ?></b></div>
				</div>
			</div>
			<?php
		}
		$this->renderPartial('//patient/event_elements', array(
			'form' => $form,
			'disableOptionalElementActions' => true
		));
		$this->displayErrors($errors, true);
	$this->endWidget();
$this->endContent();
