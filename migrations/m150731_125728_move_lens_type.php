<?php

class m150731_125728_move_lens_type extends CDbMigration
{
	public function up()
	{
		$this->dropForeignKey('ophinbiometry_lenstype_lens_l_fk', 'et_ophinbiometry_lenstype');
		$this->dropForeignKey('ophinbiometry_lenstype_lens_r_fk', 'et_ophinbiometry_lenstype');
		$this->dropColumn('et_ophinbiometry_lenstype', 'lens_id_left');
		$this->dropColumn('et_ophinbiometry_lenstype', 'lens_id_right');

		$this->addColumn('et_ophinbiometry_selection', 'lens_id_left', 'int(10) unsigned NOT NULL DEFAULT 1');
		$this->addColumn('et_ophinbiometry_selection', 'lens_id_right', 'int(10) unsigned NOT NULL DEFAULT 1');
		$this->addForeignKey('ophinbiometry_lenstype_lens_l_fk','et_ophinbiometry_selection', 'lens_id_left', 'ophinbiometry_lenstype_lens', 'id');
		$this->addForeignKey('ophinbiometry_lenstype_lens_r_fk','et_ophinbiometry_selection', 'lens_id_left', 'ophinbiometry_lenstype_lens', 'id');

		$this->dropColumn('et_ophinbiometry_lenstype_version', 'lens_id_left');
		$this->dropColumn('et_ophinbiometry_lenstype_version', 'lens_id_right');

		$this->addColumn('et_ophinbiometry_selection_version', 'lens_id_left', 'int(10) unsigned NOT NULL DEFAULT 1');
		$this->addColumn('et_ophinbiometry_selection_version', 'lens_id_right', 'int(10) unsigned NOT NULL DEFAULT 1');
	}

	public function down()
	{
		$this->dropForeignKey('ophinbiometry_lenstype_lens_l_fk', 'et_ophinbiometry_selection');
		$this->dropForeignKey('ophinbiometry_lenstype_lens_r_fk', 'et_ophinbiometry_selection');
		$this->dropColumn('et_ophinbiometry_selection', 'lens_id_left');
		$this->dropColumn('et_ophinbiometry_selection', 'lens_id_right');

		$this->addColumn('et_ophinbiometry_lenstype', 'lens_id_left', 'int(10) unsigned NOT NULL DEFAULT 1');
		$this->addColumn('et_ophinbiometry_lenstype', 'lens_id_right', 'int(10) unsigned NOT NULL DEFAULT 1');
		$this->addColumn('et_ophinbiometry_lenstype', 'lens_id_left', 'int(10) unsigned NOT NULL DEFAULT 1');
		$this->addColumn('et_ophinbiometry_lenstype', 'lens_id_right', 'int(10) unsigned NOT NULL DEFAULT 1');

		$this->dropColumn('et_ophinbiometry_selection_version', 'lens_id_left');
		$this->dropColumn('et_ophinbiometry_selection_version', 'lens_id_right');

		$this->addColumn('et_ophinbiometry_lenstype_version', 'lens_id_left', 'int(10) unsigned NOT NULL DEFAULT 1');
		$this->addColumn('et_ophinbiometry_lenstype_version', 'lens_id_right', 'int(10) unsigned NOT NULL DEFAULT 1');
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