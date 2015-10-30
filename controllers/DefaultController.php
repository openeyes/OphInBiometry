<?php

class DefaultController extends BaseEventTypeController
{
	public $flash_message = '<b>Data source</b>: Manual entry <i>This data should not be relied upon for clinical purposes</i>';
	public $is_auto=0;

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
			$this->redirect(array('/OphInBiometry/default/update/' . $importedEvent->event_id));
		}

		$criteria = new CDbCriteria();

		// we are looking for the unlinked imported events in the database
		$criteria->addCondition("patient_id = :patient_id");
		$criteria->addCondition("is_linked = 0");
		$criteria->params = array(':patient_id' => $this->patient->id);
		$unlinkedEvents = OphInBiometry_Imported_Events::model()->with('patient')->findAll($criteria);

		// if we have 0 unlinked event we follow the manual process
		if (sizeof($unlinkedEvents) == 0 || Yii::app()->request->getQuery("force_manual")=="1") {
			Yii::app()->user->setFlash('warning.formula', $this->flash_message);
			parent::actionCreate();
		} elseif (sizeof($unlinkedEvents) == 1) {
			// if we have only 1 unlinked event we just simply link that event to the episode
			$this->updateImportedEvent(Event::model()->findByPk($unlinkedEvents[0]->event_id), $unlinkedEvents[0]);
			$this->redirect(array('/OphInBiometry/default/update/' . $unlinkedEvents[0]->event_id));
		} elseif (sizeof($unlinkedEvents) > 1) {
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




	private  function setFlashMessage($id){
		if($this->isAutoBiometryEvent($id))
		{
			$this->is_auto=1;
			$event_data = $this->getAutoBiometryEventData($id);
			foreach ($event_data as $detail)
			{
				$this->flash_message= '<b>Data Source</b>: '.$detail['device_name'].' (<i>'.$detail['device_manufacturer'] .' '. $detail['device_model'].'</i>)';
			}

			Yii::app()->user->setFlash('warning.formula', $this->flash_message);
		}
		else
		{
			Yii::app()->user->setFlash('warning.formula', $this->flash_message);
		}
	}

	public function actionCreate()
	{
		Yii::app()->user->setFlash('warning.formula', $this->flash_message);
		parent::actionCreate();
	}

	public function actionUpdate($id)
	{
		$this->setFlashMessage($id);
		parent::actionUpdate($id);
	}

	public function actionView($id)
	{
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
}


