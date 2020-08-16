<?php

namespace app\modules\v1\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Leads;

/**
 * LeadsSearch represents the model behind the search form of `app\models\Leads`.
 */
class LeadsSearch extends ApiLead
{
	/**
	 * {@inheritdoc}
	 */
	public function rules()
	{
		return [
			[['id', 'status', 'created_by', 'source_id'], 'safe'],
			[['name'], 'safe'],
		];
	}

	/**
	 * {@inheritdoc}
	 */
	public function scenarios()
	{
		// bypass scenarios() implementation in the parent class
		return Model::scenarios();
	}

	public function formName()
	{
		return '';
	}

	/**
	 * Creates data provider instance with search query applied
	 *
	 * @param array $params
	 *
	 * @return ActiveDataProvider
	 */
	public function search($params)
	{
		$query = Leads::find();

		// add conditions that should always apply here

		$dataProvider = new ActiveDataProvider([
			'query'      => $query,
			'pagination' => [
				'pageSize' => 10,
			],
		]);

		$this->load($params);

		if (!$this->validate()) {
			// uncomment the following line if you do not want to return any records when validation fails
			// $query->where('0=1');
			return $dataProvider;
		}

		// grid filtering conditions
		$query->andFilterWhere([
			'id'         => $this->id,
			'status'     => $this->status,
			'created_by' => $this->created_by,
			'source_id'  => $this->source_id,
		]);

		$query->andFilterWhere(['like', 'name', $this->name]);

		return $dataProvider;
	}
}
