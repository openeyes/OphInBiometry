<?php

/**
 * This is the model class for table "ophiniolmaster_iolreading".
 *
 * The followings are the available columns in table 'ophiniolmaster_iolreading':
 * @property string $id
 * @property string $iol_machine_id
 * @property string $iol_poll_id
 * @property string $first_name
 * @property string $last_name
 * @property string $patient_id
 * @property string $patients_birth_date
 * @property string $data
 * @property string $last_modified_user_id
 * @property string $last_modified_date
 * @property string $created_user_id
 * @property string $created_date
 *
 * The followings are the available model relations:
 * @property User $lastModifiedUser
 * @property User $createdUser
 */
class OphiniolmasterIolreading extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'ophiniolmaster_iolreading';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('iol_machine_id, iol_poll_id, first_name, last_name, patient_id', 'required'),
			array('iol_machine_id, iol_poll_id, first_name, last_name', 'length', 'max'=>100),
			array('patient_id, last_modified_user_id, created_user_id', 'length', 'max'=>10),
			array('patients_birth_date, data, last_modified_date, created_date', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, iol_machine_id, iol_poll_id, first_name, last_name, patient_id, patients_birth_date, data, last_modified_user_id, last_modified_date, created_user_id, created_date', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'lastModifiedUser' => array(self::BELONGS_TO, 'User', 'last_modified_user_id'),
			'createdUser' => array(self::BELONGS_TO, 'User', 'created_user_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'iol_machine_id' => 'Iol Machine',
			'iol_poll_id' => 'Iol Poll',
			'first_name' => 'First Name',
			'last_name' => 'Last Name',
			'patient_id' => 'Patient',
			'patients_birth_date' => 'Patients Birth Date',
			'data' => 'Data',
			'last_modified_user_id' => 'Last Modified User',
			'last_modified_date' => 'Last Modified Date',
			'created_user_id' => 'Created User',
			'created_date' => 'Created Date',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id,true);
		$criteria->compare('iol_machine_id',$this->iol_machine_id,true);
		$criteria->compare('iol_poll_id',$this->iol_poll_id,true);
		$criteria->compare('first_name',$this->first_name,true);
		$criteria->compare('last_name',$this->last_name,true);
		$criteria->compare('patient_id',$this->patient_id,true);
		$criteria->compare('patients_birth_date',$this->patients_birth_date,true);
		$criteria->compare('data',$this->data,true);
		$criteria->compare('last_modified_user_id',$this->last_modified_user_id,true);
		$criteria->compare('last_modified_date',$this->last_modified_date,true);
		$criteria->compare('created_user_id',$this->created_user_id,true);
		$criteria->compare('created_date',$this->created_date,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return OphiniolmasterIolreading the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
