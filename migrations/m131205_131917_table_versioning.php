<?php

class m131205_131917_table_versioning extends CDbMigration
{
	public function up()
	{
		$this->execute("
CREATE TABLE `et_ophinbiometry_calculation_version` (
	`id` int(10) unsigned NOT NULL AUTO_INCREMENT,
	`event_id` int(10) unsigned NOT NULL,
	`target_refraction` decimal(4,2) NOT NULL,
	`formula_id` int(10) unsigned NOT NULL DEFAULT '1',
	`iol_power` decimal(3,1) NOT NULL,
	`iol_selected` decimal(3,1) NOT NULL,
	`predicted_refraction` decimal(4,2) NOT NULL,
	`last_modified_user_id` int(10) unsigned NOT NULL DEFAULT '1',
	`last_modified_date` datetime NOT NULL DEFAULT '1901-01-01 00:00:00',
	`created_user_id` int(10) unsigned NOT NULL DEFAULT '1',
	`created_date` datetime NOT NULL DEFAULT '1901-01-01 00:00:00',
	`iol_type` int(10) unsigned NOT NULL,
	PRIMARY KEY (`id`),
	KEY `acv_et_ophinbiometry_calculation_lmui_fk` (`last_modified_user_id`),
	KEY `acv_et_ophinbiometry_calculation_cui_fk` (`created_user_id`),
	KEY `acv_et_ophinbiometry_calculation_ev_fk` (`event_id`),
	KEY `acv_ophinbiometry_calculation_formula_fk` (`formula_id`),
	CONSTRAINT `acv_et_ophinbiometry_calculation_cui_fk` FOREIGN KEY (`created_user_id`) REFERENCES `user` (`id`),
	CONSTRAINT `acv_et_ophinbiometry_calculation_ev_fk` FOREIGN KEY (`event_id`) REFERENCES `event` (`id`),
	CONSTRAINT `acv_et_ophinbiometry_calculation_lmui_fk` FOREIGN KEY (`last_modified_user_id`) REFERENCES `user` (`id`),
	CONSTRAINT `acv_ophinbiometry_calculation_formula_fk` FOREIGN KEY (`formula_id`) REFERENCES `ophinbiometry_calculation_formula` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci
		");

		$this->alterColumn('et_ophinbiometry_calculation_version','id','int(10) unsigned NOT NULL');
		$this->dropPrimaryKey('id','et_ophinbiometry_calculation_version');

		$this->createIndex('et_ophinbiometry_calculation_aid_fk','et_ophinbiometry_calculation_version','id');
		$this->addForeignKey('et_ophinbiometry_calculation_aid_fk','et_ophinbiometry_calculation_version','id','et_ophinbiometry_calculation','id');

		$this->addColumn('et_ophinbiometry_calculation_version','version_date',"datetime not null default '1900-01-01 00:00:00'");

		$this->addColumn('et_ophinbiometry_calculation_version','version_id','int(10) unsigned NOT NULL');
		$this->addPrimaryKey('version_id','et_ophinbiometry_calculation_version','version_id');
		$this->alterColumn('et_ophinbiometry_calculation_version','version_id','int(10) unsigned NOT NULL AUTO_INCREMENT');

		$this->execute("
CREATE TABLE `et_ophinbiometry_measurement_version` (
	`id` int(10) unsigned NOT NULL AUTO_INCREMENT,
	`event_id` int(10) unsigned NOT NULL,
	`right_axial_length` varchar(16) NOT NULL,
	`left_axial_length` varchar(16) NOT NULL,
	`right_k1` varchar(16) NOT NULL,
	`left_k1` varchar(16) NOT NULL,
	`right_k2` varchar(16) NOT NULL,
	`left_k2` varchar(16) NOT NULL,
	`last_modified_user_id` int(10) unsigned NOT NULL DEFAULT '1',
	`last_modified_date` datetime NOT NULL DEFAULT '1901-01-01 00:00:00',
	`created_user_id` int(10) unsigned NOT NULL DEFAULT '1',
	`created_date` datetime NOT NULL DEFAULT '1901-01-01 00:00:00',
	PRIMARY KEY (`id`),
	KEY `acv_et_ophinbiometry_measurement_lmui_fk` (`last_modified_user_id`),
	KEY `acv_et_ophinbiometry_measurement_cui_fk` (`created_user_id`),
	KEY `acv_et_ophinbiometry_measurement_ev_fk` (`event_id`),
	CONSTRAINT `acv_et_ophinbiometry_measurement_cui_fk` FOREIGN KEY (`created_user_id`) REFERENCES `user` (`id`),
	CONSTRAINT `acv_et_ophinbiometry_measurement_ev_fk` FOREIGN KEY (`event_id`) REFERENCES `event` (`id`),
	CONSTRAINT `acv_et_ophinbiometry_measurement_lmui_fk` FOREIGN KEY (`last_modified_user_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci
		");

		$this->alterColumn('et_ophinbiometry_measurement_version','id','int(10) unsigned NOT NULL');
		$this->dropPrimaryKey('id','et_ophinbiometry_measurement_version');

		$this->createIndex('et_ophinbiometry_measurement_aid_fk','et_ophinbiometry_measurement_version','id');
		$this->addForeignKey('et_ophinbiometry_measurement_aid_fk','et_ophinbiometry_measurement_version','id','et_ophinbiometry_measurement','id');

		$this->addColumn('et_ophinbiometry_measurement_version','version_date',"datetime not null default '1900-01-01 00:00:00'");

		$this->addColumn('et_ophinbiometry_measurement_version','version_id','int(10) unsigned NOT NULL');
		$this->addPrimaryKey('version_id','et_ophinbiometry_measurement_version','version_id');
		$this->alterColumn('et_ophinbiometry_measurement_version','version_id','int(10) unsigned NOT NULL AUTO_INCREMENT');

		$this->execute("
CREATE TABLE `ophinbiometry_calculation_formula_version` (
	`id` int(10) unsigned NOT NULL AUTO_INCREMENT,
	`name` varchar(128) NOT NULL,
	`display_order` int(10) unsigned NOT NULL DEFAULT '1',
	`last_modified_user_id` int(10) unsigned NOT NULL DEFAULT '1',
	`last_modified_date` datetime NOT NULL DEFAULT '1901-01-01 00:00:00',
	`created_user_id` int(10) unsigned NOT NULL DEFAULT '1',
	`created_date` datetime NOT NULL DEFAULT '1901-01-01 00:00:00',
	PRIMARY KEY (`id`),
	KEY `acv_ophinbiometry_calculation_formula_lmui_fk` (`last_modified_user_id`),
	KEY `acv_ophinbiometry_calculation_formula_cui_fk` (`created_user_id`),
	CONSTRAINT `acv_ophinbiometry_calculation_formula_lmui_fk` FOREIGN KEY (`last_modified_user_id`) REFERENCES `user` (`id`),
	CONSTRAINT `acv_ophinbiometry_calculation_formula_cui_fk` FOREIGN KEY (`created_user_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci
		");

		$this->alterColumn('ophinbiometry_calculation_formula_version','id','int(10) unsigned NOT NULL');
		$this->dropPrimaryKey('id','ophinbiometry_calculation_formula_version');

		$this->createIndex('ophinbiometry_calculation_formula_aid_fk','ophinbiometry_calculation_formula_version','id');
		$this->addForeignKey('ophinbiometry_calculation_formula_aid_fk','ophinbiometry_calculation_formula_version','id','ophinbiometry_calculation_formula','id');

		$this->addColumn('ophinbiometry_calculation_formula_version','version_date',"datetime not null default '1900-01-01 00:00:00'");

		$this->addColumn('ophinbiometry_calculation_formula_version','version_id','int(10) unsigned NOT NULL');
		$this->addPrimaryKey('version_id','ophinbiometry_calculation_formula_version','version_id');
		$this->alterColumn('ophinbiometry_calculation_formula_version','version_id','int(10) unsigned NOT NULL AUTO_INCREMENT');

		$this->addColumn('et_ophinbiometry_calculation','deleted','tinyint(1) unsigned not null');
		$this->addColumn('et_ophinbiometry_calculation_version','deleted','tinyint(1) unsigned not null');
		$this->addColumn('et_ophinbiometry_measurement','deleted','tinyint(1) unsigned not null');
		$this->addColumn('et_ophinbiometry_measurement_version','deleted','tinyint(1) unsigned not null');

		$this->addColumn('ophinbiometry_calculation_formula','deleted','tinyint(1) unsigned not null');
		$this->addColumn('ophinbiometry_calculation_formula_version','deleted','tinyint(1) unsigned not null');
	}

	public function down()
	{
		$this->dropColumn('ophinbiometry_calculation_formula','deleted');

		$this->dropColumn('et_ophinbiometry_calculation','deleted');
		$this->dropColumn('et_ophinbiometry_measurement','deleted');

		$this->dropTable('et_ophinbiometry_calculation_version');
		$this->dropTable('et_ophinbiometry_measurement_version');
		$this->dropTable('ophinbiometry_calculation_formula_version');
	}
}
