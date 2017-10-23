<?php
return [
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
        ],
        'view' => [
            'theme' => [
                'pathMap' => [
                    '@dektrium/user/views' => '@app/views/user',
                    '@dektrium/user/registration/views' => '@app/views/site',
                ],
            ],
        ],
    ],
    'modules' => [
        'mm' => [
            'class' => 'maissoftware\mm\Module',
            'logoPath' => '/logo/',
        ],
        'gridview'=> [
            'class' => '\kartik\grid\Module'
        ],
        'user' => [
            'class' => 'dektrium\user\Module',
            //'controllerMap' => [
                //'admin' => 'app\controllers\AdminController'
            //],
            'modelMap' => [
                'User' => 'common\models\User',
                'RegistrationForm' => 'frontend\models\RegistrationForm',
                //'SettingsForm' => 'frontend\models\SettingsForm',
            ],
            'enableAccountDelete' => true,
            'enableConfirmation' => false,
            'enableUnconfirmedLogin' => true,
            'enableFlashMessages' => false,
            'admins' => ['Juan', 'admin',]
        ],
        'rbac' => 'dektrium\rbac\RbacWebModule',
    ],
];
