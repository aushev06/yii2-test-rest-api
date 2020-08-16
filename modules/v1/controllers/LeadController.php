<?php

namespace app\modules\v1\controllers;

use app\modules\v1\models\ApiLead;
use app\modules\v1\models\LeadForm;
use app\services\LeadService;
use Yii;
use app\models\Leads;
use app\modules\v1\models\LeadsSearch;
use yii\db\Exception;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * LeadController implements the CRUD actions for Leads model.
 */
final class LeadController extends DefaultController
{

	/**
	 * @var LeadService
	 */
	private $service;

	public function __construct($id, $module, LeadService $service, $config = [])
	{
		$this->service = $service;

		parent::__construct($id, $module, $config);
	}

	/**
	 * Lists all Leads models.
	 * @return mixed
	 */
	public function actionIndex()
	{
		$searchModel  = new LeadsSearch();
		$dataProvider = $searchModel->search(Yii::$app->request->queryParams);

		return $dataProvider;
	}

	/**
	 * Displays a single Leads model.
	 * @param integer $id
	 * @return mixed
	 * @throws NotFoundHttpException if the model cannot be found
	 */
	public function actionView($id)
	{
		return $this->findModel($id);
	}

	/**
	 * Creates a new Leads model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 * @return mixed
	 */
	public function actionCreate()
	{
		$data = Yii::$app->request->post();

		return $this->service->save($data, new ApiLead());

	}

	/**
	 * Updates an existing Leads model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id
	 * @return mixed
	 * @throws NotFoundHttpException if the model cannot be found
	 */
	public function actionUpdate($id)
	{
		return $this->service->save(Yii::$app->request->post(), $this->findModel($id));
	}

	/**
	 * Deletes an existing Leads model.
	 * If deletion is successful, the browser will be redirected to the 'index' page.
	 * @param integer $id
	 * @return mixed
	 * @throws NotFoundHttpException if the model cannot be found
	 */
	public function actionDelete($id)
	{
		return $this->findModel($id)->delete();
	}

	/**
	 * Finds the Leads model based on its primary key value.
	 * If the model is not found, a 404 HTTP exception will be thrown.
	 * @param integer $id
	 * @return Leads the loaded model
	 * @throws NotFoundHttpException if the model cannot be found
	 */
	protected function findModel($id)
	{
		if (($model = ApiLead::findOne($id)) !== null) {
			return $model;
		}

		throw new NotFoundHttpException('The requested page does not exist.');
	}
}
