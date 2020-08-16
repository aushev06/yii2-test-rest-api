<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%users}}`.
 */
class m200814_184003_create_users_table extends Migration
{
	const TABLE_NAME = 'users';

	/**
	 * {@inheritdoc}
	 */
	public function safeUp()
	{
		$this->createTable(static::TABLE_NAME, [
			'id'            => $this->primaryKey(),
			'username'      => $this->string()->notNull()->unique(),
			'token'         => $this->string()->notNull()->unique(),
			'password_hash' => $this->string()->notNull(),
			'auth_key'      => $this->string()->notNull(),
		], 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB');
	}

	/**
	 * {@inheritdoc}
	 */
	public function safeDown()
	{
		$this->dropTable(static::TABLE_NAME);
	}
}
