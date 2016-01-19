<?php

class DefaultController extends BaseEventTypeController
{
	public $flash_message = '<b>Data source</b>: Manual entry <i>This data should not be relied upon for clinical purposes</i>';
	public $is_auto=0;
	public $iolRefValues = array();
	public $selectionValues = array();
	public $quality=0;

	/**
	 * @param Event $unlinkedEvent
	 * @param OphInBiometry_Imported_Events $importedEvent
     */
	private function updateImportedEvent(Event $unlinkedEvent, OphInBiometry_Imported_Events $importedEvent){
		$unlinkedEvent->episode_id = $this->episode->id;
		$importedEvent->is_linked = 1;
		$unlinkedEvent->save();
		$importedEvent->save();
	}

	/**
	 * Handle the selection of a booking for creating an op note
	 *
	 * (non-phpdoc)
	 * @see parent::actionCreate()
	 */
	public function actionCreate()
	{
		$errors = array();

		// if we are after the submit we need to check if any event is selected
		if (preg_match('/^biometry([0-9]+)$/', Yii::app()->request->getPost('SelectBiometry'), $m)) {
			$importedEvent = OphInBiometry_Imported_Events::model()->findByPk($m[1]);
			$this->updateImportedEvent(Event::model()->findByPk($importedEvent->event_id), $importedEvent);
			$this->redirect(array('/OphInBiometry/default/view/' . $importedEvent->event_id.'?autosaved=1'));
		}

		$criteria = new CDbCriteria();

		// we are looking for the unlinked imported events in the database
		$criteria->addCondition("patient_id = :patient_id");
		$criteria->addCondition("is_linked = 0");
		$criteria->params = array(':patient_id' => $this->patient->id);
		$unlinkedEvents = OphInBiometry_Imported_Events::model()->with('patient')->findAll($criteria);

		// if we have 0 unlinked event we follow the manual process
		if (sizeof($unlinkedEvents) == 0 || Yii::app()->request->getQuery("force_manual")=="1") {
			Yii::app()->user->setFlash('issue.formula', $this->flash_message);
			parent::actionCreate();
		}
		// we might need this later for automated linking process
		//elseif (sizeof($unlinkedEvents) == 1) {
			// if we have only 1 unlinked event we just simply link that event to the episode
		//	$this->updateImportedEvent(Event::model()->findByPk($unlinkedEvents[0]->event_id), $unlinkedEvents[0]);
		//	$this->redirect(array('/OphInBiometry/default/update/' . $unlinkedEvents[0]->event_id));
		//}elseif (sizeof($unlinkedEvents) > 1) {
		else{
				// if we have more than 1 event we render the selection screen
			$this->title = "Please Select a Biometry Report";
			$this->event_tabs = array(
				array(
					'label' => 'The following Biometry reports are available for this patient:',
					'active' => true,
				),
			);
			$cancel_url = ($this->episode) ? '/patient/episode/' . $this->episode->id : '/patient/episodes/' . $this->patient->id;
			$this->event_actions = array(
				EventAction::link('Cancel',
					Yii::app()->createUrl($cancel_url),
					null, array('class' => 'button small warning')
				)
			);

			$this->render('select_imported_event', array(
				'errors' => $errors,
				'imported_events' => $unlinkedEvents,
			));

		}
	}

