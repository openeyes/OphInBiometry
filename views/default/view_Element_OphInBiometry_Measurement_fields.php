
<div class="element-data">
	<div class="row field-row">
		<div class="large-3 column">
			<div class="data-label">K1</div>
		</div>
		<div class="large-9 column">
			<div class="data-value" id="k1_<?php echo $side?>"><?php echo CHtml::encode($element->{'k1_'.$side}) ?></div>
		</div>
	</div>
	<div class="row field-row">
		<div class="large-3 column">
			<div class="data-label">K2</div>
		</div>
		<div class="large-9 column">
			<div class="data-value" id="k2_<?php echo $side?>"><?php echo CHtml::encode($element->{'k2_'.$side}) ?></div>
		</div>
	</div>
	<div class="row field-row">
		<div class="large-3 column">
			<div class="data-label">Axis K1</div>
		</div>
		<div class="large-9 column">
			<div class="data-value" id="axis_k1_<?php echo $side?>"><?php echo CHtml::encode($element->{'axis_k1_'.$side}) ?></div>
		</div>
	</div>
	<div class="row field-row">
		<div class="large-3 column">
			<div class="data-label">Axial length (mm)</div>
		</div>
		<div class="large-9 column">
			<div class="data-value" id="axial_length_<?php echo $side?>"><?php echo CHtml::encode($element->{'axial_length_'.$side}) ?></div>
		</div>
	</div>
	<div class="row field-row">
		<div class="large-3 column">
			<div class="data-label">SNR</div>
		</div>
		<div class="large-9 column">
			<div class="data-value" id="snr_<?php echo $side?>"><?php echo CHtml::encode($element->{'snr_'.$side}) ?></div>
		</div>
	</div>
	<div class="row">
		<?php
		foreach($measurementInput as $measurementData){
			$this->renderPartial('form_Element_OphInBiometry_Measurement_fields_iolRefValues', array('side' => $side, 'iolRefValues' => $measurementData));
			//var_dump(json_decode($measurementData->{"iol_ref_values_$side"}));
		}
		?>
	</div>
</div>