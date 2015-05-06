<?php

class m150505_124200_changeFieldsBiometryDat extends CDbMigration
{
	public function up()
	{
		$this->renameColumn('et_ophinbiometry_biometrydat','r1_left','k1_left');
		$this->renameColumn('et_ophinbiometry_biometrydat','r1_right','k1_right');
		$this->renameColumn('et_ophinbiometry_biometrydat','r2_left','k2_left');
		$this->renameColumn('et_ophinbiometry_biometrydat','r2_right','k2_right');
		$this->renameColumn('et_ophinbiometry_biometrydat','r1_axis_left','axis_k1_left');
		$this->renameColumn('et_ophinbiometry_biometrydat','r1_axis_right','axis_k1_right');
		$this->alterColumn('et_ophinbiometry_biometrydat','axis_k1_left','decimal(4,1) not null default 0');
		$this->alterColumn('et_ophinbiometry_biometrydat','axis_k1_right','decimal(4,1) not null default 0');
		$this->renameColumn('et_ophinbiometry_biometrydat_version','r1_left','k1_left');
		$this->renameColumn('et_ophinbiometry_biometrydat_version','r1_right','k1_right');
		$this->renameColumn('et_ophinbiometry_biometrydat_version','r2_left','k2_left');
		$this->renameColumn('et_ophinbiometry_biometrydat_version','r2_right','k2_right');
		$this->renameColumn('et_ophinbiometry_biometrydat_version','r1_axis_left','axis_k1_left');
		$this->renameColumn('et_ophinbiometry_biometrydat_version','r1_axis_right','axis_k1_right');
		$this->alterColumn('et_ophinbiometry_biometrydat_version','axis_k1_left','decimal(4,1) not null default 0');
		$this->alterColumn('et_ophinbiometry_biometrydat_version','axis_k1_right','decimal(4,1) not null default 0');
		$this->addColumn('et_ophinbiometry_lenstype','k1_left','decimal(4,2) not null default 0');
		$this->addColumn('et_ophinbiometry_lenstype','k1_right','decimal(4,2) not null default 0');
		$this->addColumn('et_ophinbiometry_lenstype','k2_left','decimal(4,2) not null default 0');
		$this->addColumn('et_ophinbiometry_lenstype','k2_right','decimal(4,2) not null default 0');
		$this->addColumn('et_ophinbiometry_lenstype','axis_k1_left','decimal(4,1) not null default 0');
		$this->addColumn('et_ophinbiometry_lenstype','axis_k1_right','decimal(4,1) not null default 0');
		$this->addColumn('et_ophinbiometry_lenstype','axial_length_left','decimal(4,2) not null default 0');
		$this->addColumn('et_ophinbiometry_lenstype','axial_length_right','decimal(4,2) not null default 0');
		$this->addColumn('et_ophinbiometry_lenstype','snr_left','decimal(4,1) not null default 0');
		$this->addColumn('et_ophinbiometry_lenstype','snr_right','decimal(4,1) not null default 0');
		$this->addColumn('et_ophinbiometry_lenstype_version','k1_left','decimal(4,2) not null default 0');
		$this->addColumn('et_ophinbiometry_lenstype_version','k1_right','decimal(4,2) not null default 0');
		$this->addColumn('et_ophinbiometry_lenstype_version','k2_left','decimal(4,2) not null default 0');
		$this->addColumn('et_ophinbiometry_lenstype_version','k2_right','decimal(4,2) not null default 0');
		$this->addColumn('et_ophinbiometry_lenstype_version','axis_k1_left','decimal(4,1) not null default 0');
		$this->addColumn('et_ophinbiometry_lenstype_version','axis_k1_right','decimal(4,1) not null default 0');
		$this->addColumn('et_ophinbiometry_lenstype_version','axial_length_left','decimal(4,2) not null default 0');
		$this->addColumn('et_ophinbiometry_lenstype_version','axial_length_right','decimal(4,2) not null default 0');
		$this->addColumn('et_ophinbiometry_lenstype_version','snr_left','decimal(4,1) not null default 0');
		$this->addColumn('et_ophinbiometry_lenstype_version','snr_right','decimal(4,1) not null default 0');
		$this->alterColumn('et_ophinbiometry_selection','iol_power_left', 'decimal(4,2) not null default 0');
		$this->alterColumn('et_ophinbiometry_selection','iol_power_right', 'decimal(4,2) not null default 0');
		$this->alterColumn('et_ophinbiometry_selection','predicted_refraction_left', 'decimal(4,2) not null default 0');
		$this->alterColumn('et_ophinbiometry_selection','predicted_refraction_right', 'decimal(4,2) not null default 0');
		$this->alterColumn('et_ophinbiometry_calculation','target_refraction_left', 'decimal(4,2) not null default 0');
		$this->alterColumn('et_ophinbiometry_calculation','target_refraction_right', 'decimal(4,2) not null default 0');


	}

