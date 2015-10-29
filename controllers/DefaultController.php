<?php

class DefaultController extends BaseEventTypeController
{
	public $flash_message = '<b>Data source</b>: Manual entry <i>This data should not be relied upon for clinical purposes</i>';
	public $is_auto=0;


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


