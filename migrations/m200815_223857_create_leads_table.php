<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%leads}}`.
 */
class m200815_223857_create_leads_table extends Migration
{
	const TABLE_NAME = 'leads';

	/**
	 * {@inheritdoc}
	 */
	public function safeUp()
	{
		$this->createTable(static::TABLE_NAME, [
			'id'         => $this->primaryKey(),
			'name'       => $this->string()->notNull(),
			'status'     => $this->integer()->notNull(),
			'created_by' => $this->integer(),
			'source_id'  => $this->integer(),
			'created_at' => $this->integer(),
			'updated_at' => $this->integer()->null(),
			'deleted_at' => $this->integer()->null(),
		]);


		$this->createIndex('idx-' . static::TABLE_NAME . '[status]', static::TABLE_NAME, 'status');
		$this->addForeignKey('fk-' . static::TABLE_NAME . '[user]', static::TABLE_NAME, 'created_by', 'users', 'id');
		$this->addForeignKey('fk-' . static::TABLE_NAME . '[source]', static::TABLE_NAME, 'source_id', 'sources', 'id');

	}

	/**
	 * {@inheritdoc}
	 */
	public function safeDown()
	{
		$this->dropTable(static::TABLE_NAME);
	}
}
