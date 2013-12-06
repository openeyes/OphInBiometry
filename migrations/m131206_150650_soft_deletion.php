<?php

class m131206_150650_soft_deletion extends CDbMigration
{
	public function up()
	{
		$this->addColumn('et_ophinbiometry_calculation','deleted','tinyint(1) unsigned not null');
		$this->addColumn('et_ophinbiometry_calculation_version','deleted','tinyint(1) unsigned not null');
		$this->addColumn('et_ophinbiometry_measurement','deleted','tinyint(1) unsigned not null');
		$this->addColumn('et_ophinbiometry_measurement_version','deleted','tinyint(1) unsigned not null');
	}

	public function down()
	{
		$this->dropColumn('et_ophinbiometry_calculation','deleted');
		$this->dropColumn('et_ophinbiometry_calculation_version','deleted');
		$this->dropColumn('et_ophinbiometry_measurement','deleted');
		$this->dropColumn('et_ophinbiometry_measurement_version','deleted');
	}
}