	public function down()
	{
		$this->dropColumn('et_ophinbiometry_lenstype','k1_left');
		$this->dropColumn('et_ophinbiometry_lenstype','k1_right');
		$this->dropColumn('et_ophinbiometry_lenstype','k2_left');
		$this->dropColumn('et_ophinbiometry_lenstype','k2_right');
		$this->dropColumn('et_ophinbiometry_lenstype','axis_k1_left');
		$this->dropColumn('et_ophinbiometry_lenstype','axis_k1_right');
		$this->dropColumn('et_ophinbiometry_lenstype','axial_length_left');
		$this->dropColumn('et_ophinbiometry_lenstype','axial_length_right');
		$this->dropColumn('et_ophinbiometry_lenstype','snr_left');
		$this->dropColumn('et_ophinbiometry_lenstype','snr_right');
		$this->dropColumn('et_ophinbiometry_lenstype_version','k1_left');
		$this->dropColumn('et_ophinbiometry_lenstype_version','k1_right');
		$this->dropColumn('et_ophinbiometry_lenstype_version','k2_left');
		$this->dropColumn('et_ophinbiometry_lenstype_version','k2_right');
		$this->dropColumn('et_ophinbiometry_lenstype_version','axis_k1_left');
		$this->dropColumn('et_ophinbiometry_lenstype_version','axis_k1_right');
		$this->dropColumn('et_ophinbiometry_lenstype_version','axial_length_left');
		$this->dropColumn('et_ophinbiometry_lenstype_version','axial_length_right');
		$this->dropColumn('et_ophinbiometry_lenstype_version','snr_left');
		$this->dropColumn('et_ophinbiometry_lenstype_version','snr_right');
		$this->alterColumn('et_ophinbiometry_biometrydat','axis_k1_left','int(10) not null default 134');
		$this->alterColumn('et_ophinbiometry_biometrydat','axis_k1_right','int(10) not null default 134');
		$this->renameColumn('et_ophinbiometry_biometrydat','k1_left','r1_left');
		$this->renameColumn('et_ophinbiometry_biometrydat','k1_right','r1_right');
		$this->renameColumn('et_ophinbiometry_biometrydat','k2_left','r2_left');
		$this->renameColumn('et_ophinbiometry_biometrydat','k2_right','r2_right');
		$this->renameColumn('et_ophinbiometry_biometrydat','axis_k1_left','r1_axis_left');
		$this->renameColumn('et_ophinbiometry_biometrydat','axis_k1_right','r1_axis_right');
		$this->alterColumn('et_ophinbiometry_biometrydat_version','axis_k1_left','int(10) not null default 134');
		$this->alterColumn('et_ophinbiometry_biometrydat_version','axis_k1_right','int(10) not null default 134');
		$this->renameColumn('et_ophinbiometry_biometrydat_version','k1_left','r1_left');
		$this->renameColumn('et_ophinbiometry_biometrydat_version','k1_right','r1_right');
		$this->renameColumn('et_ophinbiometry_biometrydat_version','k2_left','r2_left');
		$this->renameColumn('et_ophinbiometry_biometrydat_version','k2_right','r2_right');
		$this->renameColumn('et_ophinbiometry_biometrydat_version','axis_k1_left','r1_axis_left');
		$this->renameColumn('et_ophinbiometry_biometrydat_version','axis_k1_right','r1_axis_right');
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