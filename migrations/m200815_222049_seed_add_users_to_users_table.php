<?php

use yii\db\Migration;

/**
 * Class m200815_222049_seed_add_users_to_users_table
 */
class m200815_222049_seed_add_users_to_users_table extends Migration
{
	/**
	 * {@inheritdoc}
	 */
	public function safeUp()
	{
		$this->insert('users', [
			'id'            => 1,
			'username'      => 'root',
			'password_hash' => Yii::$app->getSecurity()->generatePasswordHash('secret'),
			'token'         => '$2y$13$ncKTXc5zQx83Pwq4/1.Xn.6iaWtXrAigGVYaNfkxUyefM7PI4RFvO',
			'auth_key'      => Yii::$app->getSecurity()->generatePasswordHash('auth_key'),
		]);
	}

	/**
	 * {@inheritdoc}
	 */
	public function safeDown()
	{
		$this->delete('users', ['id' => 1]);
	}
}