	/**
	 * @param $id
	 */
	private  function setFlashMessage($id){

		if($this->isAutoBiometryEvent($id))
		{
			$this->is_auto=1;
			$event_data = $this->getAutoBiometryEventData($id);
			$isAlMod = $this->isAlModified($id);
			$isKMod =  $this->isKModified($id);

			if(($isAlMod['left']) && ($isAlMod['right'])) {
				$this->flash_message = 'AL for both eyes was entered manually. Possibly Ultrasound? Use with caution.';
				Yii::app()->user->setFlash('warning.botheyesalmodified', $this->flash_message);

			}else {
				if ($isAlMod['left']) {
					$this->flash_message = 'AL for left eye was entered manually. Possibly Ultrasound? Use with caution.';
					Yii::app()->user->setFlash('warning.lefteyealmodified', $this->flash_message);
				} elseif ($isAlMod['right']) {
					$this->flash_message = 'AL for right eye was entered manually. Possibly Ultrasound? Use with caution.';
					Yii::app()->user->setFlash('warning.righteyealmodified', $this->flash_message);
				}
			}

			if(($isKMod['left']) && ($isKMod['right'])) {
				$this->flash_message = '* K value for both eyes was entered manually. Use with caution.';
				Yii::app()->user->setFlash('warning.botheyeskmodified', $this->flash_message);

			}else {
				if ($isKMod['left']) {
					$this->flash_message = '* K value for left eye was entered manually. Use with caution.';
					Yii::app()->user->setFlash('warning.lefteyekmodified', $this->flash_message);
				} elseif ($isKMod['right']) {
					$this->flash_message = '* K value for right eye was entered manually. Use with caution.';
					Yii::app()->user->setFlash('warning.righteyekmodified', $this->flash_message);
				}
			}

			foreach ($event_data as $detail)
			{
				$this->flash_message= '<b>Data Source</b>: '.$detail['device_name'].' (<i>'.$detail['device_manufacturer'] .' '. $detail['device_model'].'</i>)';
				Yii::app()->user->setFlash('issue.formula', $this->flash_message);

				if($detail['is_merged']){
					$this->flash_message= 'New data has been added to this event.';
					Yii::app()->user->setFlash('success.merged', $this->flash_message);
					$this->mergedView($id);
				}

				if(Yii::app()->request->getParam('autosaved')){
					$this->flash_message= 'The event has been added to this episode.';
					Yii::app()->user->setFlash('success.merged', $this->flash_message);
				}
			}
			$quality  = $this->isBadQuality($id);

			if( !empty($quality) && ($quality['code']))
			{
				$this->flash_message= '<b>The quality of this biometry data is bad and not recommended for clinical use </b>: ('.$quality['reason'].')';
				Yii::app()->user->setFlash('warning.quality', $this->flash_message);
			}
			else
			{
				$quality  = $this->isBordelineQuality($id);
				if( !empty($quality) && ($quality['code'])){
					$this->flash_message= '<b>The quality of this biometry data is borderline </b>: ('.$quality['reason'].')';
					Yii::app()->user->setFlash('warning.quality', $this->flash_message);
				}
			}
		}
		else
		{
			Yii::app()->user->setFlash('issue.formula', $this->flash_message);
		}
	}

	public function actionUpdate($id)
	{
		$this->setFlashMessage($id);

		if($this->event != null &&  $this->event->id > 0) {
			$this->iolRefValues = Element_OphInBiometry_IolRefValues::Model()->findAllByAttributes(
				array(
					'event_id' => $this->event->id,
				));
			$this->selectionValues  = Element_OphInBiometry_Selection::Model()->findAllByAttributes(
				array(
					'event_id' => $this->event->id,
				));
		}
		else
		{
			$this->iolRefValues = array();
		}

		parent::actionUpdate($id);
	}

	public function actionView($id)
	{
		if($this->event != null &&  $this->event->id > 0) {
			$this->iolRefValues = Element_OphInBiometry_IolRefValues::Model()->findAllByAttributes(
				array(
					'event_id' => $this->event->id,
				));
			$this->selectionValues  = Element_OphInBiometry_Selection::Model()->findAllByAttributes(
				array(
					'event_id' => $this->event->id,
				));
		}
		$this->setFlashMessage($id);
		parent::actionView($id);
	}

	public function actionPrint($id)
	{
		parent::actionPrint($id);
	}

	public function processJsVars()
	{
		$lens_types = array();

		foreach (OphInBiometry_LensType_Lens::model()->findAll() as $lens) {
			$lens_types[$lens->name] = array(
				'model' => $lens->name,
				'description' => $lens->description,
				'acon' => (float)$lens->acon,
			);

		}

		$this->jsVars['OphInBioemtry_lens_types'] = $lens_types;

		parent::processJsVars();
	}

	/**
	 * use the split event type javascript and styling
	 *
	 * @param CAction $action
	 * @return bool
	 */
	protected function beforeAction($action)
	{
		Yii::app()->assetManager->registerScriptFile('js/spliteventtype.js', null, null, AssetManager::OUTPUT_SCREEN);
		return parent::beforeAction($action);
	}

	/**
	 * Check Automatic Biometrc Event
	 * @param $id
	 * @return bool
	 */
	protected function isAutoBiometryEvent($id)
	{
		if(count(OphInBiometry_Imported_Events::model()->findAllByAttributes(array('event_id' => $id)))>0)
		{
			return true;
		}
		else
		{
			return false;
		}

	}

	/**
	 * Get Auto Event data
	 * @param $id
	 * @return mixed
	 */
	protected function getAutoBiometryEventData($id)
	{
		return OphInBiometry_Imported_Events::model()->findAllByAttributes(array('event_id' => $id));
	}

	/**
	 * @param $id
	 */
	protected function getMeasurementData($id)
	{
		return Element_OphInBiometry_Measurement::Model()->findAllByAttributes(
			array(
				'event_id' => $this->event->id,
			));

	}

