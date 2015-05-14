
<div class="element-fields">
	<div class="row">
		<div class="large-12 column">
			<?php echo $form->dropDownList($element, 'lens_id_'.$side, CHtml::listData(OphInBiometry_LensType_Lens::model()->activeOrPk($element->{'lens_id_'.$side})->findAll(array('order'=> 'display_order asc')),'id','name'),array('empty'=>'- Please select -'),null,array('label'=>3, 'field'=>6))?>
		</div>
	</div>
	<div class="row">
		<div class="large-12 column">
			<div class="row field-row">
				<div class="large-3 column">
					<span class="field-info">Description:</span>
				</div>
				<div class="large-9 column">
					<span id="type_<?php echo $side?>" class="field-info"><?php echo $element->{'lens_'.$side} ? $element->{'lens_'.$side}->description : ''?></span>
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="large-12 column">
			<div class="row field-row">
				<div class="large-3 column">
					<span class="field-info">A constant:</span>
				</div>
				<div class="large-9 column">
					<span id="acon_<?php echo $side?>" class="field-info"><?php echo $element->{'lens_'.$side} ? number_format($element->{'lens_'.$side}->acon,1) : ''?></span>
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="large-12 column">
			<div class="row field-row">
				<div class="large-3 column">
					<span class="field-info">K1:</span>
				</div>
				<div class="large-3 column">
					<input type="text" name="Element_OphInBiometry_LensType[k1_<?php echo $side; ?>]" value="<?php echo $element->{"k1_$side"}?>"> D
				</div>
				<div class="large-4 column">
					<span class="field-info">Axis K1:</span>
				</div>
				<div class="large-2 column">
					<input type="text" name="Element_OphInBiometry_LensType[axis_k1_<?php echo $side; ?>]" value="<?php echo $element->{"axis_k1_$side"}?>">
				</div>

			</div>
		</div>
	</div>
	<div class="row">
		<div class="large-12 column">
			<div class="row field-row">
				<div class="large-3 column">
					<span class="field-info">K2:</span>
				</div>
				<div class="large-3 column">
					<input type="text" name="Element_OphInBiometry_LensType[k2_<?php echo $side; ?>]" value="<?php echo $element->{"k2_$side"}?>"> D
				</div>
				<div class="large-4 column">
					<span class="field-info">Axial length (mm):</span>
				</div>
				<div class="large-2 column">
					<input type="text" name="Element_OphInBiometry_LensType[axial_length_<?php echo $side; ?>]" value="<?php echo $element->{"axial_length_$side"}?>">
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
					<input type="text" name="Element_OphInBiometry_LensType[snr_<?php echo $side; ?>]" value="<?php echo $element->{"snr_$side"}?>">
				</div>

			</div>
		</div>
	</div>
</div>
