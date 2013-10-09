<?php

class m131009_072741_change_measurement_field_types extends CDbMigration
{
	public function up()
	{
		$this->alterColumn('et_ophinbiometry_measurement','right_axial_length','varchar(16) collate utf8_bin not null');
		$this->alterColumn('et_ophinbiometry_measurement','left_axial_length','varchar(16) collate utf8_bin not null');
		$this->alterColumn('et_ophinbiometry_measurement','right_k1','varchar(16) collate utf8_bin not null');
		$this->alterColumn('et_ophinbiometry_measurement','left_k1','varchar(16) collate utf8_bin not null');
		$this->alterColumn('et_ophinbiometry_measurement','right_k2','varchar(16) collate utf8_bin not null');
		$this->alterColumn('et_ophinbiometry_measurement','left_k2','varchar(16) collate utf8_bin not null');
	}

	public function down()
	{
		$this->alterColumn('et_ophinbiometry_measurement','right_axial_length','decimal(3,1) NOT NULL');
		$this->alterColumn('et_ophinbiometry_measurement','left_axial_length','decimal(3,1) NOT NULL');
		$this->alterColumn('et_ophinbiometry_measurement','right_k1','decimal(3,1) NOT NULL');
		$this->alterColumn('et_ophinbiometry_measurement','left_k1','decimal(3,1) NOT NULL');
		$this->alterColumn('et_ophinbiometry_measurement','right_k2','decimal(3,1) NOT NULL');
		$this->alterColumn('et_ophinbiometry_measurement','left_k2','decimal(3,1) NOT NULL');
	}
}
