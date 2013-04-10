<?php 
class m130322_015218_event_type_OphInBiometry extends CDbMigration
{
	public function up() {

		// --- EVENT TYPE ENTRIES ---

		// create an event_type entry for this event type name if one doesn't already exist
		if (!$this->dbConnection->createCommand()->select('id')->from('event_type')->where('class_name=:class_name', array(':class_name'=>'OphInBiometry'))->queryRow()) {
			$group = $this->dbConnection->createCommand()->select('id')->from('event_group')->where('name=:name',array(':name'=>'Investigation events'))->queryRow();
			$this->insert('event_type', array('class_name' => 'OphInBiometry', 'name' => 'Biometry','event_group_id' => $group['id']));
		}
		// select the event_type id for this event type name
		$event_type = $this->dbConnection->createCommand()->select('id')->from('event_type')->where('class_name=:class_name', array(':class_name'=>'OphInBiometry'))->queryRow();

		// --- ELEMENT TYPE ENTRIES ---

		// create an element_type entry for this element type name if one doesn't already exist
		if (!$this->dbConnection->createCommand()->select('id')->from('element_type')->where('name=:name and event_type_id=:eventTypeId', array(':name'=>'Measurements',':eventTypeId'=>$event_type['id']))->queryRow()) {
			$this->insert('element_type', array('name' => 'Measurements','class_name' => 'Element_OphInBiometry_Measurements', 'event_type_id' => $event_type['id'], 'display_order' => 1));
		}
		// select the element_type_id for this element type name
		$element_type = $this->dbConnection->createCommand()->select('id')->from('element_type')->where('event_type_id=:eventTypeId and name=:name', array(':eventTypeId'=>$event_type['id'],':name'=>'Measurements'))->queryRow();
		// create an element_type entry for this element type name if one doesn't already exist
		if (!$this->dbConnection->createCommand()->select('id')->from('element_type')->where('name=:name and event_type_id=:eventTypeId', array(':name'=>'Calculation',':eventTypeId'=>$event_type['id']))->queryRow()) {
			$this->insert('element_type', array('name' => 'Calculation','class_name' => 'Element_OphInBiometry_Calculation', 'event_type_id' => $event_type['id'], 'display_order' => 1));
		}
		// select the element_type_id for this element type name
		$element_type = $this->dbConnection->createCommand()->select('id')->from('element_type')->where('event_type_id=:eventTypeId and name=:name', array(':eventTypeId'=>$event_type['id'],':name'=>'Calculation'))->queryRow();



		// create the table for this element type: et_modulename_elementtypename
		$this->createTable('et_ophinbiometry_measurement', array(
				'id' => 'int(10) unsigned NOT NULL AUTO_INCREMENT',
				'event_id' => 'int(10) unsigned NOT NULL',
				'right_axial_length' => 'decimal (3, 1) NOT NULL', // Right Axial Length
				'left_axial_length' => 'decimal (3, 1) NOT NULL', // Left Axial Length
				'right_k1' => 'decimal (3, 1) NOT NULL', // Right K1
				'left_k1' => 'decimal (3, 1) NOT NULL', // Left K1
				'right_k2' => 'decimal (3, 1) NOT NULL', // Right K2
				'left_k2' => 'decimal (3, 1) NOT NULL', // Left K2
				'last_modified_user_id' => 'int(10) unsigned NOT NULL DEFAULT 1',
				'last_modified_date' => 'datetime NOT NULL DEFAULT \'1901-01-01 00:00:00\'',
				'created_user_id' => 'int(10) unsigned NOT NULL DEFAULT 1',
				'created_date' => 'datetime NOT NULL DEFAULT \'1901-01-01 00:00:00\'',
				'PRIMARY KEY (`id`)',
				'KEY `et_ophinbiometry_measurement_lmui_fk` (`last_modified_user_id`)',
				'KEY `et_ophinbiometry_measurement_cui_fk` (`created_user_id`)',
				'KEY `et_ophinbiometry_measurement_ev_fk` (`event_id`)',
				'CONSTRAINT `et_ophinbiometry_measurement_lmui_fk` FOREIGN KEY (`last_modified_user_id`) REFERENCES `user` (`id`)',
				'CONSTRAINT `et_ophinbiometry_measurement_cui_fk` FOREIGN KEY (`created_user_id`) REFERENCES `user` (`id`)',
				'CONSTRAINT `et_ophinbiometry_measurement_ev_fk` FOREIGN KEY (`event_id`) REFERENCES `event` (`id`)',
			), 'ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin');

		// element lookup table ophinbiometry_calculation_formula
		$this->createTable('ophinbiometry_calculation_formula', array(
				'id' => 'int(10) unsigned NOT NULL AUTO_INCREMENT',
				'name' => 'varchar(128) COLLATE utf8_bin NOT NULL',
				'display_order' => 'int(10) unsigned NOT NULL DEFAULT 1',
				'last_modified_user_id' => 'int(10) unsigned NOT NULL DEFAULT 1',
				'last_modified_date' => 'datetime NOT NULL DEFAULT \'1901-01-01 00:00:00\'',
				'created_user_id' => 'int(10) unsigned NOT NULL DEFAULT 1',
				'created_date' => 'datetime NOT NULL DEFAULT \'1901-01-01 00:00:00\'',
				'PRIMARY KEY (`id`)',
				'KEY `ophinbiometry_calculation_formula_lmui_fk` (`last_modified_user_id`)',
				'KEY `ophinbiometry_calculation_formula_cui_fk` (`created_user_id`)',
				'CONSTRAINT `ophinbiometry_calculation_formula_lmui_fk` FOREIGN KEY (`last_modified_user_id`) REFERENCES `user` (`id`)',
				'CONSTRAINT `ophinbiometry_calculation_formula_cui_fk` FOREIGN KEY (`created_user_id`) REFERENCES `user` (`id`)',
			), 'ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin');

		$this->insert('ophinbiometry_calculation_formula',array('name'=>'SRK/T','display_order'=>1));
		$this->insert('ophinbiometry_calculation_formula',array('name'=>'Holladay I','display_order'=>2));
		$this->insert('ophinbiometry_calculation_formula',array('name'=>'Holladay II','display_order'=>3));
		$this->insert('ophinbiometry_calculation_formula',array('name'=>'Hoffer Q','display_order'=>4));
		$this->insert('ophinbiometry_calculation_formula',array('name'=>'Haigis','display_order'=>5));
		$this->insert('ophinbiometry_calculation_formula',array('name'=>'BESSt','display_order'=>6));



		// create the table for this element type: et_modulename_elementtypename
		$this->createTable('et_ophinbiometry_calculation', array(
				'id' => 'int(10) unsigned NOT NULL AUTO_INCREMENT',
				'event_id' => 'int(10) unsigned NOT NULL',
				'target_refraction' => 'decimal (4, 2) NOT NULL', // Target Refraction
				'formula_id' => 'int(10) unsigned NOT NULL DEFAULT 1', // Formula
				'iol_power' => 'decimal (3, 1) NOT NULL', // IOL Power
				'iol_selected' => 'decimal (3, 1) NOT NULL', // IOL Power seleted
				'predicted_refraction' => 'decimal (4, 2) NOT NULL', // Predicted Refraction
				'last_modified_user_id' => 'int(10) unsigned NOT NULL DEFAULT 1',
				'last_modified_date' => 'datetime NOT NULL DEFAULT \'1901-01-01 00:00:00\'',
				'created_user_id' => 'int(10) unsigned NOT NULL DEFAULT 1',
				'created_date' => 'datetime NOT NULL DEFAULT \'1901-01-01 00:00:00\'',
				'PRIMARY KEY (`id`)',
				'KEY `et_ophinbiometry_calculation_lmui_fk` (`last_modified_user_id`)',
				'KEY `et_ophinbiometry_calculation_cui_fk` (`created_user_id`)',
				'KEY `et_ophinbiometry_calculation_ev_fk` (`event_id`)',
				'KEY `ophinbiometry_calculation_formula_fk` (`formula_id`)',
				'CONSTRAINT `et_ophinbiometry_calculation_lmui_fk` FOREIGN KEY (`last_modified_user_id`) REFERENCES `user` (`id`)',
				'CONSTRAINT `et_ophinbiometry_calculation_cui_fk` FOREIGN KEY (`created_user_id`) REFERENCES `user` (`id`)',
				'CONSTRAINT `et_ophinbiometry_calculation_ev_fk` FOREIGN KEY (`event_id`) REFERENCES `event` (`id`)',
				'CONSTRAINT `ophinbiometry_calculation_formula_fk` FOREIGN KEY (`formula_id`) REFERENCES `ophinbiometry_calculation_formula` (`id`)',
			), 'ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin');

	}

	public function down() {
		// --- drop any element related tables ---
		// --- drop element tables ---
		$this->dropTable('et_ophinbiometry_measurement');



		$this->dropTable('et_ophinbiometry_calculation');


		$this->dropTable('ophinbiometry_calculation_formula');


		// --- delete event entries ---
		$event_type = $this->dbConnection->createCommand()->select('id')->from('event_type')->where('class_name=:class_name', array(':class_name'=>'OphInBiometry'))->queryRow();

		foreach ($this->dbConnection->createCommand()->select('id')->from('event')->where('event_type_id=:event_type_id', array(':event_type_id'=>$event_type['id']))->queryAll() as $row) {
			$this->delete('audit', 'event_id='.$row['id']);
			$this->delete('event', 'id='.$row['id']);
		}

		// --- delete entries from element_type ---
		$this->delete('element_type', 'event_type_id='.$event_type['id']);

		// --- delete entries from event_type ---
		$this->delete('event_type', 'id='.$event_type['id']);

		// echo "m000000_000001_event_type_OphInBiometry does not support migration down.\n";
		// return false;
		echo "If you are removing this module you may also need to remove references to it in your configuration files\n";
		return true;
	}
}
?>