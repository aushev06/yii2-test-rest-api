<?php


namespace app\modules\v1\models;


use app\models\Leads;

class ApiLead extends Leads
{
	public function fields()
	{
		$fields = parent::fields();
		return array_merge($fields, [
			'statusText' => function ($model) {
				return static::getStatusesVariant()[$model->status];
			}
		]);
	}

}
