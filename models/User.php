<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * Class User
 *
 * @property integer $id
 * @property string $username
 * @property string $token
 * @property string $password_hash
 * @property string $auth_key
 */
class User extends ActiveRecord implements \yii\web\IdentityInterface
{
	const ATTR_ID            = 'id';
	const ATTR_USERNAME      = 'username';
	const ATTR_TOKEN         = 'token';
	const ATTR_PASSWORD_HASH = 'password_hash';
	const ATTR_AUTH_KEY      = 'auth_key';

	public function fields()
	{
		return [static::ATTR_ID, static::ATTR_USERNAME, static::ATTR_TOKEN];
	}

	/**
	 * @return string
	 * @author Aushev Ibra <aushevibra@yandex.ru>
	 */
	public static function tableName()
	{
		return 'users';
	}

	/**
	 * {@inheritdoc}
	 */
	public static function findIdentity($id)
	{
		return static::findOne($id);
	}

	/**
	 * {@inheritdoc}
	 */
	public static function findIdentityByAccessToken($token, $type = null)
	{
		return static::findOne([static::ATTR_TOKEN => $token]);
	}

	/**
	 * Finds user by username
	 *
	 * @param string $username
	 * @return static|null
	 */
	public static function findByUsername(string $username): ?User
	{
		return static::findOne([static::ATTR_USERNAME => $username]);
	}

	/**
	 * {@inheritdoc}
	 */
	public function getId()
	{
		return $this->id;
	}

	/**
	 * {@inheritdoc}
	 */
	public function getAuthKey()
	{
		return $this->auth_key;
	}

	/**
	 * {@inheritdoc}
	 */
	public function validateAuthKey($authKey)
	{
		return $this->auth_key === $authKey;
	}

	/**
	 * Validates password
	 *
	 * @param string $password password to validate
	 * @return bool if password provided is valid for current user
	 */
	public function validatePassword($password)
	{
		return Yii::$app->getSecurity()->validatePassword($password, $this->password_hash);
	}
}
