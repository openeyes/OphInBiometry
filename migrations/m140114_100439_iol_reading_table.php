<?php

class m140114_100439_iol_reading_table extends CDbMigration
{
	public function up()
	{
		$this->createTable('ophiniolmaster_iolreading', array(
				'id' => 'int(10) unsigned NOT NULL AUTO_INCREMENT',
				'iol_machine_id' => 'varchar(100) NOT NULL',
				'iol_poll_id' => 'varchar(100) NOT NULL',
				'first_name' => 'varchar(100) NOT NULL',
				'last_name' => 'varchar(100) NOT NULL',
				'patient_id' => 'int(10) unsigned NOT NULL',
				'patients_birth_date' => 'DATETIME NOT NULL DEFAULT \'1900-01-01 00:00:00\'',
				'data' => 'text COLLATE utf8_bin DEFAULT \'\'', // Data,
				'last_modified_user_id' => 'int(10) unsigned NOT NULL DEFAULT 1',
				'last_modified_date' => 'datetime NOT NULL DEFAULT \'1901-01-01 00:00:00\'',
				'created_user_id' => 'int(10) unsigned NOT NULL DEFAULT 1',
				'created_date' => 'datetime NOT NULL DEFAULT \'1901-01-01 00:00:00\'',
				'PRIMARY KEY (`id`)',
				'KEY `et_ophiniolmaster_iolreading_lmui_fk` (`last_modified_user_id`)',
				'KEY `et_ophiniolmaster_iolreading_cui_fk` (`created_user_id`)',
				'CONSTRAINT `et_ophiniolmaster_iolreading_lmui_fk` FOREIGN KEY (`last_modified_user_id`) REFERENCES `user` (`id`)',
				'CONSTRAINT `et_ophiniolmaster_iolreading_cui_fk` FOREIGN KEY (`created_user_id`) REFERENCES `user` (`id`)',
			), 'ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin');
	}

	public function down()
	{
		$this->dropTable('ophiniolmaster_iolreading');
	}


}
