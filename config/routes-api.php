<?php

use app\modules\v1\controllers\LeadController;

return [
	'GET v1/leads'                  => '/v1/lead',
	'POST v1/leads'                 => '/v1/lead/create',
	'GET v1/leads/<id:\d+>'         => '/v1/lead/view',
	'PUT  v1/leads/<id:\d+>/update' => '/v1/lead/update',
	'DELETE v1/leads/<id:\d+>'      => '/v1/lead/delete',


	// Sources
	'POST v1/sources'               => '/v1/source/create',

	// Auth

	'POST v1/auth' => 'v1/default/auth'
];
