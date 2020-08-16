<?php


namespace app\modules\v1\models;


use app\models\Sources;
use yii\base\Model;
use yii\validators\RequiredValidator;

class SourceForm extends Model
{
	public $title;
	const ATTR_TITLE = 'title';

	public $slug;
	const ATTR_SLUG = 'slug';
	/**
	 * @var Sources
	 */
	private $model;

	public function __construct(Sources $model, $config = [])
	{
		$this->model = $model;

		if (!$model->isNewRecord) {
			$this->title = $model->title;
			$this->slug  = $model->slug;
		}

		parent::__construct($config);

	}

	/**
	 * @return string
	 */
	public function formName()
	{
		return '';
	}

	public function rules()
	{
		return [
			[static::ATTR_TITLE, RequiredValidator::class],
			[static::ATTR_SLUG, RequiredValidator::class]
		];
	}

	/**
	 * @return bool
	 */
	public function save(): bool
	{
		if (!$this->validate()) {
			return false;
		}

		$this->model->slug  = $this->slug;
		$this->model->title = $this->title;

		return $this->model->save();
	}
}
