
<div class="element-fields">
	<div class="row">
		<div class="large-12 column">
			<?php echo $form->textField($element, 'axial_length_'.$side , array('size' => '10','maxlength' => '5', 'append-text'=>'SNR = 193.0'), null, array('label'=>3, 'field'=>3, 'append-text'=>6))?>
			<?php echo $form->textField($element, 'r1_'.$side, array('size' => '10','maxlength' => '5', 'append-text'=>'0 D @ 54°'), null, array('label'=>3, 'field'=>3, 'append-text'=>6))?>
			<?php echo $form->textField($element, 'r2_'.$side, array('size' => '10','maxlength' => '5', 'append-text'=>'0 D @ 144° '), null, array('label'=>3, 'field'=>3, 'append-text'=>6))?>
			<?php echo $form->textField($element, 'r1_axis_'.$side, array('size' => '10','maxlength' => '5'), null, array('label'=>3, 'field'=>3))?>
		</div>
	</div>
	<div class="row">
		<div class="large-12 column">
			<div class="row field-row">
				<div class="large-3 column">
					<span class="field-info">R/SE:</span>
				</div>
				<div class="large-3 column">
					<span id="rse_<?php echo $side?>" class="field-info"></span>
				</div>
				<div class="large-6 column collapse end">
					<span class="field-info">SD = 43.16 mm</span>
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="large-12 column">
			<div class="row field-row">
				<div class="large-3 column">
					<span class="field-info">Cyl:</span>
				</div>
				<div class="large-9 column">
					<span id="cyl_<?php echo $side?>" class="field-info"></span>
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="large-12 column">
			<?php echo $form->textField($element, 'acd_'.$side, array('size' => '10','maxlength' => '5'), null, array('label'=>3, 'field'=>3))?>
			<?php echo $form->textField($element, 'scleral_thickness_'.$side, array('size' => '10','maxlength' => '5'), null, array('label'=>3, 'field'=>3))?>

			<?php
			$this->widget('application.modules.eyedraw.OEEyeDrawWidget', array(
					'onReadyCommandArray' => array(
							array('addDoodle', array('AxialLengthGraph')),
							array('deselectDoodles', array()),
					),
					'bindingArray' => array(
							'AxialLengthGraph' => array(
									'axialLength' => array('id' => 'Element_OphInBiometry_BiometryData_axial_length_'.$side),
							),
					),
					'width' => 300,
					'height' => 100,
					'idSuffix'=>'slider_'.$side,
					'mode' => 'edit',
					'toolbar'=>false,

			));
			?>
		</div>
	</div>
</div>