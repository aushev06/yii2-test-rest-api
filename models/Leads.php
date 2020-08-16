<?php

namespace app\models;

use app\core\behaviors\DateTimeBehavior;
use Yii;
use yii\behaviors\BlameableBehavior;
use yii\validators\NumberValidator;
use yii\validators\RequiredValidator;
use yii\validators\StringValidator;

/**
 * This is the model class for table "leads".
 *
 * @property int $id
 * @property string $name
 * @property int $status
 * @property int|null $created_by
 * @property int|null $source_id
 * @property int|null $created_at
 * @property int|null $updated_at
 * @property int|null $deleted_at
 *
 * @property Sources $source
 * @property User $createdBy
 */
class Leads extends \yii\db\ActiveRecord
{
	const ATTR_ID         = 'id';
	const ATTR_NAME       = 'name';
	const ATTR_CREATED_BY = 'created_by';
	const ATTR_STATUS     = 'status';
	const ATTR_SOURCE_ID  = 'source_id';
	const ATTR_CREATED_AT = 'created_at';
	const ATTR_UPDATED_AT = 'updated_at';
	const ATTR_DELETED_AT = 'deleted_at';

	const STATUS_ACTIVE   = 1;
	const STATUS_INACTIVE = 0;

	/**
	 * {@inheritdoc}
	 */
	public static function tableName()
	{
		return 'leads';
	}

	/**
	 * {@inheritdoc}
	 */
	public function rules()
	{
		return [
			[[static::ATTR_NAME, static::ATTR_SOURCE_ID], RequiredValidator::class],
			[[
				 static::ATTR_CREATED_BY,
				 static::ATTR_SOURCE_ID,
				 static::ATTR_CREATED_AT,
				 static::ATTR_UPDATED_AT,
				 static::ATTR_DELETED_AT,
				 static::ATTR_STATUS,
			 ],
			 NumberValidator::class
			],
			[static::ATTR_STATUS, 'in', 'range' => [static::STATUS_INACTIVE, static::STATUS_ACTIVE]],
			[[static::ATTR_NAME], StringValidator::class, 'max' => 255],
			[[static::ATTR_SOURCE_ID],
			 'exist',
			 'skipOnError'     => true,
			 'targetClass'     => Sources::class,
			 'targetAttribute' => [static::ATTR_SOURCE_ID => Sources::ATTR_ID]],
			[[static::ATTR_CREATED_BY],
			 'exist',
			 'skipOnError'     => true,
			 'targetClass'     => User::class,
			 'targetAttribute' => [static::ATTR_CREATED_BY => User::ATTR_ID]],
		];
	}

	/**
	 * {@inheritdoc}
	 */
	public function attributeLabels()
	{
		return [
			'id'         => 'ID',
			'name'       => 'Name',
			'created_by' => 'Created By',
			'source_id'  => 'Source ID',
			'created_at' => 'Created At',
			'updated_at' => 'Updated At',
			'deleted_at' => 'Deleted At',
		];
	}

	/**
	 * Gets query for [[Source]].
	 *
	 * @return \yii\db\ActiveQuery|yii\db\ActiveQuery
	 */
	public function getSource()
	{
		return $this->hasOne(Sources::class, ['id' => 'source_id']);
	}

	/**
	 * Gets query for [[CreatedBy]].
	 *
	 * @return \yii\db\ActiveQuery
	 */
	public function getCreatedBy()
	{
		return $this->hasOne(User::class, ['id' => 'created_by']);
	}

	/**
	 * {@inheritdoc}
	 * @return LeadsQuery the active query used by this AR class.
	 */
	public static function find()
	{
		return new LeadsQuery(get_called_class());
	}

	/**
	 * @return string[]
	 * @author Aushev Ibra <aushevibra@yandex.ru>
	 */
	public static function getStatusesVariant()
	{
		return [
			static::STATUS_INACTIVE => 'Inactive',
			static::STATUS_ACTIVE   => 'Active',

		];
	}

	public function behaviors()
	{
		return array_merge(parent::behaviors(), [
			['class'                                     => DateTimeBehavior::class,
			 DateTimeBehavior::ATTR_CREATED_AT_ATTRIBUTE => static::ATTR_CREATED_AT,
			 DateTimeBehavior::ATTR_UPDATED_AT_ATTRIBUTE => static::ATTR_UPDATED_AT,
			 DateTimeBehavior::ATTR_VALUE                => time(),
			],
			"blameable" => [
				'class'              => BlameableBehavior::class,
				'createdByAttribute' => static::ATTR_CREATED_BY,
				'updatedByAttribute' => null,
			],
		]);
	}
}
