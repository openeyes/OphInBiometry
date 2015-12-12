
<div class="element-data">

	<div class="row field-row">
		<div class="large-1 column">
			<div class="data-label">AL:</div>
		</div>
		<div class="large-5 column">
			<div class="data-value" id="axial_length_<?php echo $side?>"><?php echo CHtml::encode($element->{'axial_length_'.$side}) ?>&nbsp;mm</div>
		</div>
		<div class="large-1 column">
			<div class="data-label">SNR:</div>
		</div>
		<div class="large-5 column">
			<div class="data-value" id="snr_<?php echo $side?>"><?php echo CHtml::encode($element->{'snr_'.$side}) ?></div>
		</div>
	</div>

	<div class="row field-row">
		<div class="large-1 column">
			<div class="data-label">K1:</div>
		</div>
		<div class="large-2 column">
			<div class="data-value" id="k1_<?php echo $side?>"><?php echo CHtml::encode($element->{'k1_'.$side}) ?>&nbsp;D</div>
		</div>
		<div class="large-1 column">
			<div class="data-label">@</div>
		</div>
		<div class="large-2 column">
			<div class="data-value" id="axis_k1_<?php echo $side?>"><?php echo CHtml::encode($element->{'axis_k1_'.$side}) ?>&deg;</div>
		</div>

		<div class="large-1 column">
			<div class="data-label">&Delta;K:</div>
		</div>
		<div class="large-2 column">
			<div class="data-value" id="delta_k_<?php echo $side?>"><?php echo CHtml::encode($element->{'delta_k_'.$side}) ?>&nbsp;D</div>
		</div>
		<div class="large-1 column">
			<div class="data-label">@</div>
		</div>
		<div class="large-2 column">
			<div class="data-value" id="delta_k_axis_<?php echo $side?>"><?php echo CHtml::encode($element->{'delta_k_axis_'.$side}) ?>&deg;</div>
		</div>
	</div>

	<div class="row field-row">
		<div class="large-1 column">
			<div class="data-label">K2:</div>
		</div>
		<div class="large-2 column">
			<div class="data-value" id="k2_<?php echo $side?>"><?php echo CHtml::encode($element->{'k2_'.$side}) ?>&nbsp;D</div>
		</div>
		<div class="large-1 column">
			<div class="data-label">@</div>
		</div>
		<div class="large-2 column">
			<div class="data-value" id="k2_axis_<?php echo $side?>"><?php echo CHtml::encode($element->{'k2_axis_'.$side}) ?>&deg;</div>
		</div>
		<div class="large-1 column">
			<div class="data-label">ACD:</div>
		</div>
		<div class="large-5 column">
			<div class="data-value" id="acd_<?php echo $side?>"><?php echo CHtml::encode($element->{'acd_'.$side}) ?>&nbsp;mm</div>
		</div>
	</div>
	<div class="row field-row">
		<div class="large-2 column">
			<span class="field-info">Status:</span>
		</div>
		<div class="large-10 column">
			<div class="data-value" id="eye_status_<?php echo $side?>"><?php echo Eye_Status::model()->findByPk($element->{"eye_status_$side"})->name ?></div>
		</div>
	</div>
</div>