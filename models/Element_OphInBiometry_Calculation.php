<?php
/**
 * OpenEyes
 *
 * (C) Moorfields Eye Hospital NHS Foundation Trust, 2008-2011
 * (C) OpenEyes Foundation, 2011-2012
 * This file is part of OpenEyes.
 * OpenEyes is free software: you can redistribute it and/or modify it under the terms of the GNU General Public License as published by the Free Software Foundation, either version 3 of the License, or (at your option) any later version.
 * OpenEyes is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU General Public License for more details.
 * You should have received a copy of the GNU General Public License along with OpenEyes in a file titled COPYING. If not, see <http://www.gnu.org/licenses/>.
 *
 * @package OpenEyes
 * @link http://www.openeyes.org.uk
 * @author OpenEyes <info@openeyes.org.uk>
 * @copyright Copyright (c) 2008-2011, Moorfields Eye Hospital NHS Foundation Trust
 * @copyright Copyright (c) 2011-2012, OpenEyes Foundation
 * @license http://www.gnu.org/licenses/gpl-3.0.html The GNU General Public License V3.0
 */

/**
 * This is the model class for table "et_ophinbiometry_calculation".
 *
 * The followings are the available columns in table:
 * @property string $id
 * @property integer $event_id
 * @property integer $formula_id
 *
 * The followings are the available model relations:
 *
 * @property ElementType $element_type
 * @property EventType $eventType
 * @property Event $event
 * @property User $user
 * @property User $usermodified
 * @property Element_OphInBiometry_Calculation_Formula $formula
 */

class Element_OphInBiometry_Calculation extends BaseEventTypeElement
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
		return 'et_ophinbiometry_calculation';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('event_id, target_refraction, predicted_refraction, formula_id, iol_power, iol_selected, iol_type', 'safe'),
			array('target_refraction, predicted_refraction, formula_id, iol_power, iol_type', 'required'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, event_id, target_refraction, predicted_refraction, formula_id, iol_power, iol_selected, ', 'safe', 'on' => 'search'),
			array('target_refraction, predicted_refraction', 'numerical', 'numberPattern' => '/^\s*[\+\-]?\d+\.?\d*\s*$/', 'min' => -20, 'max' => 20),
			array('iol_power, iol_selected', 'numerical', 'numberPattern' => '/^\s*[\+\-]?\d+\.?\d*\s*$/', 'min' => 0, 'max' => 30),
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
			'formula' => array(self::BELONGS_TO, 'Element_OphInBiometry_Calculation_Formula', 'formula_id'),
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
			'target_refraction' => 'Target Refraction',
			'predicted_refraction' => 'Predicted refraction',
			'formula_id' => 'Formula',
			'iol_power' => 'IOL Power',
			'iol_selected' => 'Selected IOL',
			'iol_type' => 'IOL type',
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
		$criteria->compare('target_refraction', $this->target_refraction);
		$criteria->compare('predicted_refraction', $this->predicted_refraction);
		$criteria->compare('formula_id', $this->formula_id);
		$criteria->compare('iol_power', $this->iol_power);
		$criteria->compare('iol_selected', $this->iol_selected);
		
		return new CActiveDataProvider(get_class($this), array(
			'criteria' => $criteria,
		));
	}

	public function setDefaultOptions()
	{
		// See if we can get the target refraction from a prior examination
		if ($patient = Patient::model()->findByPk(@$_GET['patient_id'])) {
			if ($episode = $patient->getEpisodeForCurrentSubspecialty()) {
				if ($api = Yii::app()->moduleAPI->get('OphCiExamination')) {
					/*if ($predicted_refraction = $api->getMostRecentPredictedRefractionInEpisode($episode)) {
						$this->target_refraction = $predicted_refraction;
					}*/
				}
			}
		}
	}
}
?>
