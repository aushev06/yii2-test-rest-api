<?php
declare(strict_types=1);


namespace app\core\behaviors;


use DateTime;
use yii\behaviors\TimestampBehavior;

/**
 * {@inheritdoc}
 *
 */
class DateTimeBehavior extends TimestampBehavior
{
	const ATTR_CREATED_AT_ATTRIBUTE = 'createdAtAttribute';
	const ATTR_UPDATED_AT_ATTRIBUTE = 'updatedAtAttribute';
	const ATTR_VALUE                = 'value';

	/**
	 * {@inheritdoc}
	 *
	 */
	public function init()
	{
		$this->value = function () {
			return (new DateTime)->format('Y-m-d H:i:s');
		};

		parent::init();
	}
}
