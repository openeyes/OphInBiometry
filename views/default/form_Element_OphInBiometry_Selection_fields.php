<div class="element-fields">
	<div class="row">
		<div class="large-12 column">

			<div id="div_Element_OphInBiometry_Selection_lens_id_right" class="row field-row">
				<?php
				$list = array_merge(array('0'=>'- Please select -'),CHtml::listData(OphInBiometry_LensType_Lens::model()->activeOrPk($element->{'lens_id_'.$side})->findAll(array('order'=> 'display_order asc')),'id','name'));
				?>
				<div class="large-3 column">
					<label for="Element_OphInBiometry_Selection[lens_id_<?php echo $side;?>]">Lens:</label>
				</div>
				<div class="large-6 column end">
					<select name="Element_OphInBiometry_Selection[lens_id_<?php echo $side;?>]" id="Element_OphInBiometry_Selection_lens_id_<?php echo $side;?>">
						<?php
						foreach( $list as $key => $value ){
							echo "<option value='{$key}'>{$value}</option>";
						}
						?>
					</select>

				</div>
			</div>
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
