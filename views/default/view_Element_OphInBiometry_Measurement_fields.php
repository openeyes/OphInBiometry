
<div class="element-data">

	<div class="row field-row">
		<div class="large-1 column">
			<div class="field-info">AL:</div>
		</div>
		<div class="large-5 column">
			<div class="field-info" id="axial_length_<?php echo $side?>"><?php echo CHtml::encode($element->{'axial_length_'.$side}) ?>&nbsp;mm</div>
		</div>
		<?php
		if(!$element->{"al_modified_$side"}) {
		?>
		<div class="large-1 column">
			<div class="field-info">SNR:</div>
		</div>
		<div class="large-5 column">
			<div class="field-info" id="snr_<?php echo $side?>"><?php echo CHtml::encode($element->{'snr_'.$side}) ?></div>
		</div>
		<?php
		}else{
			echo '<div class="large-6 column"><span class="field-info">* AL entered manually</span></div>';
		}
		?>
	</div>

	<div class="row field-row">
		<div class="large-1 column">
			<div class="field-info">K1:</div>
		</div>
		<div class="large-2 column">
			<div class="field-info" id="k1_<?php echo $side?>"><?php echo CHtml::encode($element->{'k1_'.$side}) ?>&nbsp;D</div>
		</div>
		<div class="large-1 column">
			<?php
			if(!$element->{"k_modified_$side"}) {
				?>
				<span class="field-info">@</span>
			<?php } else {?>
				<span class="field-info"><b>*</b></span>
			<?php } ?>
		</div>
		<div class="large-2 column">
			<?php
			if(!$element->{"k_modified_$side"}) {
			?>
			<div class="field-info" id="axis_k1_<?php echo $side?>"><?php echo CHtml::encode($element->{'axis_k1_'.$side}) ?>&deg;</div>
			<?php }else{
				echo '&nbsp;';
			}?>
		</div>

		<div class="large-1 column">
			<div class="field-info">&Delta;K:</div>
		</div>
		<div class="large-2 column">
			<div class="field-info" id="delta_k_<?php echo $side?>"><?php echo CHtml::encode($element->{'delta_k_'.$side}) ?>&nbsp;D</div>
		</div>
		<div class="large-1 column">
			<?php
			if(!$element->{"k_modified_$side"}) {
				?>
				<span class="field-info">@</span>
			<?php } else {?>
				<span class="field-info"><b>*</b></span>
			<?php } ?>
		</div>
		<div class="large-2 column">
			<?php
			if(!$element->{"k_modified_$side"}) {
			?>
			<div class="field-info" id="delta_k_axis_<?php echo $side?>"><?php echo CHtml::encode($element->{'delta_k_axis_'.$side}) ?>&deg;</div>
			<?php }else{
				echo '&nbsp;';
			}?>
		</div>
	</div>

	<div class="row field-row">
		<div class="large-1 column">
			<div class="field-info">K2:</div>
		</div>
		<div class="large-2 column">
			<div class="field-info" id="k2_<?php echo $side?>"><?php echo CHtml::encode($element->{'k2_'.$side}) ?>&nbsp;D</div>
		</div>
		<div class="large-1 column">
			<?php
			if(!$element->{"k_modified_$side"}) {
				?>
				<span class="field-info">@</span>
			<?php } else {?>
				<span class="field-info"><b>*</b></span>
			<?php } ?>
		</div>
		<div class="large-2 column">
			<?php
			if(!$element->{"k_modified_$side"}) {
				?>
			<div class="field-info" id="k2_axis_<?php echo $side?>"><?php echo CHtml::encode($element->{'k2_axis_'.$side}) ?>&deg;</div>
			<?php }else{
				echo '&nbsp;';
			}?>
		</div>
		<div class="large-1 column">
			<div class="field-info">ACD:</div>
		</div>
		<div class="large-5 column">
			<div class="field-info" id="acd_<?php echo $side?>"><?php echo CHtml::encode($element->{'acd_'.$side}) ?>&nbsp;mm</div>
		</div>
	</div>
	<div class="row field-row">
		<div class="large-2 column">
			<span class="field-info">Status:</span>
		</div>
		<div class="large-10 column">
			<div class="field-info" id="eye_status_<?php echo $side?>"><?php echo Eye_Status::model()->findByPk($element->{"eye_status_$side"})->name ?></div>
		</div>
	</div>
</div>