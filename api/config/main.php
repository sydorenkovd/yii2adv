<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php')
);

return [
    'id' => 'app-api',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'api\controllers',
    'bootstrap' => ['log'],
    'modules' => [],
    
    'components' => [
        
        'request' => [
            'parsers' => [
                'application/json' => 'yii\web\JsonParser',
            ]
        ],   
        
		/*
        'response' => [
        
            'format' => yii\web\Response::FORMAT_JSON,
            'charset' => 'UTF-8',
            'class' => '\api\components\ApiResponse',

        ], 		    
        */
        
        
        'response' => [
        	'formatters' => [
        	
		        'rss' => [
		            'format' => 'raw',
		            'charset' => 'UTF-8',
		            'class' => '\api\components\RssResponseFormatter',	        
		        ],				
				
		    ]

        ], 	        
        
        
        'user' => [
            'identityClass' => '\common\models\User',
            'enableSession' => false,
            'loginUrl' => null
        ],        
        
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
        ],        
        
        
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],

    ],
    'params' => $params,
];