	/**
	 * @param $id
	 */
	protected function mergedView($id)
	{
		Yii::app()->db->createCommand()
			->update('ophinbiometry_imported_events',
				array('is_merged'=>0),
				'event_id=:id',
				array(':id'=>$this->event->id)
			);
	}
	/**
	 * @param $id
	 * @return array
	 */
	private function isBadQuality($id)
	{
		$reason = array();
		$measurementValues = $this->getMeasurementData($id);
		$measurementData = $measurementValues[0];

		if (($measurementData->{'snr_left'}) < 1.6 || ($measurementData->{'snr_right'} < 1.6)) {

			if ($measurementData->{'eye_id'} == 3) {
				$reason['code'] = 1;
				if ($measurementData->{'snr_right'} < 1.6) {
					$reason['reason'] = 'A composite SNR is less than 1.6 for right eye.';
				} elseif ($measurementData->{'snr_left'} < 1.6) {
					$reason['reason'] = 'A composite SNR is less than 1.6 for left eye.';
				}
			} else {
				if ($measurementData->{'eye_id'} == 2 && ($measurementData->{'snr_right'} < 1.6)) {
					$reason['code'] = 1;
					$reason['reason'] = 'A composite SNR is less than 1.6 for right eye.';
				} elseif ($measurementData->{'eye_id'} == 1 && ($measurementData->{'snr_left'} < 1.6)) {
					$reason['code'] = 1;
					$reason['reason'] = 'A composite SNR is less than 1.6 for left eye.';
				}
			}
		} elseif (($measurementData->{'snr_min_left'}) < 1.5 || ($measurementData->{'snr_min_right'} < 1.5)) {
			if ($measurementData->{'eye_id'} == 3) {
				if ($measurementData->{'snr_min_right'} < $measurementData->{'snr_min_left'}) {
					$reason['code'] = 1;
					$reason['reason'] = 'An individual SNR value was less than 1.5 for right eye - Actual value=' . $measurementData->{'snr_min_right'};
				} else {
					$reason['code'] = 1;
					$reason['reason'] = 'An individual SNR value was less than 1.5 for left eye - Actual value=' . $measurementData->{'snr_min_left'};
				}
			} else {
				if (($measurementData->{'eye_id'} == 2) && ($measurementData->{'snr_min_right'} < 1.5)) {
					$reason['code'] = 1;
					$reason['reason'] = 'An individual SNR value was less than 1.5 for right eye - Actual value=' . $measurementData->{'snr_min_right'};
				} elseif ($measurementData->{'eye_id'} == 1 && $measurementData->{'snr_min_left'} < 1.5) {
					$reason['code'] = 1;
					$reason['reason'] = 'An individual SNR value was less than 1.5 for left eye - Actual value=' . $measurementData->{'snr_min_left'};
				}
			}
		} elseif (($measurementData->{'axial_length_left'}) < 21 || ($measurementData->{'axial_length_right'} < 21)) {

			if ($measurementData->{'eye_id'} == 3) {
				$reason['code'] = 1;
				if (($measurementData->{'axial_length_right'} < 21)) {
					$reason['reason'] = 'Axial Length is less than 21 for right eye';
				} elseif ( ($measurementData->{'axial_length_left'} < 21)) {
					$reason['reason'] = 'Axial Length is less than 21 for left eye';
				}
			} else {
				if (($measurementData->{'eye_id'} == 2) && ($measurementData->{'axial_length_right'} < 21)) {
					$reason['code'] = 1;
					$reason['reason'] = 'Axial Length is less than 21 for right eye';
				} elseif (($measurementData->{'eye_id'} == 1) && ($measurementData->{'axial_length_left'} < 21)) {
					$reason['code'] = 1;
					$reason['reason'] = 'Axial Length is less than 21 for left eye';
				}
			}
		}

		return $reason;

	}

