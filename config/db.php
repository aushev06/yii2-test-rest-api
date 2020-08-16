<?php

return [
	'class'    => yii\db\Connection::class,
	'dsn'      => env('YII2_DB_DSN'),
	'charset'  => env('YII2_DB_CHARSET', 'utf8'),
	'username' => env('MYSQL_USER'),
	'password' => env('MYSQL_PASSWORD'),

	// Schema cache options (for production environment)
	//'enableSchemaCache' => true,
	//'schemaCacheDuration' => 60,
	//'schemaCache' => 'cache',
];
