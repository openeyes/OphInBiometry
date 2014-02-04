<?php 
class m140203_150454_event_type_OphInBiometry extends CDbMigration
{
	public function up()
	{
		if (!$this->dbConnection->createCommand()->select('id')->from('event_type')->where('class_name=:class_name', array(':class_name'=>'OphInBiometry'))->queryRow()) {
			$group = $this->dbConnection->createCommand()->select('id')->from('event_group')->where('name=:name',array(':name'=>'Investigation events'))->queryRow();
			$this->insert('event_type', array('class_name' => 'OphInBiometry', 'name' => 'Biometry','event_group_id' => $group['id']));
		}
		$event_type = $this->dbConnection->createCommand()->select('id')->from('event_type')->where('class_name=:class_name', array(':class_name'=>'OphInBiometry'))->queryRow();

		if (!$this->dbConnection->createCommand()->select('id')->from('element_type')->where('name=:name and event_type_id=:eventTypeId', array(':name'=>'Biometry Data',':eventTypeId'=>$event_type['id']))->queryRow()) {
			$this->insert('element_type', array('name' => 'Biometry Data','class_name' => 'Element_OphInBiometry_BiometryData', 'event_type_id' => $event_type['id'], 'display_order' => 1));
		}

		$element_type = $this->dbConnection->createCommand()->select('id')->from('element_type')->where('event_type_id=:eventTypeId and name=:name', array(':eventTypeId'=>$event_type['id'],':name'=>'Biometry Data'))->queryRow();
		if (!$this->dbConnection->createCommand()->select('id')->from('element_type')->where('name=:name and event_type_id=:eventTypeId', array(':name'=>'Lens Type',':eventTypeId'=>$event_type['id']))->queryRow()) {
			$this->insert('element_type', array('name' => 'Lens Type','class_name' => 'Element_OphInBiometry_LensType', 'event_type_id' => $event_type['id'], 'display_order' => 1));
		}

		$element_type = $this->dbConnection->createCommand()->select('id')->from('element_type')->where('event_type_id=:eventTypeId and name=:name', array(':eventTypeId'=>$event_type['id'],':name'=>'Lens Type'))->queryRow();
		if (!$this->dbConnection->createCommand()->select('id')->from('element_type')->where('name=:name and event_type_id=:eventTypeId', array(':name'=>'Calculation',':eventTypeId'=>$event_type['id']))->queryRow()) {
			$this->insert('element_type', array('name' => 'Calculation','class_name' => 'Element_OphInBiometry_Calculation', 'event_type_id' => $event_type['id'], 'display_order' => 1));
		}

		$element_type = $this->dbConnection->createCommand()->select('id')->from('element_type')->where('event_type_id=:eventTypeId and name=:name', array(':eventTypeId'=>$event_type['id'],':name'=>'Calculation'))->queryRow();
		if (!$this->dbConnection->createCommand()->select('id')->from('element_type')->where('name=:name and event_type_id=:eventTypeId', array(':name'=>'Lens Selection',':eventTypeId'=>$event_type['id']))->queryRow()) {
			$this->insert('element_type', array('name' => 'Lens Selection','class_name' => 'Element_OphInBiometry_LensSelection', 'event_type_id' => $event_type['id'], 'display_order' => 1));
		}

		$element_type = $this->dbConnection->createCommand()->select('id')->from('element_type')->where('event_type_id=:eventTypeId and name=:name', array(':eventTypeId'=>$event_type['id'],':name'=>'Lens Selection'))->queryRow();



		$this->createTable('et_ophinbiometry_biometrydat', array(
				'id' => 'int(10) unsigned NOT NULL AUTO_INCREMENT',
				'event_id' => 'int(10) unsigned NOT NULL',
				'axial_length' => 'varchar(255) DEFAULT \'\'', // Axial Length
				'r1' => 'varchar(255) DEFAULT \'\'', // R1
				'r2' => 'varchar(255) DEFAULT \'\'', // R2
				'last_modified_user_id' => 'int(10) unsigned NOT NULL DEFAULT 1',
				'last_modified_date' => 'datetime NOT NULL DEFAULT \'1901-01-01 00:00:00\'',
				'created_user_id' => 'int(10) unsigned NOT NULL DEFAULT 1',
				'created_date' => 'datetime NOT NULL DEFAULT \'1901-01-01 00:00:00\'',
				'deleted' => 'tinyint(1) unsigned not null',
				'PRIMARY KEY (`id`)',
				'KEY `et_ophinbiometry_biometrydat_lmui_fk` (`last_modified_user_id`)',
				'KEY `et_ophinbiometry_biometrydat_cui_fk` (`created_user_id`)',
				'KEY `et_ophinbiometry_biometrydat_ev_fk` (`event_id`)',
				'CONSTRAINT `et_ophinbiometry_biometrydat_lmui_fk` FOREIGN KEY (`last_modified_user_id`) REFERENCES `user` (`id`)',
				'CONSTRAINT `et_ophinbiometry_biometrydat_cui_fk` FOREIGN KEY (`created_user_id`) REFERENCES `user` (`id`)',
				'CONSTRAINT `et_ophinbiometry_biometrydat_ev_fk` FOREIGN KEY (`event_id`) REFERENCES `event` (`id`)',
			), 'ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci');

		$this->createTable('et_ophinbiometry_biometrydat_version', array(
				'id' => 'int(10) unsigned NOT NULL',
				'event_id' => 'int(10) unsigned NOT NULL',
				'axial_length' => 'varchar(255) DEFAULT \'\'', // Axial Length
				'r1' => 'varchar(255) DEFAULT \'\'', // R1
				'r2' => 'varchar(255) DEFAULT \'\'', // R2
				'last_modified_user_id' => 'int(10) unsigned NOT NULL DEFAULT 1',
				'last_modified_date' => 'datetime NOT NULL DEFAULT \'1901-01-01 00:00:00\'',
				'created_user_id' => 'int(10) unsigned NOT NULL DEFAULT 1',
				'created_date' => 'datetime NOT NULL DEFAULT \'1901-01-01 00:00:00\'',
				'deleted' => 'tinyint(1) unsigned not null',
				'version_date' => "datetime NOT NULL DEFAULT '1900-01-01 00:00:00'",
				'version_id' => 'int(10) unsigned NOT NULL AUTO_INCREMENT',
				'PRIMARY KEY (`version_id`)',
				'KEY `acv_et_ophinbiometry_biometrydat_lmui_fk` (`last_modified_user_id`)',
				'KEY `acv_et_ophinbiometry_biometrydat_cui_fk` (`created_user_id`)',
				'KEY `acv_et_ophinbiometry_biometrydat_ev_fk` (`event_id`)',
				'KEY `et_ophinbiometry_biometrydat_aid_fk` (`id`)',
				'CONSTRAINT `acv_et_ophinbiometry_biometrydat_lmui_fk` FOREIGN KEY (`last_modified_user_id`) REFERENCES `user` (`id`)',
				'CONSTRAINT `acv_et_ophinbiometry_biometrydat_cui_fk` FOREIGN KEY (`created_user_id`) REFERENCES `user` (`id`)',
				'CONSTRAINT `acv_et_ophinbiometry_biometrydat_ev_fk` FOREIGN KEY (`event_id`) REFERENCES `event` (`id`)',
				'CONSTRAINT `et_ophinbiometry_biometrydat_aid_fk` FOREIGN KEY (`id`) REFERENCES `et_ophinbiometry_biometrydat` (`id`)',
			), 'ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci');

		$this->createTable('ophinbiometry_lenstype_lens', array(
				'id' => 'int(10) unsigned NOT NULL AUTO_INCREMENT',
				'name' => 'varchar(128) NOT NULL',
				'display_order' => 'int(10) unsigned NOT NULL DEFAULT 1',
				'last_modified_user_id' => 'int(10) unsigned NOT NULL DEFAULT 1',
				'last_modified_date' => 'datetime NOT NULL DEFAULT \'1901-01-01 00:00:00\'',
				'created_user_id' => 'int(10) unsigned NOT NULL DEFAULT 1',
				'created_date' => 'datetime NOT NULL DEFAULT \'1901-01-01 00:00:00\'',
				'deleted' => 'tinyint(1) unsigned not null',
				'PRIMARY KEY (`id`)',
				'KEY `ophinbiometry_lenstype_lens_lmui_fk` (`last_modified_user_id`)',
				'KEY `ophinbiometry_lenstype_lens_cui_fk` (`created_user_id`)',
				'CONSTRAINT `ophinbiometry_lenstype_lens_lmui_fk` FOREIGN KEY (`last_modified_user_id`) REFERENCES `user` (`id`)',
				'CONSTRAINT `ophinbiometry_lenstype_lens_cui_fk` FOREIGN KEY (`created_user_id`) REFERENCES `user` (`id`)',
			), 'ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci');

		$this->createTable('ophinbiometry_lenstype_lens_version', array(
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
				'KEY `acv_ophinbiometry_lenstype_lens_lmui_fk` (`last_modified_user_id`)',
				'KEY `acv_ophinbiometry_lenstype_lens_cui_fk` (`created_user_id`)',
				'KEY `ophinbiometry_lenstype_lens_aid_fk` (`id`)',
				'CONSTRAINT `acv_ophinbiometry_lenstype_lens_lmui_fk` FOREIGN KEY (`last_modified_user_id`) REFERENCES `user` (`id`)',
				'CONSTRAINT `acv_ophinbiometry_lenstype_lens_cui_fk` FOREIGN KEY (`created_user_id`) REFERENCES `user` (`id`)',
				'CONSTRAINT `ophinbiometry_lenstype_lens_aid_fk` FOREIGN KEY (`id`) REFERENCES `ophinbiometry_lenstype_lens` (`id`)',
			), 'ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci');

		$this->insert('ophinbiometry_lenstype_lens',array('name'=>'MA60AC','display_order'=>1));
		$this->insert('ophinbiometry_lenstype_lens',array('name'=>'SN60WF','display_order'=>2));



		$this->createTable('et_ophinbiometry_lenstype', array(
				'id' => 'int(10) unsigned NOT NULL AUTO_INCREMENT',
				'event_id' => 'int(10) unsigned NOT NULL',
				'lens_id' => 'int(10) unsigned NOT NULL DEFAULT 1', // Len
				'last_modified_user_id' => 'int(10) unsigned NOT NULL DEFAULT 1',
				'last_modified_date' => 'datetime NOT NULL DEFAULT \'1901-01-01 00:00:00\'',
				'created_user_id' => 'int(10) unsigned NOT NULL DEFAULT 1',
				'created_date' => 'datetime NOT NULL DEFAULT \'1901-01-01 00:00:00\'',
				'deleted' => 'tinyint(1) unsigned not null',
				'PRIMARY KEY (`id`)',
				'KEY `et_ophinbiometry_lenstype_lmui_fk` (`last_modified_user_id`)',
				'KEY `et_ophinbiometry_lenstype_cui_fk` (`created_user_id`)',
				'KEY `et_ophinbiometry_lenstype_ev_fk` (`event_id`)',
				'KEY `ophinbiometry_lenstype_lens_fk` (`lens_id`)',
				'CONSTRAINT `et_ophinbiometry_lenstype_lmui_fk` FOREIGN KEY (`last_modified_user_id`) REFERENCES `user` (`id`)',
				'CONSTRAINT `et_ophinbiometry_lenstype_cui_fk` FOREIGN KEY (`created_user_id`) REFERENCES `user` (`id`)',
				'CONSTRAINT `et_ophinbiometry_lenstype_ev_fk` FOREIGN KEY (`event_id`) REFERENCES `event` (`id`)',
				'CONSTRAINT `ophinbiometry_lenstype_lens_fk` FOREIGN KEY (`lens_id`) REFERENCES `ophinbiometry_lenstype_lens` (`id`)',
			), 'ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci');

		$this->createTable('et_ophinbiometry_lenstype_version', array(
				'id' => 'int(10) unsigned NOT NULL',
				'event_id' => 'int(10) unsigned NOT NULL',
				'lens_id' => 'int(10) unsigned NOT NULL DEFAULT 1', // Len
				'last_modified_user_id' => 'int(10) unsigned NOT NULL DEFAULT 1',
				'last_modified_date' => 'datetime NOT NULL DEFAULT \'1901-01-01 00:00:00\'',
				'created_user_id' => 'int(10) unsigned NOT NULL DEFAULT 1',
				'created_date' => 'datetime NOT NULL DEFAULT \'1901-01-01 00:00:00\'',
				'deleted' => 'tinyint(1) unsigned not null',
				'version_date' => "datetime NOT NULL DEFAULT '1900-01-01 00:00:00'",
				'version_id' => 'int(10) unsigned NOT NULL AUTO_INCREMENT',
				'PRIMARY KEY (`version_id`)',
				'KEY `acv_et_ophinbiometry_lenstype_lmui_fk` (`last_modified_user_id`)',
				'KEY `acv_et_ophinbiometry_lenstype_cui_fk` (`created_user_id`)',
				'KEY `acv_et_ophinbiometry_lenstype_ev_fk` (`event_id`)',
				'KEY `et_ophinbiometry_lenstype_aid_fk` (`id`)',
				'KEY `acv_ophinbiometry_lenstype_lens_fk` (`lens_id`)',
				'CONSTRAINT `acv_et_ophinbiometry_lenstype_lmui_fk` FOREIGN KEY (`last_modified_user_id`) REFERENCES `user` (`id`)',
				'CONSTRAINT `acv_et_ophinbiometry_lenstype_cui_fk` FOREIGN KEY (`created_user_id`) REFERENCES `user` (`id`)',
				'CONSTRAINT `acv_et_ophinbiometry_lenstype_ev_fk` FOREIGN KEY (`event_id`) REFERENCES `event` (`id`)',
				'CONSTRAINT `et_ophinbiometry_lenstype_aid_fk` FOREIGN KEY (`id`) REFERENCES `et_ophinbiometry_lenstype` (`id`)',
				'CONSTRAINT `acv_ophinbiometry_lenstype_lens_fk` FOREIGN KEY (`lens_id`) REFERENCES `ophinbiometry_lenstype_lens` (`id`)',
			), 'ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci');

		$this->createTable('ophinbiometry_calculation_formula', array(
				'id' => 'int(10) unsigned NOT NULL AUTO_INCREMENT',
				'name' => 'varchar(128) NOT NULL',
				'display_order' => 'int(10) unsigned NOT NULL DEFAULT 1',
				'last_modified_user_id' => 'int(10) unsigned NOT NULL DEFAULT 1',
				'last_modified_date' => 'datetime NOT NULL DEFAULT \'1901-01-01 00:00:00\'',
				'created_user_id' => 'int(10) unsigned NOT NULL DEFAULT 1',
				'created_date' => 'datetime NOT NULL DEFAULT \'1901-01-01 00:00:00\'',
				'deleted' => 'tinyint(1) unsigned not null',
				'PRIMARY KEY (`id`)',
				'KEY `ophinbiometry_calculation_formula_lmui_fk` (`last_modified_user_id`)',
				'KEY `ophinbiometry_calculation_formula_cui_fk` (`created_user_id`)',
				'CONSTRAINT `ophinbiometry_calculation_formula_lmui_fk` FOREIGN KEY (`last_modified_user_id`) REFERENCES `user` (`id`)',
				'CONSTRAINT `ophinbiometry_calculation_formula_cui_fk` FOREIGN KEY (`created_user_id`) REFERENCES `user` (`id`)',
			), 'ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci');

		$this->createTable('ophinbiometry_calculation_formula_version', array(
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
				'KEY `acv_ophinbiometry_calculation_formula_lmui_fk` (`last_modified_user_id`)',
				'KEY `acv_ophinbiometry_calculation_formula_cui_fk` (`created_user_id`)',
				'KEY `ophinbiometry_calculation_formula_aid_fk` (`id`)',
				'CONSTRAINT `acv_ophinbiometry_calculation_formula_lmui_fk` FOREIGN KEY (`last_modified_user_id`) REFERENCES `user` (`id`)',
				'CONSTRAINT `acv_ophinbiometry_calculation_formula_cui_fk` FOREIGN KEY (`created_user_id`) REFERENCES `user` (`id`)',
				'CONSTRAINT `ophinbiometry_calculation_formula_aid_fk` FOREIGN KEY (`id`) REFERENCES `ophinbiometry_calculation_formula` (`id`)',
			), 'ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci');

		$this->insert('ophinbiometry_calculation_formula',array('name'=>'SRK/T','display_order'=>1));
		$this->insert('ophinbiometry_calculation_formula',array('name'=>'Holladay 1','display_order'=>2));



		$this->createTable('et_ophinbiometry_calculation', array(
				'id' => 'int(10) unsigned NOT NULL AUTO_INCREMENT',
				'event_id' => 'int(10) unsigned NOT NULL',
				'target_refraction' => 'varchar(255) DEFAULT \'\'', // Target Refraction
				'formula_id' => 'int(10) unsigned NOT NULL DEFAULT 1', // formula
				'last_modified_user_id' => 'int(10) unsigned NOT NULL DEFAULT 1',
				'last_modified_date' => 'datetime NOT NULL DEFAULT \'1901-01-01 00:00:00\'',
				'created_user_id' => 'int(10) unsigned NOT NULL DEFAULT 1',
				'created_date' => 'datetime NOT NULL DEFAULT \'1901-01-01 00:00:00\'',
				'deleted' => 'tinyint(1) unsigned not null',
				'PRIMARY KEY (`id`)',
				'KEY `et_ophinbiometry_calculation_lmui_fk` (`last_modified_user_id`)',
				'KEY `et_ophinbiometry_calculation_cui_fk` (`created_user_id`)',
				'KEY `et_ophinbiometry_calculation_ev_fk` (`event_id`)',
				'KEY `ophinbiometry_calculation_formula_fk` (`formula_id`)',
				'CONSTRAINT `et_ophinbiometry_calculation_lmui_fk` FOREIGN KEY (`last_modified_user_id`) REFERENCES `user` (`id`)',
				'CONSTRAINT `et_ophinbiometry_calculation_cui_fk` FOREIGN KEY (`created_user_id`) REFERENCES `user` (`id`)',
				'CONSTRAINT `et_ophinbiometry_calculation_ev_fk` FOREIGN KEY (`event_id`) REFERENCES `event` (`id`)',
				'CONSTRAINT `ophinbiometry_calculation_formula_fk` FOREIGN KEY (`formula_id`) REFERENCES `ophinbiometry_calculation_formula` (`id`)',
			), 'ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci');

		$this->createTable('et_ophinbiometry_calculation_version', array(
				'id' => 'int(10) unsigned NOT NULL',
				'event_id' => 'int(10) unsigned NOT NULL',
				'target_refraction' => 'varchar(255) DEFAULT \'\'', // Target Refraction
				'formula_id' => 'int(10) unsigned NOT NULL DEFAULT 1', // formula
				'last_modified_user_id' => 'int(10) unsigned NOT NULL DEFAULT 1',
				'last_modified_date' => 'datetime NOT NULL DEFAULT \'1901-01-01 00:00:00\'',
				'created_user_id' => 'int(10) unsigned NOT NULL DEFAULT 1',
				'created_date' => 'datetime NOT NULL DEFAULT \'1901-01-01 00:00:00\'',
				'deleted' => 'tinyint(1) unsigned not null',
				'version_date' => "datetime NOT NULL DEFAULT '1900-01-01 00:00:00'",
				'version_id' => 'int(10) unsigned NOT NULL AUTO_INCREMENT',
				'PRIMARY KEY (`version_id`)',
				'KEY `acv_et_ophinbiometry_calculation_lmui_fk` (`last_modified_user_id`)',
				'KEY `acv_et_ophinbiometry_calculation_cui_fk` (`created_user_id`)',
				'KEY `acv_et_ophinbiometry_calculation_ev_fk` (`event_id`)',
				'KEY `et_ophinbiometry_calculation_aid_fk` (`id`)',
				'KEY `acv_ophinbiometry_calculation_formula_fk` (`formula_id`)',
				'CONSTRAINT `acv_et_ophinbiometry_calculation_lmui_fk` FOREIGN KEY (`last_modified_user_id`) REFERENCES `user` (`id`)',
				'CONSTRAINT `acv_et_ophinbiometry_calculation_cui_fk` FOREIGN KEY (`created_user_id`) REFERENCES `user` (`id`)',
				'CONSTRAINT `acv_et_ophinbiometry_calculation_ev_fk` FOREIGN KEY (`event_id`) REFERENCES `event` (`id`)',
				'CONSTRAINT `et_ophinbiometry_calculation_aid_fk` FOREIGN KEY (`id`) REFERENCES `et_ophinbiometry_calculation` (`id`)',
				'CONSTRAINT `acv_ophinbiometry_calculation_formula_fk` FOREIGN KEY (`formula_id`) REFERENCES `ophinbiometry_calculation_formula` (`id`)',
			), 'ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci');



		$this->createTable('et_ophinbiometry_lensselecti', array(
				'id' => 'int(10) unsigned NOT NULL AUTO_INCREMENT',
				'event_id' => 'int(10) unsigned NOT NULL',
				'lens' => 'varchar(255) DEFAULT \'\'', // Lens
				'iol_power' => 'varchar(255) DEFAULT \'\'', // IOL Power
				'predicted_refration' => 'varchar(255) DEFAULT \'\'', // Predicted Refration
				'last_modified_user_id' => 'int(10) unsigned NOT NULL DEFAULT 1',
				'last_modified_date' => 'datetime NOT NULL DEFAULT \'1901-01-01 00:00:00\'',
				'created_user_id' => 'int(10) unsigned NOT NULL DEFAULT 1',
				'created_date' => 'datetime NOT NULL DEFAULT \'1901-01-01 00:00:00\'',
				'deleted' => 'tinyint(1) unsigned not null',
				'PRIMARY KEY (`id`)',
				'KEY `et_ophinbiometry_lensselecti_lmui_fk` (`last_modified_user_id`)',
				'KEY `et_ophinbiometry_lensselecti_cui_fk` (`created_user_id`)',
				'KEY `et_ophinbiometry_lensselecti_ev_fk` (`event_id`)',
				'CONSTRAINT `et_ophinbiometry_lensselecti_lmui_fk` FOREIGN KEY (`last_modified_user_id`) REFERENCES `user` (`id`)',
				'CONSTRAINT `et_ophinbiometry_lensselecti_cui_fk` FOREIGN KEY (`created_user_id`) REFERENCES `user` (`id`)',
				'CONSTRAINT `et_ophinbiometry_lensselecti_ev_fk` FOREIGN KEY (`event_id`) REFERENCES `event` (`id`)',
			), 'ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci');

		$this->createTable('et_ophinbiometry_lensselecti_version', array(
				'id' => 'int(10) unsigned NOT NULL',
				'event_id' => 'int(10) unsigned NOT NULL',
				'lens' => 'varchar(255) DEFAULT \'\'', // Lens
				'iol_power' => 'varchar(255) DEFAULT \'\'', // IOL Power
				'predicted_refration' => 'varchar(255) DEFAULT \'\'', // Predicted Refration
				'last_modified_user_id' => 'int(10) unsigned NOT NULL DEFAULT 1',
				'last_modified_date' => 'datetime NOT NULL DEFAULT \'1901-01-01 00:00:00\'',
				'created_user_id' => 'int(10) unsigned NOT NULL DEFAULT 1',
				'created_date' => 'datetime NOT NULL DEFAULT \'1901-01-01 00:00:00\'',
				'deleted' => 'tinyint(1) unsigned not null',
				'version_date' => "datetime NOT NULL DEFAULT '1900-01-01 00:00:00'",
				'version_id' => 'int(10) unsigned NOT NULL AUTO_INCREMENT',
				'PRIMARY KEY (`version_id`)',
				'KEY `acv_et_ophinbiometry_lensselecti_lmui_fk` (`last_modified_user_id`)',
				'KEY `acv_et_ophinbiometry_lensselecti_cui_fk` (`created_user_id`)',
				'KEY `acv_et_ophinbiometry_lensselecti_ev_fk` (`event_id`)',
				'KEY `et_ophinbiometry_lensselecti_aid_fk` (`id`)',
				'CONSTRAINT `acv_et_ophinbiometry_lensselecti_lmui_fk` FOREIGN KEY (`last_modified_user_id`) REFERENCES `user` (`id`)',
				'CONSTRAINT `acv_et_ophinbiometry_lensselecti_cui_fk` FOREIGN KEY (`created_user_id`) REFERENCES `user` (`id`)',
				'CONSTRAINT `acv_et_ophinbiometry_lensselecti_ev_fk` FOREIGN KEY (`event_id`) REFERENCES `event` (`id`)',
				'CONSTRAINT `et_ophinbiometry_lensselecti_aid_fk` FOREIGN KEY (`id`) REFERENCES `et_ophinbiometry_lensselecti` (`id`)',
			), 'ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci');

	}

