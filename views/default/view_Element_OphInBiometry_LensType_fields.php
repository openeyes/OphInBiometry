
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
			<div class="data-value" id="type_<?php echo $side?>"></div>
		</div>
	</div>
	<div class="row field-row">
		<div class="large-3 column">
			<div class="data-label">A constant</div>
		</div>
		<div class="large-9 column">
			<div class="data-value" id="acon_<?php echo $side?>"></div>
		</div>
	</div>
	<div class="row field-row">
		<div class="large-3 column">
			<div class="data-label">SF</div>
		</div>
		<div class="large-9 column">
			<div class="data-value" id="sf_<?php echo $side?>"></div>
		</div>
	</div>
	<div class="row field-row">
		<div class="large-3 column">
			<div class="data-label">Position</div>
		</div>
		<div class="large-9 column">
			<div class="data-value" id="position_<?php echo $side?>"></div>
		</div>
	</div>
	<div class="row field-row">
		<div class="large-3 column">
			<div class="data-label">Comments</div>
		</div>
		<div class="large-9 column">
			<div class="data-value" id="comments_<?php echo $side?>"></div>
		</div>
	</div>
</div>