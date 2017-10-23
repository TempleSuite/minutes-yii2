<?php

/*
 * This file is part of the Dektrium project.
 *
 * (c) Dektrium project <http://github.com/dektrium>
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

use yii\helpers\Html;
use yii\widgets\Menu;
// use kartik\nav\NavX;

/**
 * @var dektrium\user\models\User $user
 */

$user = Yii::$app->user->identity;
$networksVisible = count(Yii::$app->authClientCollection->clients) > 0;
?>

<!-- Profile: <?= $user->username ?> -->

<div class="page-header section-header">
    <div class="row">
        <div class="col-md-8 col-md-push-2 col-lg-6 col-lg-push-3">
            <?= Menu::widget([
                'options' => [
                    'class' => 'nav nav-pills pull-right',
                ],
                'items' => [
                    ['label' => Yii::t('user', 'Profile'), 'url' => ['/user/settings/profile']],
                    ['label' => Yii::t('user', 'Account'), 'url' => ['/user/settings/account']],
                    [
                        'label' => Yii::t('user', 'Networks'),
                        'url' => ['/user/settings/networks'],
                        'visible' => $networksVisible
                    ],
                ],
            ]) ?>
            <h3 class="panel-title"><i class="fa fa-user-circle"></i> <?= $this->title; ?></h3>
        </div>
    </div>
</div>