	public function down()
	{
		$this->dropTable('et_ophinbiometry_biometrydat_version');
		$this->dropTable('et_ophinbiometry_biometrydat');



		$this->dropTable('et_ophinbiometry_lenstype_version');
		$this->dropTable('et_ophinbiometry_lenstype');


		$this->dropTable('ophinbiometry_lenstype_lens_version');
		$this->dropTable('ophinbiometry_lenstype_lens');

		$this->dropTable('et_ophinbiometry_calculation_version');
		$this->dropTable('et_ophinbiometry_calculation');


		$this->dropTable('ophinbiometry_calculation_formula_version');
		$this->dropTable('ophinbiometry_calculation_formula');

		$this->dropTable('et_ophinbiometry_lensselecti_version');
		$this->dropTable('et_ophinbiometry_lensselecti');




		$event_type = $this->dbConnection->createCommand()->select('id')->from('event_type')->where('class_name=:class_name', array(':class_name'=>'OphInBiometry'))->queryRow();

		foreach ($this->dbConnection->createCommand()->select('id')->from('event')->where('event_type_id=:event_type_id', array(':event_type_id'=>$event_type['id']))->queryAll() as $row) {
			$this->delete('audit', 'event_id='.$row['id']);
			$this->delete('event', 'id='.$row['id']);
		}

		$this->delete('element_type', 'event_type_id='.$event_type['id']);
		$this->delete('event_type', 'id='.$event_type['id']);
	}
}
