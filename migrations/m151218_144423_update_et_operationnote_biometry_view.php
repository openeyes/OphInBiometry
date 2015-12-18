<?php

class m151218_144423_update_et_operationnote_biometry_view extends CDbMigration
{
	public function up()
	{
		$this->execute("CREATE OR REPLACE VIEW et_ophtroperationnote_biometry AS SELECT
							eol.id, eol.eye_id, eol.last_modified_date, target_refraction_left, target_refraction_right,
							(SELECT name FROM ophinbiometry_lenstype_lens oll WHERE oll.id=lens_id_left) as lens_left,
							(SELECT description FROM ophinbiometry_lenstype_lens oll WHERE oll.id=lens_id_left) as lens_description_left,
							(SELECT acon FROM ophinbiometry_lenstype_lens oll WHERE oll.id=lens_id_left) AS lens_acon_left,
							(SELECT name FROM ophinbiometry_lenstype_lens oll WHERE oll.id=lens_id_right) as lens_right,
							(SELECT description FROM ophinbiometry_lenstype_lens oll WHERE oll.id=lens_id_right) as lens_description_right,
							(SELECT acon FROM ophinbiometry_lenstype_lens oll WHERE oll.id=lens_id_right) AS lens_acon_right,
							k1_left, k1_right, k2_left, k2_right, axis_k1_left, axis_k1_right, axial_length_left, axial_length_right,
							snr_left, snr_right, iol_power_left, iol_power_right, predicted_refraction_left, predicted_refraction_right, patient_id,
                            k2_axis_left, k2_axis_right, delta_k_left, delta_k_right, delta_k_axis_left, delta_k_axis_right, acd_left, acd_right,
                            (SELECT name FROM dicom_eye_status oes WHERE oes.id=lens_id_left) as status_left,
                            (SELECT name FROM dicom_eye_status oes WHERE oes.id=lens_id_right) as status_right,
                            comments
							FROM et_ophinbiometry_measurement eol
							JOIN et_ophinbiometry_calculation eoc ON eoc.event_id=eol.event_id
							JOIN et_ophinbiometry_selection eos ON eos.event_id=eol.event_id
							JOIN event ev ON ev.id=eol.event_id
							JOIN episode ep ON ep.id=ev.episode_id
							ORDER BY eol.last_modified_date;");
	}

	public function down()
	{

		$this->execute("CREATE OR REPLACE VIEW et_ophtroperationnote_biometry AS SELECT
							eol.id, eol.eye_id, eol.last_modified_date, target_refraction_left, target_refraction_right,
							(SELECT name FROM ophinbiometry_lenstype_lens oll WHERE oll.id=lens_id_left) as lens_left,
							(SELECT description FROM ophinbiometry_lenstype_lens oll WHERE oll.id=lens_id_left) as lens_description_left,
							(SELECT acon FROM ophinbiometry_lenstype_lens oll WHERE oll.id=lens_id_left) AS lens_acon_left,
							(SELECT name FROM ophinbiometry_lenstype_lens oll WHERE oll.id=lens_id_right) as lens_right,
							(SELECT description FROM ophinbiometry_lenstype_lens oll WHERE oll.id=lens_id_right) as lens_description_right,
							(SELECT acon FROM ophinbiometry_lenstype_lens oll WHERE oll.id=lens_id_right) AS lens_acon_right,
							k1_left, k1_right, k2_left, k2_right, axis_k1_left, axis_k1_right, axial_length_left, axial_length_right,
							snr_left, snr_right, iol_power_left, iol_power_right, predicted_refraction_left, predicted_refraction_right, patient_id
							FROM et_ophinbiometry_measurement eol
							JOIN et_ophinbiometry_calculation eoc ON eoc.event_id=eol.event_id
							JOIN et_ophinbiometry_selection eos ON eos.event_id=eol.event_id
							JOIN event ev ON ev.id=eol.event_id
							JOIN episode ep ON ep.id=ev.episode_id
							ORDER BY eol.last_modified_date;");
	}


}