<?php

class m131210_144535_soft_deletion extends CDbMigration
{
	public function up()
	{
		$this->addColumn('ophinbiometry_calculation_formula','deleted','tinyint(1) unsigned not null');
		$this->addColumn('ophinbiometry_calculation_formula_version','deleted','tinyint(1) unsigned not null');
	}

	public function down()
	{
		$this->dropColumn('ophinbiometry_calculation_formula','deleted');
		$this->dropColumn('ophinbiometry_calculation_formula_version','deleted');
	}
}
