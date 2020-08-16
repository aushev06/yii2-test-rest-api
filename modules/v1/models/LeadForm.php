<?php


namespace app\modules\v1\models;


use app\models\Leads;
use yii\base\Model;
use yii\validators\NumberValidator;
use yii\validators\RequiredValidator;

class LeadForm extends Model
{

	public $name;
	const ATTR_NAME = 'name';

	public $status;
	const ATTR_STATUS = 'status';

	public $source_id;
	const ATTR_SOURCE_ID = 'source_id';
	/**
	 * @var Leads
	 */
	public $model;


	public function __construct(Leads $model, $config = [])
	{
		$this->model = $model;
		if (false === $model->isNewRecord) {
			$this->name      = $model->name;
			$this->source_id = $model->source_id;
			$this->status    = $model->status;
		}
		parent::__construct($config);
	}

	public function rules()
	{
		return [
			[static::ATTR_NAME, RequiredValidator::class],
			[static::ATTR_SOURCE_ID, RequiredValidator::class],
			[static::ATTR_SOURCE_ID, NumberValidator::class],
			[static::ATTR_STATUS, RequiredValidator::class],
			[static::ATTR_STATUS, NumberValidator::class],
		];
	}

	public function formName()
	{
		return '';
	}
}
