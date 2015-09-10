<?php

class m150907_105613_iol_master_import extends OEMigration
{
	public function up()
	{

		$this->createOETable(
			'et_ophinbiometry_iol_ref_values',
			array(
				'id' => 'pk',
				'eye_id' => 'int(10) unsigned NOT NULL DEFAULT \'3\'',
				'event_id' => 'int(10) unsigned NOT NULL',
				'lens_id' => 'int(10) unsigned NOT NULL',
				'formula_id' => 'int(10) unsigned NOT NULL',
				'iol_ref_values_left' => 'text',
				'iol_ref_values_right' => 'text',
				'emmetropia_left'=>'decimal(6,2)',
				'emmetropia_right'=>'decimal(6,2)'
			),
			true
		);
		$this->addForeignKey('et_ophinbiometry_iol_ref_values_eye_fk', 'et_ophinbiometry_iol_ref_values', 'eye_id', 'eye', 'id');
		$this->addForeignKey('et_ophinbiometry_iol_ref_values_event_fk', 'et_ophinbiometry_iol_ref_values', 'event_id', 'event', 'id');
		$this->addForeignKey('et_ophinbiometry_iol_ref_values_lens_id_fk', 'et_ophinbiometry_iol_ref_values', 'lens_id', 'ophinbiometry_lenstype_lens', 'id');
		$this->addForeignKey('et_ophinbiometry_iol_ref_values_formula_id_fk', 'et_ophinbiometry_iol_ref_values', 'formula_id', 'ophinbiometry_calculation_formula', 'id');

		// if we import from DICOM file we will have a device + study ID value
		$this->addColumn('et_ophinbiometry_measurement', 'study_id', 'varchar(255)');
		$this->addColumn('et_ophinbiometry_measurement', 'device_id', 'varchar(255)');

//		$event_type = $this->dbConnection->createCommand()->select('id')->from('event_type')->where('class_name=:class_name', array(':class_name'=>'OphInBiometry'))->queryRow();
//		if (!$this->dbConnection->createCommand()->select('id')->from('element_type')->where('class_name=:class_name and event_type_id=:eventTypeId', array(':class_name'=>'Element_OphInBiometry_IolRefValues', ':eventTypeId'=>$event_type['id']))->queryRow()) {
//			$this->insert('element_type', array('name' => 'Biometry IOL and REF values', 'class_name' => 'Element_OphInBiometry_IolRefValues', 'event_type_id' => $event_type['id'], 'display_order' => 40));
//		}

//		$this->delete("element_type","class_name='Element_OphInBiometry_Calculation'");
	}

	public function down()
	{
		$this->dropTable('et_ophinbiometry_iol_ref_values');
		$this->dropTable('et_ophinbiometry_iol_ref_values_version');
		$this->dropColumn('et_ophinbiometry_measurement', 'study_id');
		$this->dropColumn('et_ophinbiometry_measurement', 'device_id');
//		$event_type = $this->dbConnection->createCommand()->select('id')->from('event_type')->where('class_name=:class_name', array(':class_name'=>'OphInBiometry'))->queryRow();

//		$this->delete("element_type","class_name='Element_OphInBiometry_IolRefValues'");

//		if (!$this->dbConnection->createCommand()->select('id')->from('element_type')->where('class_name=:class_name and event_type_id=:eventTypeId', array(':class_name'=>'Element_OphInBiometry_Calculation', ':eventTypeId'=>$event_type['id']))->queryRow()) {
//			$this->insert('element_type', array('name' => '[-Calculation-]', 'class_name' => 'Element_OphInBiometry_Calculation', 'event_type_id' => $event_type['id'], 'display_order' => 40));
//		}


	}

	/*
	// Use safeUp/safeDown to do migration with transaction
	public function safeUp()
	{
	}

	public function safeDown()
	{
	}
	*/
}