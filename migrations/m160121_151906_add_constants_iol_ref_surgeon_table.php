<?php

class m160121_151906_add_constants_iol_ref_surgeon_table extends CDbMigration
{
	public function up()
	{
		$this->createTable('ophinbiometry_surgeon', array(
			'id' => 'pk',
			'name' => 'varchar(255) NOT NULL'));

		$this->addColumn('et_ophinbiometry_iol_ref_values', 'constant', 'decimal(6,2)');
		$this->addColumn('et_ophinbiometry_iol_ref_values', 'constant1', 'decimal(6,2)');
		$this->addColumn('et_ophinbiometry_iol_ref_values', 'constant2', 'decimal(6,2)');
		$this->addColumn('et_ophinbiometry_iol_ref_values', 'active', 'boolean default true');
		$this->addColumn('et_ophinbiometry_iol_ref_values', 'surgeon_id', 'int(11)');
		$this->addForeignKey('surgeon_fk','et_ophinbiometry_iol_ref_values', 'surgeon_id', 'ophinbiometry_surgeon', 'id');
	}

	public function down()
	{
		$this->dropColumn('et_ophinbiometry_iol_ref_values', 'constant');
		$this->dropColumn('et_ophinbiometry_iol_ref_values', 'constant1');
		$this->dropColumn('et_ophinbiometry_iol_ref_values', 'constant2');
		$this->dropColumn('et_ophinbiometry_iol_ref_values', 'active');
		$this->dropForeignKey( 'surgeon_fk', 'et_ophinbiometry_iol_ref_values');
		$this->dropColumn('et_ophinbiometry_iol_ref_values', 'surgeon_id');

		$this->dropTable('ophinbiometry_surgeon');
	}


}