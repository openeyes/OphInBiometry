
<div class="element-data">
	<div class="row data-row">
		<div class="large-3 column"><div class="data-label"><?php echo CHtml::encode($element->getAttributeLabel('lens_id_'.$side))?></div></div>
		<div class="large-9 column end"><div class="data-value" id="lens_<?php echo $side?>"><?php echo $element->{'lens_'.$side} ? $element->{'lens_'.$side}->name : 'None'?></div></div>
	</div>
	<div class="row field-row">
		<div class="large-3 column">
			<div class="data-label">Description</div>
		</div>
		<div class="large-9 column">
			<div class="data-value" id="type_<?php echo $side?>"><?php echo $element->{'lens_'.$side} ? $element->{'lens_'.$side}->description : 'None'?></div>
		</div>
	</div>
	<div class="row field-row">
		<div class="large-3 column">
			<div class="data-label">A constant</div>
		</div>
		<div class="large-9 column">
			<div class="data-value" id="acon_<?php echo $side?>"><?php echo $element->{'lens_'.$side} ? $element->{'lens_'.$side}->acon : 'None'?></div>
		</div>
	</div>
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
</div>