<div class="element-data">
	<div class="row data-row">
		<div class="large-3 column"><div class="data-label"><?php echo CHtml::encode($element->getAttributeLabel('target_refraction_'.$side))?></div></div>
		<div class="large-9 column end"><div class="data-value"><?php echo CHtml::encode($element->{'target_refraction_'.$side})?></div></div>
	</div>
	<div class="row data-row">
		<div class="large-3 column"><div class="data-label"><?php echo CHtml::encode($element->getAttributeLabel('formula_id_'.$side))?></div></div>
		<div class="large-9 column end"><div class="data-value"><?php echo $element->{'formula_'.$side} ? $element->{'formula_'.$side}->name : 'None'?></div></div>
	</div>
</div>