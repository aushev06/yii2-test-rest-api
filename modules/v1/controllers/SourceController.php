<?php


namespace app\modules\v1\controllers;


use app\models\Sources;
use app\modules\v1\models\SourceForm;

class SourceController extends DefaultController
{
	public function actionCreate()
	{
		$model = new Sources();
		$data  = \Yii::$app->request->post();
		$form  = new SourceForm($model);

		if ($form->load($data) && $form->save()) {
			return $model;
		}
		return $form;
	}
}
