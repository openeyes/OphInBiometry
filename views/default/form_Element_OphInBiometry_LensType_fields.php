
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
					<span id="type_<?php echo $side?>" class="field-info"></span>
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
					<span id="acon_<?php echo $side?>" class="field-info"></span>
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="large-12 column">
			<div class="row field-row">
				<div class="large-3 column">
					<span class="field-info">SF:</span>
				</div>
				<div class="large-9 column">
					<span id="sf_<?php echo $side?>" class="field-info"></span>
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="large-12 column">
			<div class="row field-row">
				<div class="large-3 column">
					<span class="field-info">Position:</span>
				</div>
				<div class="large-9 column">
					<span id="position_<?php echo $side?>" class="field-info"></span>
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="large-12 column">
			<div class="row field-row">
				<div class="large-3 column">
					<span class="field-info">Comments:</span>
				</div>
				<div class="large-9 column">
					<span id="comments_<?php echo $side?>" class="field-info"></span>
				</div>
			</div>
		</div>
	</div>
</div>
