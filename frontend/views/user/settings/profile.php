<?php

use yii\helpers\Html;
use yii\helpers\Url;
use dektrium\user\helpers\Timezone;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\bootstrap\Modal;
use kartik\grid\GridView;
use johnitvn\ajaxcrud\CrudAsset;

/**
 * @var yii\web\View $this
 * @var yii\widgets\ActiveForm $form
 * @var dektrium\user\models\Profile $model
 */

$this->title = Yii::t('user', 'Profile Settings');
$this->params['breadcrumbs'][] = $this->title;

CrudAsset::register($this);


?>

<?= $this->render('/_alert', ['module' => Yii::$app->getModule('user')]) ?>

<?= $this->render('_menu') ?>




<?php /*$phoneGrid = GridView::widget([
    'id'=>'crud-datatable',
    'dataProvider' => $phoneDataProvider,
    // 'filterModel' => $phoneSearchModel,
    'pjax'=>true,
    'columns' => [
            [
                'class'=>'\kartik\grid\DataColumn',
                'label' => '#',
                'attribute'=>'phone_number',
            ],
            [
                'class'=>'\kartik\grid\DataColumn',
                'attribute'=>'extension',
            ],
            [
                'class'=>'\kartik\grid\DataColumn',
                'attribute'=>'description',
            ],
            [
                'class' => 'kartik\grid\ActionColumn',
                'dropdown' => false,
                'vAlign'=>'middle',
                'urlCreator' => function($action, $model, $key, $index) {
                        return Url::to(['/phone-number/' . $action,'id'=>$key]);
                },
                'viewOptions'=>['role'=>'modal-remote','title'=>'View','data-toggle'=>'tooltip'],
                'updateOptions'=>['role'=>'modal-remote','title'=>'Update', 'data-toggle'=>'tooltip'],
                'deleteOptions'=>['role'=>'modal-remote','title'=>'Delete',
                                  'data-confirm'=>false, 'data-method'=>false,
                                  'data-request-method'=>'post',
                                  'data-toggle'=>'tooltip',
                                  'data-confirm-title'=>'Are you sure?',
                                  'data-confirm-message'=>'Are you sure want to delete this item'],
            ],
    ],
    'toolbar'=> [
        ['content'=>
            Html::a('<i class="fa fa-plus"></i> Add Phone Number', ['/phone-number/create'],
            ['role'=>'modal-remote','title'=> 'Add Phone Number','class'=>'btn btn-xs btn-primary'])
        ],
    ],
    'striped' => false,
    'condensed' => false,
    'responsive' => true,
    'panelHeadingTemplate' => '
        <div class="row">
            <div class="col-md-6">{heading}</div>
            <div class="col-md-6 text-right">{toolbar}</div>
        </div>
    ',

    'panel' => [
        'before' => false,
        'after' => false,
        'type' => 'default',
        'layout'=>"{items}",
        'heading' => '',
    ]
])*/?>




<?php /*$addressGrid = GridView::widget([
'id'=>'crud-datatable-2',
'dataProvider' => $addressDataProvider,
// 'filterModel' => $addressSearchModel,
'pjax'=>true,
'columns' => [
        [
            'class'=>'\kartik\grid\DataColumn',
            'attribute'=>'unit_number',
        ],
        [
            'class'=>'\kartik\grid\DataColumn',
            'attribute'=>'street_number',
            'label'=>'Street Number',
        ],
        [
            'class'=>'\kartik\grid\DataColumn',
            'attribute'=>'street_name',
            'label'=>'Street Name',
        ],
        [
            'class'=>'\kartik\grid\DataColumn',
            'attribute'=>'city',
        ],
        [
            'class'=>'\kartik\grid\DataColumn',
            'attribute'=>'province',
            'label'=>'Province'
        ],
        [
            'class'=>'\kartik\grid\DataColumn',
            'attribute'=>'country',
        ],
        [
            'class'=>'\kartik\grid\DataColumn',
            'attribute'=>'postal_code',
        ],
        [
            'class' => 'kartik\grid\ActionColumn',
            'dropdown' => false,
            'vAlign'=>'middle',
            'urlCreator' => function($action, $model, $key, $index) {
                    return Url::to(['/address/' . $action,'id'=>$key]);
            },
            'viewOptions'=>['role'=>'modal-remote','title'=>'View','data-toggle'=>'tooltip'],
            'updateOptions'=>['role'=>'modal-remote','title'=>'Update', 'data-toggle'=>'tooltip'],
            'deleteOptions'=>['role'=>'modal-remote','title'=>'Delete',
                              'data-confirm'=>false, 'data-method'=>false,
                              'data-request-method'=>'post',
                              'data-toggle'=>'tooltip',
                              'data-confirm-title'=>'Are you sure?',
                              'data-confirm-message'=>'Are you sure want to delete this item'],
        ],
    ],
    'toolbar'=> [
        ['content'=>
            Html::a('<i class="fa fa-plus"></i> Add Address', ['/address/create'],
            ['role'=>'modal-remote','title'=> 'Add Address','class'=>'btn btn-xs btn-primary'])
        ],
    ],
    'striped' => false,
    'condensed' => false,
    'responsive' => true,
    'panelHeadingTemplate' => '

        <div class="row">
            <div class="col-md-6">{heading}</div>
            <div class="col-md-6 text-right">{toolbar}</div>
        </div>

    ',
    'panel' => [
        'before' => false,
        'after' => false,
        'type' => 'default',
        'layout'=>"{items}",
        'heading' => '',
    ]
])*/?>





<div class="row">
    <div class="col-md-8 col-md-push-2 col-lg-6 col-lg-push-3">
        <div class="panel panel-default">
            <div class="panel-body">
                <?php $form = ActiveForm::begin([
                    'id' => 'profile-form',
                    'options' => ['class' => 'form-horizontal'],
                    'fieldConfig' => [
                        'template' => "{label}\n<div class=\"col-lg-9\">{input}</div>\n<div class=\"col-sm-offset-3 col-lg-9\">{error}\n{hint}</div>",
                        'labelOptions' => ['class' => 'col-lg-3 control-label'],
                    ],
                    'enableAjaxValidation' => true,
                    'enableClientValidation' => false,
                    'validateOnBlur' => false,
                ]); ?>

                <?= Html::tag('h2','Profile Details', ['class'=>'form-title']) ?>

                <?= $form->field($model, 'website') ?>
                <?= $form->field($model, 'timezone')->dropDownList(ArrayHelper::map(Timezone::getAll(), 'timezone', 'name')); ?>
                <?= $form->field($model, 'bio')->textarea() ?>



<!--                <?/*= Html::tag('h2', 'Phone Numbers', ['class'=>'form-title']) */?>
                <?/*= $phoneGrid */?>

                <?/*= Html::tag('h2', 'Addresses', ['class'=>'form-title']) */?>
                --><?/*= $addressGrid */?>


                <div class="row">
                    <div class="col-md-4">
                        <?= Html::submitButton(Yii::t('user', 'Save'), ['class' => 'btn btn-success btn-block']) ?>
                    </div>
                </div>


                <?php ActiveForm::end(); ?>

            </div>
        </div>
        
    </div>
</div>





<?php Modal::begin([
    "id"=>"ajaxCrudModal",
    "footer"=>"",// always need it for jquery plugin
])?>
<?php Modal::end(); ?>