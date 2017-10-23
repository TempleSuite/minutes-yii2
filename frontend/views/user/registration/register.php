<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\SignupForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;

$this->title = 'Register';
// $this->params['breadcrumbs'][] = $this->title;
//$companies = Company::find()->indexBy('id')->all();
?>


<div class="v-align-wrap h100">
    <div class="v-align-box h100">
        <div class="row">
            <div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3">

                <div class="panel panel-default">
                    <div class="panel-heading">
                        <?= Html::encode($this->title) ?>
                    </div>
                    <div class="panel-body">
                        <p>Please fill out the following fields to register:</p>
                        <hr>
                        <?php $form = ActiveForm::begin(['id' => 'registration-form']); ?>

                        <?= $form->field($model, 'status')->hiddenInput(['value'=>10])->label(false) ?>
                        <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>
                        <?= $form->field($model, 'first_name')->textInput() ?>
                        <?= $form->field($model, 'last_name')->textInput() ?>
                        <?= $form->field($model, 'email') ?>
                        <?php //$form->field($model, 'company_id')->dropDownList(ArrayHelper::map($companies, 'id', 'name'))->label('Company') ?>
                        <?= $form->field($model, 'password')->passwordInput() ?>
                        <?= $form->field($model, 'repeatPassword')->passwordInput() ?>

                        <div class="form-group">
                            <?= Html::submitButton('Register', ['class' => 'btn btn-block btn-lg btn-primary', 'name' => 'signup-button']) ?>
                        </div>

                        <?php ActiveForm::end(); ?>

                        <p class="text-center">
                            <?= Html::a(Yii::t('user', 'Already registered? Sign in!'), ['/user/security/login']) ?>
                        </p>


                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
