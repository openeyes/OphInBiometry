
<div class="element-fields">
	<div class="row">
		<div class="large-12 column">
			<div class="row field-row">
				<div class="large-4 column">
					<span class="field-info">K1 (D):</span>
				</div>
				<div class="large-2 column">
					<input type="text" id="Element_OphInBiometry_Measurement_k1_<?php echo $side; ?>" name="Element_OphInBiometry_Measurement[k1_<?php echo $side; ?>]" value="<?php echo $element->{"k1_$side"}?>">
				</div>
				<div class="large-4 column">
					<span class="field-info">Axis K1:</span>
				</div>
				<div class="large-2 column">
					<input type="text" id="Element_OphInBiometry_Measurement_axis_k1_<?php echo $side; ?>" name="Element_OphInBiometry_Measurement[axis_k1_<?php echo $side; ?>]" value="<?php echo $element->{"axis_k1_$side"}?>">
				</div>

			</div>
		</div>
	</div>
	<div class="row">
		<div class="large-12 column">
			<div class="row field-row">
				<div class="large-4 column">
					<span class="field-info">K2 (D):</span>
				</div>
				<div class="large-2 column">
					<input type="text" id="Element_OphInBiometry_Measurement_k2_<?php echo $side; ?>" name="Element_OphInBiometry_Measurement[k2_<?php echo $side; ?>]" value="<?php echo $element->{"k2_$side"}?>">
				</div>
				<div class="large-4 column">
					<span class="field-info">Axial length (mm):</span>
				</div>
				<div class="large-2 column">
					<input type="text" id="Element_OphInBiometry_Measurement_axial_length_<?php echo $side; ?>" name="Element_OphInBiometry_Measurement[axial_length_<?php echo $side; ?>]" value="<?php echo $element->{"axial_length_$side"}?>">
				</div>

			</div>
		</div>
	</div>
	<div class="row">
		<div class="large-12 column">
			<div class="row field-row">
				<div class="large-4 column">
					<span class="field-info"></span>
				</div>
				<div class="large-2 column">
					<span>&nbsp;</span>
				</div>
				<div class="large-4 column">
					<span class="field-info">SNR:</span>
				</div>
				<div class="large-2 column">
					<input type="text" id="Element_OphInBiometry_Measurement_snr_<?php echo $side; ?>" name="Element_OphInBiometry_Measurement[snr_<?php echo $side; ?>]" value="<?php echo $element->{"snr_$side"}?>">
				</div>

			</div>
		</div>
	</div>
	<?php
	/*
	foreach($measurementInput as $measurementData){
		$lens[] = $measurementData->{"lens_id"};
		$formulas[] = $measurementData->{"formula_id"};
	}*/
//'element' => $element
	//echo  $element;
	//echo '<pre>';
	//print_r($element);
	?>
	<div class="row">
		<div class="large-12 column">
			<div class="row field-row">
				<div class="large-4 column">
					<span class="field-info">Lens:</span>
				</div>
				<div class="large-2 column">
					<?php
					/*
					echo
					CHtml::dropDownList('select_len_'. $side, 'lens_id',
						CHtml::listData(
							OphInBiometry_LensType_Lens::model()->findAll($criteria->condition = "id in (".implode(",",$lens).")", array('order' => 'display_order')),
							'id',
							'name'
						),
						array(
							'empty' => '- Select Lens -',
							'options' => array(2 => array('selected' => true)),
							'class' => 'classname'
						)
					); */?>
				</div>
				<div class="large-4 column">
					<span class="field-info">Formula:</span>
				</div>
				<div class="large-2 column">
					<?php /* echo
					CHtml::dropDownList('select_formula_'. $side, 'formula_id',
						CHtml::listData(
							OphInBiometry_Calculation_Formula::model()->findAll($criteria->condition = "id in (".implode(",",$formulas).")", array('order' => 'display_order')),
							'id',
							'name'
						),
						array(
							'empty' => '- Select Formula -',
							'options' => array(1 => array('selected' => true)),
							'class' => 'classname'
						)
					); */ ?>
				</div>

			</div>
		</div>
	</div>

	<div class="row">
		<?php
		//echo '<pre>'; var_dump($measurementInput);
		foreach($measurementInput as $measurementData){
			$this->renderPartial('form_Element_OphInBiometry_Measurement_fields_iolRefValues', array('side' => $side, 'form' => $form, 'iolRefValues' => $measurementData));
			 //var_dump(json_decode($measurementData->{"iol_ref_values_$side"}));
		}
		?>
	</div>
</div>
