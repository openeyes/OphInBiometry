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
 * This is the model class for table "et_ophinbiometry_lenstype".
 *
 * The followings are the available columns in table:
 * @property string $id
 * @property integer $event_id
 * @property integer $lens_id_left
 * @property integer $lens_id_right
 *
 * The followings are the available model relations:
 *
 * @property ElementType $element_type
 * @property EventType $eventType
 * @property Event $event
 * @property User $user
 * @property User $usermodified
 * @property OphInBiometry_LensType_Lens $lens
 */

class Element_OphInBiometry_LensType extends SplitEventTypeElement
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
        return 'et_ophinbiometry_lenstype';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array(
                'event_id, eye_id, lens_id_left, lens_id_right, k1_left, k1_right, k2_left, k2_right, axis_k1_left, axis_k1_right, axial_length_left, axial_length_right, snr_left, snr_right',
                'safe'
            ),
            array(
                'k1_left, k1_right, k2_left, k2_right, axial_length_left, axial_length_right',
                'match',
                'pattern' => '/([0-9]*?)(\.[0-9]{0,2})?/'
            ),
            array(
                'axis_k1_left, axis_k1_right, snr_left, snr_right',
                'match',
                'pattern' => '/([0-9]*?)(\.[0-9]{0,1})?/'
            ),
            array(
                'snr_left, k1_left, k2_left, axis_k1_left, axial_length_left, lens_id_left',
                'requiredIfSide',
                'side' => 'left'
            ),
            array(
                'snr_right, k1_right, k2_right, axis_k1_right, axial_length_right, lens_id_right',
                'requiredIfSide',
                'side' => 'right'
            ),
            array('snr_left', 'checkNumericRangeIfSide', 'side'=>'left','integerOnly' => true, 'max' => 200, 'min' => 0),
            array('snr_right', 'checkNumericRangeIfSide', 'side'=>'right','integerOnly' => true, 'max' => 200, 'min' => 0),
            array('k1_left, k2_left', 'checkNumericRangeIfSide', 'side'=>'left', 'max' => 60, 'min' => 30),
            array('k1_right, k2_right', 'checkNumericRangeIfSide', 'side'=>'right', 'max' => 60, 'min' => 30),
            array('axis_k1_left', 'checkNumericRangeIfSide', 'side'=>'left','max' => 180, 'min' => 0),
            array('axis_k1_right', 'checkNumericRangeIfSide', 'side'=>'right', 'max' => 180, 'min' => 0),
            array('axial_length_left', 'checkNumericRangeIfSide', 'side'=>'left', 'max' => 40, 'min' => 15),
            array('axial_length_right', 'checkNumericRangeIfSide', 'side'=>'right', 'max' => 40, 'min' => 15),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, event_id', 'safe', 'on' => 'search'),
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
            'element_type' => array(
                self::HAS_ONE,
                'ElementType',
                'id',
                'on' => "element_type.class_name='" . get_class($this) . "'"
            ),
            'eventType' => array(self::BELONGS_TO, 'EventType', 'event_type_id'),
            'event' => array(self::BELONGS_TO, 'Event', 'event_id'),
            'user' => array(self::BELONGS_TO, 'User', 'created_user_id'),
            'usermodified' => array(self::BELONGS_TO, 'User', 'last_modified_user_id'),
            'lens_left' => array(self::BELONGS_TO, 'OphInBiometry_LensType_Lens', 'lens_id_left'),
            'lens_right' => array(self::BELONGS_TO, 'OphInBiometry_LensType_Lens', 'lens_id_right'),
            'eye' => array(self::BELONGS_TO, 'Eye', 'eye_id'),
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
            'lens_id' => 'Lens',
            'lens_id_right' => 'Lens',
            'lens_id_left' => 'Lens',
            'k1_left' => 'K1 (D)',
            'k1_right' => 'K1 (D)',
            'k2_left' => 'K2 (D)',
            'k2_right' => 'K2 (D)',
            'axis_k1_left' => 'Axis K1 (D)',
            'axis_k1_right' => 'Axis K1 (D)',
            'axial_length_left' => 'Axial length (mm)',
            'axial_length_right' => 'Axial length (mm)',
            'snr_left' => 'SNR',
            'snr_right' => 'SNR',
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

        return new CActiveDataProvider(get_class($this), array(
            'criteria' => $criteria,
        ));
    }

    public function isRequiredInUI()
    {
        return true;
    }
}
