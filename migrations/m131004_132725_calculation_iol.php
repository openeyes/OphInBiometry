<?php

class m131004_132725_calculation_iol extends CDbMigration
{
	public function up()
	{
		$this->addColumn('et_ophinbiometry_calculation','iol_type','int(10) unsigned NOT NULL');
	}

	public function down()
	{
		$this->dropColumn('et_ophinbiometry_calculation','iol_type');
	}
}
