<?php

class m150731_125728_move_lens_type extends CDbMigration
{
	public function up()
	{
		//Drop key
		$this->dropForeignKey('ophinbiometry_lenstype_lens_l_fk', 'et_ophinbiometry_lenstype');
		$this->dropForeignKey('ophinbiometry_lenstype_lens_r_fk', 'et_ophinbiometry_lenstype');

		//Drop and add on main table
		$this->dropColumn('et_ophinbiometry_lenstype', 'lens_id_left');
		$this->dropColumn('et_ophinbiometry_lenstype', 'lens_id_right');
		$this->addColumn('et_ophinbiometry_selection', 'lens_id_left', 'int(10) unsigned NOT NULL DEFAULT 1');
		$this->addColumn('et_ophinbiometry_selection', 'lens_id_right', 'int(10) unsigned NOT NULL DEFAULT 1');

		//Drop and add on version tables
		$this->dropColumn('et_ophinbiometry_lenstype_version', 'lens_id_left');
		$this->dropColumn('et_ophinbiometry_lenstype_version', 'lens_id_right');
		$this->addColumn('et_ophinbiometry_selection_version', 'lens_id_left', 'int(10) unsigned NOT NULL DEFAULT 1');
		$this->addColumn('et_ophinbiometry_selection_version', 'lens_id_right', 'int(10) unsigned NOT NULL DEFAULT 1');

		//Add new key
		$this->addForeignKey('ophinbiometry_lenstype_lens_l_fk','et_ophinbiometry_selection', 'lens_id_left', 'ophinbiometry_lenstype_lens', 'id');
		$this->addForeignKey('ophinbiometry_lenstype_lens_r_fk','et_ophinbiometry_selection', 'lens_id_right', 'ophinbiometry_lenstype_lens', 'id');

		//Rename the table last
		$this->renameTable('et_ophinbiometry_lenstype', 'et_ophinbiometry_measurement');
		$this->renameTable('et_ophinbiometry_lenstype_version', 'et_ophinbiometry_measurement_version');

		//Update element
		$this->update('element_type', array('class_name' => 'Element_OphInBiometry_Measurement', 'name' => 'Measurements'), 'class_name="Element_OphInBiometry_LensType"');
	}

	public function down()
	{
		//Rename the table first
		$this->renameTable('et_ophinbiometry_measurement', 'et_ophinbiometry_lenstype');
		$this->renameTable('et_ophinbiometry_measurement_version', 'et_ophinbiometry_lenstype_version');

		//Drop key
		$this->dropForeignKey('ophinbiometry_lenstype_lens_l_fk', 'et_ophinbiometry_selection');
		$this->dropForeignKey('ophinbiometry_lenstype_lens_r_fk', 'et_ophinbiometry_selection');

		//Drop and add on main table
		$this->dropColumn('et_ophinbiometry_selection', 'lens_id_left');
		$this->dropColumn('et_ophinbiometry_selection', 'lens_id_right');
		$this->addColumn('et_ophinbiometry_lenstype', 'lens_id_left', 'int(10) unsigned NOT NULL DEFAULT 1');
		$this->addColumn('et_ophinbiometry_lenstype', 'lens_id_right', 'int(10) unsigned NOT NULL DEFAULT 1');

		//Drop and add on version tables
		$this->dropColumn('et_ophinbiometry_selection_version', 'lens_id_left');
		$this->dropColumn('et_ophinbiometry_selection_version', 'lens_id_right');
		$this->addColumn('et_ophinbiometry_lenstype_version', 'lens_id_left', 'int(10) unsigned NOT NULL DEFAULT 1');
		$this->addColumn('et_ophinbiometry_lenstype_version', 'lens_id_right', 'int(10) unsigned NOT NULL DEFAULT 1');

		//Add new key
		$this->addForeignKey('ophinbiometry_lenstype_lens_l_fk','et_ophinbiometry_lenstype', 'lens_id_left', 'ophinbiometry_lenstype_lens', 'id');
		$this->addForeignKey('ophinbiometry_lenstype_lens_r_fk','et_ophinbiometry_lenstype', 'lens_id_right', 'ophinbiometry_lenstype_lens', 'id');

		//Update element
		$this->update('element_type', array('class_name' => 'Element_OphInBiometry_LensType', 'name' => 'Lens Type'), 'class_name="Element_OphInBiometry_Measurement"');
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