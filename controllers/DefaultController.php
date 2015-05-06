<?php

class DefaultController extends BaseEventTypeController
{
	public $flash_message = 'Refer to the IOL Master Sheet as the Source of Truth';

	public function actionCreate()
	{
		Yii::app()->user->setFlash('warning.formula', $this->flash_message);
		parent::actionCreate();
	}

	public function actionUpdate($id)
	{
		Yii::app()->user->setFlash('warning.formula', $this->flash_message);
		parent::actionUpdate($id);
	}

	public function actionView($id)
	{
		Yii::app()->user->setFlash('warning.formula', $this->flash_message);
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
}


