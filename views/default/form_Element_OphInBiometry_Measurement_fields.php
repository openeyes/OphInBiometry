
<div class="element-fields">
	<div class="row">
		<div class="large-12 column">
			<div class="row field-row">
				<div class="large-4 column">
					<span class="field-info">K1 (D):</span>
				</div>
				<div class="large-2 column">
					<input type="text" id="Element_OphInBiometry_Measurement_k1_<?php echo $side; ?>" name="Element_OphInBiometry_Measurement[k1_<?php echo $side; ?>]" value="<?php echo $element->{"k1_$side"}?>">
				</div>
				<div class="large-4 column">
					<span class="field-info">Axis K1:</span>
				</div>
				<div class="large-2 column">
					<input type="text" id="Element_OphInBiometry_Measurement_axis_k1_<?php echo $side; ?>" name="Element_OphInBiometry_Measurement[axis_k1_<?php echo $side; ?>]" value="<?php echo $element->{"axis_k1_$side"}?>">
				</div>

			</div>
		</div>
	</div>
	<div class="row">
		<div class="large-12 column">
			<div class="row field-row">
				<div class="large-4 column">
					<span class="field-info">K2 (D):</span>
				</div>
				<div class="large-2 column">
					<input type="text" id="Element_OphInBiometry_Measurement_k2_<?php echo $side; ?>" name="Element_OphInBiometry_Measurement[k2_<?php echo $side; ?>]" value="<?php echo $element->{"k2_$side"}?>">
				</div>
				<div class="large-4 column">
					<span class="field-info">Axial length (mm):</span>
				</div>
				<div class="large-2 column">
					<input type="text" id="Element_OphInBiometry_Measurement_axial_length_<?php echo $side; ?>" name="Element_OphInBiometry_Measurement[axial_length_<?php echo $side; ?>]" value="<?php echo $element->{"axial_length_$side"}?>">
				</div>

			</div>
		</div>
	</div>
	<div class="row">
		<div class="large-12 column">
			<div class="row field-row">
				<div class="large-4 column">
					<span class="field-info"></span>
				</div>
				<div class="large-2 column">
					<span>&nbsp;</span>
				</div>
				<div class="large-4 column">
					<span class="field-info">SNR:</span>
				</div>
				<div class="large-2 column">
					<input type="text" id="Element_OphInBiometry_Measurement_snr_<?php echo $side; ?>" name="Element_OphInBiometry_Measurement[snr_<?php echo $side; ?>]" value="<?php echo $element->{"snr_$side"}?>">
				</div>

			</div>
		</div>
	</div>
</div>
