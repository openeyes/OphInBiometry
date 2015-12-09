<div class="element-fields">

	<div class="row">
		<div class="large-12 column">
			<div class="row field-row">
				<div class="large-1 column">
					<span class="field-info">AL:</span>
				</div>
				<div class="large-5 column">
					<?php
					if($this->is_auto)
					{
						echo '<span class="readonly-box">'.$element->{"axial_length_$side"}.'</span>&nbsp;mm';
					}
					else
					{
						?>
						<input type="text" id="Element_OphInBiometry_Measurement_axial_length_<?php echo $side; ?>" name="Element_OphInBiometry_Measurement[axial_length_<?php echo $side; ?>]" value="<?php echo $element->{"axial_length_$side"}?>">&nbsp;mm
						<?php
					}
					?>
				</div>
				<div class="large-1 column">
					<span class="field-info">SNR:</span>
				</div>
				<div class="large-5 column">
					<?php
					if($this->is_auto)
					{
						echo '<span class="readonly-box">'.$element->{"snr_$side"}.'</span>';
					}
					else
					{
						?>
						<input type="text" id="Element_OphInBiometry_Measurement_snr_<?php echo $side; ?>" name="Element_OphInBiometry_Measurement[snr_<?php echo $side; ?>]" value="<?php echo $element->{"snr_$side"}?>">
						<?php
					}
					?>
				</div>

			</div>
		</div>
	</div>

	<div class="row">
		<div class="large-12 column">
			<div class="row field-row">
				<div class="large-1 column">
					<span class="field-info">K1:</span>
				</div>
				<div class="large-2 column">
					<?php
					if($this->is_auto)
					{
						echo '<span class="readonly-box">'.$element->{"k1_$side"}.'</span>&nbsp;D';
					}
					else
					{
					?>
					<input type="text" id="Element_OphInBiometry_Measurement_k1_<?php echo $side; ?>" name="Element_OphInBiometry_Measurement[k1_<?php echo $side; ?>]" value="<?php echo $element->{"k1_$side"}?>">D
						<?php
					}
					?>
				</div>
				<div class="large-1 column">
					<span class="field-info">@</span>
				</div>
				<div class="large-2 column">
					<?php
					if($this->is_auto)
					{
						echo '<span class="readonly-box">'.$element->{"axis_k1_$side"}.'</span>&nbsp;&deg;';
					}
					else
					{
						?>
						<input type="text" id="Element_OphInBiometry_Measurement_axis_k1_<?php echo $side; ?>" name="Element_OphInBiometry_Measurement[axis_k1_<?php echo $side; ?>]" value="<?php echo $element->{"axis_k1_$side"}?>">&deg;
						<?php
					}
					?>
				</div>
				<div class="large-1 column">
					<span class="field-info">&Delta;K:</span>
				</div>
				<div class="large-2 column">
					<?php
					if($this->is_auto)
					{
						echo '<span class="readonly-box">'.$element->{"delta_k_$side"}.'</span>&nbsp;D';
					}
					else
					{
					?>
					<input type="text" id="Element_OphInBiometry_Measurement_delta_k_<?php echo $side; ?>" name="Element_OphInBiometry_Measurement[delta_k_<?php echo $side; ?>]" value="<?php echo $element->{"delta_k_$side"}?>">D
						<?php
					}
					?>
				</div>
				<div class="large-1 column">
					<span class="field-info">@</span>
				</div>
				<div class="large-2 column">
					<?php
					if($this->is_auto)
					{
						echo '<span class="readonly-box">'.$element->{"delta_k_axis_$side"}.'</span>&nbsp;&deg;';
					}
					else
					{
						?>
						<input type="text" id="Element_OphInBiometry_Measurement_delta_k_axis_<?php echo $side; ?>" name="Element_OphInBiometry_Measurement[delta_k_axis_<?php echo $side; ?>]" value="<?php echo $element->{"delta_k_axis_$side"}?>">&deg;
						<?php
					}
					?>
				</div>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="large-12 column">
			<div class="row field-row">
				<div class="large-1 column">
					<span class="field-info">K2:</span>
				</div>
				<div class="large-2 column ">
					<?php
					if($this->is_auto)
					{
						echo '<span class="readonly-box">'.$element->{"k2_$side"}.'</span>&nbsp;D';
					}
					else
					{
					?>
						<input type="text" id="Element_OphInBiometry_Measurement_k2_<?php echo $side; ?>" name="Element_OphInBiometry_Measurement[k2_<?php echo $side; ?>]" value="<?php echo $element->{"k2_$side"}?>">D
					<?php
					}
					?>
				</div>
				<div class="large-1 column">
					<span class="field-info">@</span>
				</div>
				<div class="large-2 column">
					<?php
					if($this->is_auto)
					{
						echo '<span class="readonly-box">'.$element->{"k2_axis_$side"}.'</span>&nbsp;&deg;';
					}
					else
					{
						?>
						<input type="text" id="Element_OphInBiometry_Measurement_k2_axis_<?php echo $side; ?>" name="Element_OphInBiometry_Measurement[k2_axis_<?php echo $side; ?>]" value="<?php echo $element->{"k2_axis_$side"}?>">&deg;
						<?php
					}
					?>
				</div>

				<div class="large-1 column">
					<span class="field-info">ACD:</span>
				</div>
				<div class="large-5 column">
					<?php
					if($this->is_auto)
					{
						echo '<span class="readonly-box">'.$element->{"acd_$side"}.'</span>&nbsp;mm';
					}
					else
					{
					?>
						<input type="text" id="Element_OphInBiometry_Measurement_acd_<?php echo $side; ?>" name="Element_OphInBiometry_Measurement[acd_<?php echo $side; ?>]" value="<?php echo $element->{"acd_$side"}?>">&nbsp;mm
					<?php
					}
					?>
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
				<div class="large-1 column">
					<span class="field-info">Status:</span>
				</div>
				<div class="large-5 column">
					<?php
					if($this->is_auto)
					{
						echo '<span class="readonly-box">'.$element->{"eye_status_$side"}.'</span>';
					}
					else
					{
					?>
					<input type="text" id="Element_OphInBiometry_Measurement_eye_status_<?php echo $side; ?>" name="Element_OphInBiometry_Measurement[eye_status_<?php echo $side; ?>]" value="<?php echo $element->{"eye_status_$side"}?>">
						<?php
					}
					?>
				</div>

			</div>
		</div>
	</div>
</div>
