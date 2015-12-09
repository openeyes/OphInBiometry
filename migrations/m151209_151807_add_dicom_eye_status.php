<?php

class m151209_151807_add_dicom_eye_status extends CDbMigration
{
    public function up()
    {

        $this->alterColumn('et_ophinbiometry_measurement', 'eye_status_left', 'int(10) unsigned NOT NULL');
        $this->alterColumn('et_ophinbiometry_measurement', 'eye_status_right', 'int(10) unsigned NOT NULL');
        $this->alterColumn('et_ophinbiometry_measurement_version', 'eye_status_left', 'int(10) unsigned NOT NULL');
        $this->alterColumn('et_ophinbiometry_measurement_version', 'eye_status_right', 'int(10) unsigned NOT NULL');


        $this->createTable('dicom_eye_status', array(
            'id' => 'int(10) unsigned NOT NULL PRIMARY KEY',
            'name' => 'varchar(255)'
        ));

        $this->insert('dicom_eye_status', array('id' => 0, 'name' => 'phakic eye'));
        $this->insert('dicom_eye_status', array('id' => 1, 'name' => 'aphakic eye'));
        $this->insert('dicom_eye_status', array('id' => 2, 'name' => 'silicone filled eye'));
        $this->insert('dicom_eye_status', array('id' => 3, 'name' => 'pseudophakic silicone'));
        $this->insert('dicom_eye_status', array('id' => 6, 'name' => 'pseudophakic memory'));
        $this->insert('dicom_eye_status', array('id' => 7, 'name' => 'pseudophakic PMMA'));
        $this->insert('dicom_eye_status', array('id' => 8, 'name' => 'pseudophakic acryl'));
        $this->insert('dicom_eye_status', array('id' => 9, 'name' => 'silicone filled eye (aphakic)'));
        $this->insert('dicom_eye_status', array('id' => 10, 'name' => 'silicone filled eye (pseudophakic'));
        $this->insert('dicom_eye_status', array('id' => 11, 'name' => 'phakic IOL PMMA (0,2mm)'));
        $this->insert('dicom_eye_status', array('id' => 12, 'name' => 'primary piggy-back silicone (SLM 2)'));
        $this->insert('dicom_eye_status', array('id' => 13, 'name' => 'primary piggy-back hydrophobic acrylate'));

        $this->addForeignKey('dicom_eye_status_left_id_fk', 'et_ophinbiometry_measurement', 'eye_status_left', 'dicom_eye_status', 'id');
        $this->addForeignKey('dicom_eye_status_right_id_fk', 'et_ophinbiometry_measurement', 'eye_status_right', 'dicom_eye_status', 'id');
    }

    public function down()
    {

        $this->dropForeignKey('dicom_eye_status_left_id_fk', 'et_ophinbiometry_measurement');
        $this->dropForeignKey('dicom_eye_status_right_id_fk', 'et_ophinbiometry_measurement');

        $this->alterColumn('et_ophinbiometry_measurement', 'eye_status_left', 'varchar(255)');
        $this->alterColumn('et_ophinbiometry_measurement', 'eye_status_right', 'varchar(255)');
        $this->alterColumn('et_ophinbiometry_measurement_version', 'eye_status_left', 'varchar(255)');
        $this->alterColumn('et_ophinbiometry_measurement_version', 'eye_status_right', 'varchar(255)');

        $this->dropTable('dicom_eye_status');
    }

}