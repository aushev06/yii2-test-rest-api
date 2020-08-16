<?php


namespace app\services;


use app\models\Leads;
use app\modules\v1\models\LeadForm;

class LeadService
{
	public function save(array $data, Leads $activeRecord)
	{
		$form = new LeadForm($activeRecord);
		if ($form->load($data) && $form->validate()) {
			$activeRecord->setAttributes($form->getAttributes());
			$activeRecord->save();
			return $activeRecord;
		}

		return $form;
	}
}
