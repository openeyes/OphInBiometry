
<div class="element-fields">
	<div class="row">
		<div class="large-12 column">
			<?php

			$post = Yii::app()->request->getPost('Element_OphInBiometry_Selection');

			if($element->isNewRecord && empty($post) ){
				$element->lens_id_left = null;
				$element->lens_id_right = null;
			}
			echo $form->dropDownList($element, 'lens_id_'.$side, CHtml::listData(OphInBiometry_LensType_Lens::model()->activeOrPk($element->{'lens_id_'.$side})->findAll(array('order'=> 'display_order asc')),'id','name'),array('empty'=>'- Please select -'),null,array('label'=>3, 'field'=>6))
			?>
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
	<div id="div_Element_OphInBiometry_Selection_<?php echo $side?>" >
		<?php echo $form->textField($element, 'iol_power_'.$side, null, null, array('label'=>4, 'field'=>2))?>
		<?php echo $form->textField($element, 'predicted_refraction_'.$side, null, null, array('label'=>4, 'field'=>2))?>
	</div>
</div>
