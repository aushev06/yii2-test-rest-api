<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "sources".
 *
 * @property int $id
 * @property string $title
 * @property string $slug
 *
 * @property Leads[] $leads
 */
class Sources extends \yii\db\ActiveRecord
{
	const ATTR_ID    = 'id';
	const ATTR_TITLE = 'title';
	const ATTR_SLUG  = 'slug';

	/**
	 * {@inheritdoc}
	 */
	public static function tableName()
	{
		return 'sources';
	}

	/**
	 * {@inheritdoc}
	 */
	public function rules()
	{
		return [
			[['title', 'slug'], 'required'],
			[['title', 'slug'], 'string', 'max' => 255],
		];
	}

	/**
	 * {@inheritdoc}
	 */
	public function attributeLabels()
	{
		return [
			'id'    => 'ID',
			'title' => 'Title',
			'slug'  => 'Slug',
		];
	}

	/**
	 * Gets query for [[Leads]].
	 *
	 * @return \yii\db\ActiveQuery
	 */
	public function getLeads()
	{
		return $this->hasMany(Leads::class, ['source_id' => 'id']);
	}
}
