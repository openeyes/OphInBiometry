
<div class="element-data">
	<div class="row data-row">
		<div class="large-3 column"><div class="data-label"><?php echo CHtml::encode($element->getAttributeLabel('iol_power_'.$side))?></div></div>
		<div class="large-9 column end"><div class="iolDisplay"><?php echo CHtml::encode($element->{'iol_power_'.$side})?></div></div>
	</div>
	<div class="row data-row">
		<div class="large-3 column"><div class="data-label"><?php echo CHtml::encode($element->getAttributeLabel('predicted_refraction_'.$side))?></div></div>
		<div class="large-9 column end"><div class="data-value" id="tr_<?php echo $side?>"><?php echo CHtml::encode($element->{'predicted_refraction_'.$side})?></div></div>
	</div>
</div>