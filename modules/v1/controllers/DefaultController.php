<?php

namespace app\modules\v1\controllers;


use app\models\LoginForm;
use Yii;
use yii\filters\auth\HttpBearerAuth;
use yii\filters\Cors;
use yii\filters\VerbFilter;
use yii\helpers\Inflector;
use yii\helpers\StringHelper;

/**
 * Default controller for the `v1` module
 */
class DefaultController extends \yii\rest\Controller
{
	const ACTION_INDEX  = 'index';
	const ACTION_CREATE = 'create';
	const ACTION_VIEW   = 'view';
	const ACTION_UPDATE = 'update';
	const ACTION_DELETE = 'delete';

	public $serializer = [
		'class'              => 'yii\rest\Serializer',
		'collectionEnvelope' => 'items',
	];

	/**
	 * {@inheritdoc}
	 */
	public function behaviors()
	{
		$behaviors = parent::behaviors();

		// add CORS filter
		$behaviors['corsFilter'] = [
			'class' => Cors::class,
			'cors'  => [
				'Origin'                         => ['*'],
				'Access-Control-Request-Method'  => ['GET', 'POST', 'PUT', 'PATCH', 'DELETE', 'HEAD', 'OPTIONS'],
				'Access-Control-Request-Headers' => ['*'],
			],

		];

		$behaviors['verbs'] = [
			'class'   => VerbFilter::class,
			'actions' => [
				static::ACTION_DELETE => ['DELETE'],
				static::ACTION_CREATE => ['POST'],
				static::ACTION_UPDATE => ['PUT'],
				static::ACTION_VIEW   => ['GET'],
				static::ACTION_INDEX  => ['GET'],
			],
		];

		$behaviors['authenticator']['authMethods'] = [
			HttpBearerAuth::class,
		];

		$behaviors['authenticator']['except'] = [
			'auth'
		];


		return $behaviors;
	}

	public function actionAuth()
	{
		$form = new LoginForm();;

		if ($form->load(Yii::$app->request->post()) && $form->login()) {
			return Yii::$app->user->getIdentity();
		}

		return $form;

	}

	public function actionOptions()
	{
		return true;
	}

}
