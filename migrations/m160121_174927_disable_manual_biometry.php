<?php

class m160121_174927_disable_manual_biometry extends CDbMigration
{
	public function up()
	{

		//INSERT INTO `openeyes`.`setting_metadata` (`display_order`, `field_type_id`, `key`, `name`, `data`, `default_value`, `last_modified_user_id`)
		// VALUES ('0', '3', 'disable_manual_biometry', 'Disable manual biometry measurement entry', 'a:2:{s:2:\"on\";s:2:\"On\";s:3:\"off\";s:3:\"Off\";}', 'off', '1');


		$this->insert('setting_metadata', array('display_order' => 0, 'field_type_id' => 3 , 'key' => 'disable_manual_biometry' , 'name' => 'Disable manual biometry measurement entry', 'data' => 'a:2:{s:2:\"on\";s:2:\"On\";s:3:\"off\";s:3:\"Off\";}' , 'default_value' => 'off', 'last_modified_user_id' =>1));
//		$this->insert('element_type', array('name' => 'Lens Type','class_name' => 'Element_OphInBiometry_LensType', 'event_type_id' => $event_type['id'], 'display_order' => 1));
	}

	public function down()
	{
		$this->delete('setting_metadata', '`key`="disable_manual_biometry"');
	}


}