<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%lead_types}}`.
 */
class m200815_223343_create_lead_types_table extends Migration
{
	const TABLE_NAME = 'sources';

	/**
	 * {@inheritdoc}
	 */
	public function safeUp()
	{
		$this->createTable(static::TABLE_NAME, [
			'id'    => $this->primaryKey(),
			'title' => $this->string()->notNull(),
			'slug'  => $this->string()->notNull(),
		]);
	}

	/**
	 * {@inheritdoc}
	 */
	public function safeDown()
	{
		$this->dropTable(static::TABLE_NAME);
	}
}
