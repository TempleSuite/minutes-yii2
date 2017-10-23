<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;
use maissoftware\mm\MeetingMinutesAsset;
use frontend\models\Company;

AppAsset::register($this);
MeetingMinutesAsset::register($this);

$username = (Yii::$app->user->isGuest) ? "" : Yii::$app->user->identity->username;

$controllerId = Yii::$app->controller->id;
$moduleId = Yii::$app->controller->module->id;


$username = (!empty(Yii::$app->user->identity->username)) ? Yii::$app->user->identity->username : 'Login';

$company = Company::find()->where(['id' => '1']) ->one();

if(!isset($company))
    $title = 'MM';
else
    $title = $company->name;

?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>

<body class="<?php

    if(Yii::$app->user->isGuest) echo 'invert ';
    if($moduleId == 'mm' && $controllerId == 'meeting') echo 'meeting-minutes ';

?>">
<?php $this->beginBody() ?>

<div class="wrapper">
    <header class="header">
        <?php
        /*    $menuItems = [
                ['label' => 'Home', 'url' => ['/site/index']],
                ['label' => 'About', 'url' => ['/site/about']],
                ['label' => 'Contact', 'url' => ['/site/contact']],
            ];*/
        if (Yii::$app->user->isGuest) {
            $menuItems[] = ['label' => 'Signup', 'url' => ['/user/register']];
            $menuItems[] = ['label' => 'Login', 'url' => ['/user/login']];
        } else {
            $menuItems[] = ['label' => '<i class="fa fa-home"></i> Home', 'url' => ['/mm/meeting-group']];

            $menuItems[] = [
                'label' => '<i class="fa fa-cog" aria-hidden="true"></i> Settings <i class="fa fa-angle-down"></i>',
                'items' => [
                    [
                        'label' => '<i class="fa fa-fw fa-wrench"></i> System Config',
                        'url' => ['/site/config']
                    ],
                    [
                        'label' => '<i class="fa fa-fw fa-wrench"></i> Users',
                        'url' => ['/user/admin/index']
                    ]
                ],
                'visible' => Yii::$app->user->can('admin')
            ];

            $menuItems[] =
                [
                    'label' => '<i class="fa fa-user-circle" aria-hidden="true"></i> Account <i class="fa fa-angle-down"></i>',
                    'items' => [
                        [
                            'label' => '<i class="fa fa-fw fa-user"></i> Profile',
                            'url' => ['/user/settings/profile'],
                        ],
                        [
                            'label' => '<i class="fa fa-fw fa-lock"></i> Account Details',
                            'url' => ['/user/settings/account'],
                        ],
                        /*                    [
                                                'label' => '<i class="fa fa-fw fa-dashboard"></i> Dashboard',
                                                'url' => ['/user/user-dashboard']
                                            ]*/
                        '<li class="divider"></li>',
                        '<li>' . Html::a('<i class="fa fa-fw fa-sign-out"></i> Logout (' . $username . ')',
                            ['/site/logout'], ['data' => ['method' => 'post']]) . '</li>',
                    ],
                    'visible' => !Yii::$app->user->isGuest
                ];

            /*        $menuItems[] = '<li>'
                        . Html::beginForm(['/site/logout'], 'post')
                        . Html::submitButton(
                            'Logout (' . Yii::$app->user->identity->username . ')',
                            ['class' => 'btn btn-link logout']
                        )
                        . Html::endForm()
                        . '</li>';*/
        }

        NavBar::begin([
            'brandLabel' => $title,
            'brandUrl' => Yii::$app->homeUrl,
            'options' => [
                'class' => ' nm navbar-app',
            ],
            'innerContainerOptions' => ['class' => '']
        ]);

        echo Nav::widget([
            'options' => ['class' => 'navbar-nav navbar-right'],
            'encodeLabels' => false,
            'activateItems' => true,
            'activateParents' => true,
            'items' => $menuItems,
        ]);
        NavBar::end();
        ?>
    </header>

    <?php Breadcrumbs::widget([
        'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [], ]) ?>

    <div id="main">
        <div class="container-fluid">
            <?= Alert::widget(); ?>
            <?= $content; ?>
        </div>
    </div>
</div>

<div id="growl"></div>

<div id="overlay">
    <div class="text"><i class="fa fa-arrow-down bounce"></i></div>
</div>

<!--<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; My Company <?/*= date('Y') */?></p>

        <p class="pull-right"><?/*= 'Created By: Mais Software' */?></p>
    </div>
</footer>
-->
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