	/**
	 * @param $id
	 * @return array
	 */
	private function isBordelineQuality($id)
	{
		$reason = array();
		$measurementValues = $this->getMeasurementData($id);
		$measurementData = $measurementValues[0];

		if (($measurementData->{'snr_left'}) < 15 || ($measurementData->{'snr_right'} < 15)) {
			if ($measurementData->{'eye_id'} == 3) {
				$reason['code'] = 1;
				if ( ($measurementData->{'snr_right'} < 15)) {
					$reason['reason'] = 'A composite SNR is less than 15 for right eye';
				} elseif (($measurementData->{'snr_left'}) < 15) {
					$reason['reason'] = 'A composite SNR is less than 15 for left eye';
				}
			} else {
				if (($measurementData->{'eye_id'} == 2) && ($measurementData->{'snr_right'} < 15)) {
					$reason['code'] = 1;
					$reason['reason'] = 'A composite SNR is less than 15 for right eye';
				} elseif ($measurementData->{'eye_id'} == 1 && ($measurementData->{'snr_left'}) < 15) {
					$reason['code'] = 1;
					$reason['reason'] = 'A composite SNR is less than 15 for left eye';
				}
			}
		} elseif (($measurementData->{'snr_min_left'}) < 2 || ($measurementData->{'snr_min_right'} < 2)) {
			if ($measurementData->{'eye_id'} == 3) {

				if ($measurementData->{'snr_min_left'} < $measurementData->{'snr_min_right'}) {
					$reason['code'] = 1;
					$reason['reason'] = 'An individual SNR value was less than 2.0  for left eys - Actual value=' . $measurementData->{'snr_min_left'};

				} else {
					$reason['code'] = 1;
					$reason['reason'] = 'An individual SNR value was less than 2.0 for right eye - Actual value=' . $measurementData->{'snr_min_right'};
				}
			} else {
				if (($measurementData->{'eye_id'} == 2) && ($measurementData->{'snr_min_right'} < 2)) {
					$reason['code'] = 1;
					$reason['reason'] = 'An individual SNR value was less than 2.0 for right eye - Actual value=' . $measurementData->{'snr_min_right'};

				} elseif ($measurementData->{'eye_id'} == 1 && ($measurementData->{'snr_min_left'}) < 2) {
					$reason['code'] = 1;
					$reason['reason'] = 'An individual SNR value was less than 2.0 - Actual value=' . $measurementData->{'snr_min_left'};
				}
			}

		} elseif (($measurementData->{'axial_length_left'}) < 22 || ($measurementData->{'axial_length_right'} < 22)) {
			if ($measurementData->{'eye_id'} == 3) {
				$reason['code'] = 1;
				if ($measurementData->{'axial_length_right'} < 22) {
					$reason['reason'] = 'Axial Length is less than 22 for right eye';
				} elseif ($measurementData->{'axial_length_left'} < 22) {
					$reason['reason'] = 'Axial Length is less than 22 for left eye';
				}
			} else {
				if (($measurementData->{'eye_id'} == 2) && ($measurementData->{'axial_length_right'} < 22)) {
					$reason['code'] = 1;
					$reason['reason'] = 'Axial Length is less than 22 for right eye';
				} elseif ($measurementData->{'eye_id'} == 1 && $measurementData->{'axial_length_left'} < 22) {
					$reason['code'] = 1;
					$reason['reason'] = 'Axial Length is less than 22 for left eye';
				}
			}
		} elseif ((($measurementData->{'axial_length_left'}) > ($measurementData->{'axial_length_right'}))) {
			if ($measurementData->{'eye_id'} == 3) {
				if ((($measurementData->{'axial_length_left'}) - ($measurementData->{'axial_length_right'})) >= 3) {
					$reason['code'] = 1;
					$reason['reason'] = 'The axial length is more than 3mm different between eyes';
				}
			}
		} elseif ((($measurementData->{'axial_length_left'}) < ($measurementData->{'axial_length_right'}))) {
			if ($measurementData->{'eye_id'} == 3) {
				if ((($measurementData->{'axial_length_right'}) - ($measurementData->{'axial_length_left'})) >= 3) {
					$reason['code'] = 1;
					$reason['reason'] = 'The axial length is more than 3mm different between eyes';
				}
			}
		}
		return $reason;

	}

	/**
	 * @param $search
	 * @param $arr
	 * @return null
	 */
	public function getClosest($search, $arr) {
		$closest = null;
		foreach ($arr as $item) {
			if ($closest === null || abs($search - $closest) > abs($item - $search)) {
				$closest = $item;
			}
		}
		return $closest;
	}

	/**
	 * @param $id
	 * @return mixed
	 */

	private function isAlModified($id){
		$measurementValues = $this->getMeasurementData($id);
		$measurementData = $measurementValues[0];

		$data['left'] = $measurementData->{'al_modified_left'};
		$data['right'] = $measurementData->{'al_modified_right'};
		return $data;
	}

	/**
	 * @param $id
	 * @return mixed
	 */
	private function isKModified($id){
		$measurementValues = $this->getMeasurementData($id);
		$measurementData = $measurementValues[0];

		$data['left'] = $measurementData->{'k_modified_left'};
		$data['right'] = $measurementData->{'k_modified_right'};
		return $data;
	}
}


