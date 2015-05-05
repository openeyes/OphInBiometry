
<div class="element-fields">
	<div id="div_Element_OphInBiometry_Selection_<?php echo $side?>" class="row field-row">
		<div class="large-3 column">
			<label for="Element_OphInBiometry_Selection_iol_power_<?php echo $side?>"><?php echo $element->getAttributeLabel("iol_power_$side")?>:</label>
		</div>
		<div class="large-3 column end">
			<input type="text" name="Element_OphInBiometry_Selection[iol_power_<?php echo $side?>]" value="<?php echo $element->{"iol_power_$side"}?>" autocomplete="off" />
		</div>
		<div class="large-3 column">
			<label for="Element_OphInBiometry_Selection_predicted_refraction_<?php echo $side?>"><?php echo $element->getAttributeLabel("predicted_refraction_$side")?>:</label>
		</div>
		<div class="large-3 column end">
			<input type="text" name="Element_OphInBiometry_Selection[predicted_refraction_<?php echo $side?>]" value="<?php echo $element->{"predicted_refraction_$side"}?>" autocomplete="off" />
		</div>
	</div>
</div>
