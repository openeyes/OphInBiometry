<?php 
class m140129_150855_event_type_OphInBiometry extends CDbMigration
{
	public function up()
	{
		if (!$this->dbConnection->createCommand()->select('id')->from('event_type')->where('class_name=:class_name', array(':class_name'=>'OphInBiometry'))->queryRow()) {
			$group = $this->dbConnection->createCommand()->select('id')->from('event_group')->where('name=:name',array(':name'=>'Investigation events'))->queryRow();
			$this->insert('event_type', array('class_name' => 'OphInBiometry', 'name' => 'Biometry','event_group_id' => $group['id']));
		}
		$event_type = $this->dbConnection->createCommand()->select('id')->from('event_type')->where('class_name=:class_name', array(':class_name'=>'OphInBiometry'))->queryRow();

		if (!$this->dbConnection->createCommand()->select('id')->from('element_type')->where('name=:name and event_type_id=:eventTypeId', array(':name'=>'IOL Calculation',':eventTypeId'=>$event_type['id']))->queryRow()) {
			$this->insert('element_type', array('name' => 'IOL Calculation','class_name' => 'Element_OphInBiometry_IolCalculation', 'event_type_id' => $event_type['id'], 'display_order' => 1));
		}

		$element_type = $this->dbConnection->createCommand()->select('id')->from('element_type')->where('event_type_id=:eventTypeId and name=:name', array(':eventTypeId'=>$event_type['id'],':name'=>'IOL Calculation'))->queryRow();

		$this->createTable('ophinbiometry_iolcalc_iol_selection', array(
				'id' => 'int(10) unsigned NOT NULL AUTO_INCREMENT',
				'name' => 'varchar(128) NOT NULL',
				'display_order' => 'int(10) unsigned NOT NULL DEFAULT 1',
				'last_modified_user_id' => 'int(10) unsigned NOT NULL DEFAULT 1',
				'last_modified_date' => 'datetime NOT NULL DEFAULT \'1901-01-01 00:00:00\'',
				'created_user_id' => 'int(10) unsigned NOT NULL DEFAULT 1',
				'created_date' => 'datetime NOT NULL DEFAULT \'1901-01-01 00:00:00\'',
				'deleted' => 'tinyint(1) unsigned not null',
				'PRIMARY KEY (`id`)',
				'KEY `ophinbiometry_iolcalc_iol_selection_lmui_fk` (`last_modified_user_id`)',
				'KEY `ophinbiometry_iolcalc_iol_selection_cui_fk` (`created_user_id`)',
				'CONSTRAINT `ophinbiometry_iolcalc_iol_selection_lmui_fk` FOREIGN KEY (`last_modified_user_id`) REFERENCES `user` (`id`)',
				'CONSTRAINT `ophinbiometry_iolcalc_iol_selection_cui_fk` FOREIGN KEY (`created_user_id`) REFERENCES `user` (`id`)',
			), 'ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci');

		$this->createTable('ophinbiometry_iolcalc_iol_selection_version', array(
				'id' => 'int(10) unsigned NOT NULL',
				'name' => 'varchar(128) NOT NULL',
				'display_order' => 'int(10) unsigned NOT NULL DEFAULT 1',
				'last_modified_user_id' => 'int(10) unsigned NOT NULL DEFAULT 1',
				'last_modified_date' => 'datetime NOT NULL DEFAULT \'1901-01-01 00:00:00\'',
				'created_user_id' => 'int(10) unsigned NOT NULL DEFAULT 1',
				'created_date' => 'datetime NOT NULL DEFAULT \'1901-01-01 00:00:00\'',
				'deleted' => 'tinyint(1) unsigned not null',
				'version_date' => "datetime NOT NULL DEFAULT '1900-01-01 00:00:00'",
				'version_id' => 'int(10) unsigned NOT NULL AUTO_INCREMENT',
				'PRIMARY KEY (`version_id`)',
				'KEY `acv_ophinbiometry_iolcalc_iol_selection_lmui_fk` (`last_modified_user_id`)',
				'KEY `acv_ophinbiometry_iolcalc_iol_selection_cui_fk` (`created_user_id`)',
				'KEY `ophinbiometry_iolcalc_iol_selection_aid_fk` (`id`)',
				'CONSTRAINT `acv_ophinbiometry_iolcalc_iol_selection_lmui_fk` FOREIGN KEY (`last_modified_user_id`) REFERENCES `user` (`id`)',
				'CONSTRAINT `acv_ophinbiometry_iolcalc_iol_selection_cui_fk` FOREIGN KEY (`created_user_id`) REFERENCES `user` (`id`)',
				'CONSTRAINT `ophinbiometry_iolcalc_iol_selection_aid_fk` FOREIGN KEY (`id`) REFERENCES `ophinbiometry_iolcalc_iol_selection` (`id`)',
			), 'ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci');

		$this->insert('ophinbiometry_iolcalc_iol_selection',array('name'=>'MA60AC','display_order'=>1));
		$this->insert('ophinbiometry_iolcalc_iol_selection',array('name'=>'SN60WF','display_order'=>2));
		$this->insert('ophinbiometry_iolcalc_iol_selection',array('name'=>'MTA3U0','display_order'=>3));

		$this->createTable('ophinbiometry_iolcalc_formula', array(
				'id' => 'int(10) unsigned NOT NULL AUTO_INCREMENT',
				'name' => 'varchar(128) NOT NULL',
				'display_order' => 'int(10) unsigned NOT NULL DEFAULT 1',
				'last_modified_user_id' => 'int(10) unsigned NOT NULL DEFAULT 1',
				'last_modified_date' => 'datetime NOT NULL DEFAULT \'1901-01-01 00:00:00\'',
				'created_user_id' => 'int(10) unsigned NOT NULL DEFAULT 1',
				'created_date' => 'datetime NOT NULL DEFAULT \'1901-01-01 00:00:00\'',
				'deleted' => 'tinyint(1) unsigned not null',
				'PRIMARY KEY (`id`)',
				'KEY `ophinbiometry_iolcalc_formula_lmui_fk` (`last_modified_user_id`)',
				'KEY `ophinbiometry_iolcalc_formula_cui_fk` (`created_user_id`)',
				'CONSTRAINT `ophinbiometry_iolcalc_formula_lmui_fk` FOREIGN KEY (`last_modified_user_id`) REFERENCES `user` (`id`)',
				'CONSTRAINT `ophinbiometry_iolcalc_formula_cui_fk` FOREIGN KEY (`created_user_id`) REFERENCES `user` (`id`)',
			), 'ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci');

		$this->createTable('ophinbiometry_iolcalc_formula_version', array(
				'id' => 'int(10) unsigned NOT NULL',
				'name' => 'varchar(128) NOT NULL',
				'display_order' => 'int(10) unsigned NOT NULL DEFAULT 1',
				'last_modified_user_id' => 'int(10) unsigned NOT NULL DEFAULT 1',
				'last_modified_date' => 'datetime NOT NULL DEFAULT \'1901-01-01 00:00:00\'',
				'created_user_id' => 'int(10) unsigned NOT NULL DEFAULT 1',
				'created_date' => 'datetime NOT NULL DEFAULT \'1901-01-01 00:00:00\'',
				'deleted' => 'tinyint(1) unsigned not null',
				'version_date' => "datetime NOT NULL DEFAULT '1900-01-01 00:00:00'",
				'version_id' => 'int(10) unsigned NOT NULL AUTO_INCREMENT',
				'PRIMARY KEY (`version_id`)',
				'KEY `acv_ophinbiometry_iolcalc_formula_lmui_fk` (`last_modified_user_id`)',
				'KEY `acv_ophinbiometry_iolcalc_formula_cui_fk` (`created_user_id`)',
				'KEY `ophinbiometry_iolcalc_formula_aid_fk` (`id`)',
				'CONSTRAINT `acv_ophinbiometry_iolcalc_formula_lmui_fk` FOREIGN KEY (`last_modified_user_id`) REFERENCES `user` (`id`)',
				'CONSTRAINT `acv_ophinbiometry_iolcalc_formula_cui_fk` FOREIGN KEY (`created_user_id`) REFERENCES `user` (`id`)',
				'CONSTRAINT `ophinbiometry_iolcalc_formula_aid_fk` FOREIGN KEY (`id`) REFERENCES `ophinbiometry_iolcalc_formula` (`id`)',
			), 'ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci');

		$this->insert('ophinbiometry_iolcalc_formula',array('name'=>'SRK/T','display_order'=>1));
		$this->insert('ophinbiometry_iolcalc_formula',array('name'=>'Holladay 1','display_order'=>2));
		$this->insert('ophinbiometry_iolcalc_formula',array('name'=>'Hoffer Q','display_order'=>3));
		$this->insert('ophinbiometry_iolcalc_formula',array('name'=>'T2','display_order'=>4));
		$this->insert('ophinbiometry_iolcalc_formula',array('name'=>'Haggis','display_order'=>5));

		$this->createTable('et_ophinbiometry_iolcalc', array(
				'id' => 'int(10) unsigned NOT NULL AUTO_INCREMENT',
				'event_id' => 'int(10) unsigned NOT NULL',
				'axial_length' => 'decimal (2, 2) NOT NULL', // Axial Length
				'r1' => 'decimal (2, 2) NOT NULL', // R1
				'r2' => 'decimal (2, 2) NOT NULL', // R2
				'iol_selection_id' => 'int(10) unsigned NOT NULL DEFAULT 1', // IOL Selection
				'targeted_refraction' => 'varchar(255) DEFAULT \'\'', // Targeted Refraction
				'formula_id' => 'int(10) unsigned NOT NULL', // Formula
				'iol_power' => 'varchar(255) DEFAULT \'\'', // IOL Power
				'last_modified_user_id' => 'int(10) unsigned NOT NULL DEFAULT 1',
				'last_modified_date' => 'datetime NOT NULL DEFAULT \'1901-01-01 00:00:00\'',
				'created_user_id' => 'int(10) unsigned NOT NULL DEFAULT 1',
				'created_date' => 'datetime NOT NULL DEFAULT \'1901-01-01 00:00:00\'',
				'deleted' => 'tinyint(1) unsigned not null',
				'PRIMARY KEY (`id`)',
				'KEY `et_ophinbiometry_iolcalc_lmui_fk` (`last_modified_user_id`)',
				'KEY `et_ophinbiometry_iolcalc_cui_fk` (`created_user_id`)',
				'KEY `et_ophinbiometry_iolcalc_ev_fk` (`event_id`)',
				'KEY `ophinbiometry_iolcalc_iol_selection_fk` (`iol_selection_id`)',
				'KEY `ophinbiometry_iolcalc_formula_fk` (`formula_id`)',
				'CONSTRAINT `et_ophinbiometry_iolcalc_lmui_fk` FOREIGN KEY (`last_modified_user_id`) REFERENCES `user` (`id`)',
				'CONSTRAINT `et_ophinbiometry_iolcalc_cui_fk` FOREIGN KEY (`created_user_id`) REFERENCES `user` (`id`)',
				'CONSTRAINT `et_ophinbiometry_iolcalc_ev_fk` FOREIGN KEY (`event_id`) REFERENCES `event` (`id`)',
				'CONSTRAINT `ophinbiometry_iolcalc_iol_selection_fk` FOREIGN KEY (`iol_selection_id`) REFERENCES `ophinbiometry_iolcalc_iol_selection` (`id`)',
				'CONSTRAINT `ophinbiometry_iolcalc_formula_fk` FOREIGN KEY (`formula_id`) REFERENCES `ophinbiometry_iolcalc_formula` (`id`)',
			), 'ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci');

		$this->createTable('et_ophinbiometry_iolcalc_version', array(
				'id' => 'int(10) unsigned NOT NULL',
				'event_id' => 'int(10) unsigned NOT NULL',
				'axial_length' => 'decimal (2, 2) NOT NULL', // Axial Length
				'r1' => 'decimal (2, 2) NOT NULL', // R1
				'r2' => 'decimal (2, 2) NOT NULL', // R2
				'iol_selection_id' => 'int(10) unsigned NOT NULL DEFAULT 1', // IOL Selection
				'targeted_refraction' => 'varchar(255) DEFAULT \'\'', // Targeted Refraction
				'formula_id' => 'int(10) unsigned NOT NULL', // Formula
				'iol_power' => 'varchar(255) DEFAULT \'\'', // IOL Power
				'last_modified_user_id' => 'int(10) unsigned NOT NULL DEFAULT 1',
				'last_modified_date' => 'datetime NOT NULL DEFAULT \'1901-01-01 00:00:00\'',
				'created_user_id' => 'int(10) unsigned NOT NULL DEFAULT 1',
				'created_date' => 'datetime NOT NULL DEFAULT \'1901-01-01 00:00:00\'',
				'deleted' => 'tinyint(1) unsigned not null',
				'version_date' => "datetime NOT NULL DEFAULT '1900-01-01 00:00:00'",
				'version_id' => 'int(10) unsigned NOT NULL AUTO_INCREMENT',
				'PRIMARY KEY (`version_id`)',
				'KEY `acv_et_ophinbiometry_iolcalc_lmui_fk` (`last_modified_user_id`)',
				'KEY `acv_et_ophinbiometry_iolcalc_cui_fk` (`created_user_id`)',
				'KEY `acv_et_ophinbiometry_iolcalc_ev_fk` (`event_id`)',
				'KEY `et_ophinbiometry_iolcalc_aid_fk` (`id`)',
				'KEY `acv_ophinbiometry_iolcalc_iol_selection_fk` (`iol_selection_id`)',
				'KEY `acv_ophinbiometry_iolcalc_formula_fk` (`formula_id`)',
				'CONSTRAINT `acv_et_ophinbiometry_iolcalc_lmui_fk` FOREIGN KEY (`last_modified_user_id`) REFERENCES `user` (`id`)',
				'CONSTRAINT `acv_et_ophinbiometry_iolcalc_cui_fk` FOREIGN KEY (`created_user_id`) REFERENCES `user` (`id`)',
				'CONSTRAINT `acv_et_ophinbiometry_iolcalc_ev_fk` FOREIGN KEY (`event_id`) REFERENCES `event` (`id`)',
				'CONSTRAINT `et_ophinbiometry_iolcalc_aid_fk` FOREIGN KEY (`id`) REFERENCES `et_ophinbiometry_iolcalc` (`id`)',
				'CONSTRAINT `acv_ophinbiometry_iolcalc_iol_selection_fk` FOREIGN KEY (`iol_selection_id`) REFERENCES `ophinbiometry_iolcalc_iol_selection` (`id`)',
				'CONSTRAINT `acv_ophinbiometry_iolcalc_formula_fk` FOREIGN KEY (`formula_id`) REFERENCES `ophinbiometry_iolcalc_formula` (`id`)',
			), 'ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci');

	}

	public function down()
	{
		$this->dropTable('et_ophinbiometry_iolcalc_version');
		$this->dropTable('et_ophinbiometry_iolcalc');


		$this->dropTable('ophinbiometry_iolcalc_iol_selection_version');
		$this->dropTable('ophinbiometry_iolcalc_iol_selection');
		$this->dropTable('ophinbiometry_iolcalc_formula_version');
		$this->dropTable('ophinbiometry_iolcalc_formula');


		$event_type = $this->dbConnection->createCommand()->select('id')->from('event_type')->where('class_name=:class_name', array(':class_name'=>'OphInBiometry'))->queryRow();

		foreach ($this->dbConnection->createCommand()->select('id')->from('event')->where('event_type_id=:event_type_id', array(':event_type_id'=>$event_type['id']))->queryAll() as $row) {
			$this->delete('audit', 'event_id='.$row['id']);
			$this->delete('event', 'id='.$row['id']);
		}

		$this->delete('element_type', 'event_type_id='.$event_type['id']);
		$this->delete('event_type', 'id='.$event_type['id']);
	}
}
