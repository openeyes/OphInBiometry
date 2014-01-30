<?php
/**
 * OpenEyes
 *
 * (C) Moorfields Eye Hospital NHS Foundation Trust, 2008-2011
 * (C) OpenEyes Foundation, 2011-2013
 * This file is part of OpenEyes.
 * OpenEyes is free software: you can redistribute it and/or modify it under the terms of the GNU General Public License as published by the Free Software Foundation, either version 3 of the License, or (at your option) any later version.
 * OpenEyes is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU General Public License for more details.
 * You should have received a copy of the GNU General Public License along with OpenEyes in a file titled COPYING. If not, see <http://www.gnu.org/licenses/>.
 *
 * @package OpenEyes
 * @link http://www.openeyes.org.uk
 * @author OpenEyes <info@openeyes.org.uk>
 * @copyright Copyright (c) 2008-2011, Moorfields Eye Hospital NHS Foundation Trust
 * @copyright Copyright (c) 2011-2013, OpenEyes Foundation
 * @license http://www.gnu.org/licenses/gpl-3.0.html The GNU General Public License V3.0
 */

/**
 * This is the model class for table "et_ophinbiometry_iolcalc".
 *
 * The followings are the available columns in table:
 * @property string $id
 * @property integer $event_id
 * @property integer $iol_selection_id
 * @property string $targeted_refraction
 * @property integer $formula_id
 * @property string $iol_power
 *
 * The followings are the available model relations:
 *
 * @property ElementType $element_type
 * @property EventType $eventType
 * @property Event $event
 * @property User $user
 * @property User $usermodified
 * @property OphInBiometry_IolCalculation_IolSelection $iol_selection
 * @property OphInBiometry_IolCalculation_Formula $formula
 */

class Element_OphInBiometry_IolCalculation extends BaseEventTypeElement
{
	public $service;

	/**
	 * Returns the static model of the specified AR class.
	 * @return the static model class
	 */
	public static function model($className = __CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'et_ophinbiometry_iolcalc';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('event_id, axial_length, r1, r2, iol_selection_id, targeted_refraction, formula_id, iol_power, ', 'safe'),
			array('axial_length, r1, r2, iol_selection_id, targeted_refraction, formula_id, iol_power, ', 'required'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, event_id, axial_length, r1, r2, iol_selection_id, targeted_refraction, formula_id, iol_power, ', 'safe', 'on' => 'search'),
			array('axial_length', 'numerical', 'numberPattern' => '/^\s*[\+\-]?\d+\.?\d*\s*$/',),
			array('r1', 'numerical', 'numberPattern' => '/^\s*[\+\-]?\d+\.?\d*\s*$/',),
			array('r2', 'numerical', 'numberPattern' => '/^\s*[\+\-]?\d+\.?\d*\s*$/',),
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
			'element_type' => array(self::HAS_ONE, 'ElementType', 'id','on' => "element_type.class_name='".get_class($this)."'"),
			'eventType' => array(self::BELONGS_TO, 'EventType', 'event_type_id'),
			'event' => array(self::BELONGS_TO, 'Event', 'event_id'),
			'user' => array(self::BELONGS_TO, 'User', 'created_user_id'),
			'usermodified' => array(self::BELONGS_TO, 'User', 'last_modified_user_id'),
			'iol_selection' => array(self::BELONGS_TO, 'OphInBiometry_IolCalculation_IolSelection', 'iol_selection_id'),
			'formula' => array(self::BELONGS_TO, 'OphInBiometry_IolCalculation_Formula', 'formula_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'event_id' => 'Event',
			'axial_length' => 'Axial Length',
			'r1' => 'R1',
			'r2' => 'R2',
			'iol_selection_id' => 'IOL Selection',
			'targeted_refraction' => 'Targeted Refraction',
			'formula_id' => 'Formula',
			'iol_power' => 'IOL Power',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria = new CDbCriteria;

		$criteria->compare('id', $this->id, true);
		$criteria->compare('event_id', $this->event_id, true);
		$criteria->compare('axial_length', $this->axial_length);
		$criteria->compare('r1', $this->r1);
		$criteria->compare('r2', $this->r2);
		$criteria->compare('iol_selection_id', $this->iol_selection_id);
		$criteria->compare('targeted_refraction', $this->targeted_refraction);
		$criteria->compare('formula_id', $this->formula_id);
		$criteria->compare('iol_power', $this->iol_power);

		return new CActiveDataProvider(get_class($this), array(
			'criteria' => $criteria,
		));
	}



	protected function beforeSave()
	{
		return parent::beforeSave();
	}

	protected function afterSave()
	{

		return parent::afterSave();
	}

	protected function beforeValidate()
	{
		return parent::beforeValidate();
	}
}
?>