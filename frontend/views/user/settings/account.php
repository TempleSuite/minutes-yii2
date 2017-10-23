<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\bootstrap\Modal;
use kartik\grid\GridView;
use app\models\Email;
use app\models\EmailSearch;
use johnitvn\ajaxcrud\CrudAsset;
use common\models\User;

/* @var $this yii\web\View */
/* @var $model common\models\user */
/* @var $form ActiveForm */

$this->title = 'Account Settings';
$this->params['breadcrumbs'][] = $this->title;

CrudAsset::register($this);


$user = User::find()->where(['id' => Yii::$app->user->identity->id])->one();
/*if (isset($user->email) && !empty($user->email)) {
    $email = new Email();
    $email->user_id = $user->id;
    $email->email = $user->email;
    $email->is_primary = 1;
    $email->save();
    $emailDataProvider->query->where(['user_id' => Yii::$app->user->identity->id]);
}*/

?>

<?php /*$emailGrid = GridView::widget([
        'id'=>'crud-datatable',
        'dataProvider' => $emailDataProvider,
        // 'filterModel' => $emailSearchModel,
        'pjax'=>true,
        'columns' => [
            [
                'class'=>'\kartik\grid\DataColumn',
                'attribute'=>'email',
            ],
            [
                'class'=>'yii\grid\RadioButtonColumn',
                'header' => 'Primary',
                'options'=> [
                    'vAlign' => 'middle',
                ],
                'radioOptions' => function($model) {
                    return [
                        'value' => $model['is_primary'],
                        'checked' => $model['is_primary'] == 1,
                    ];
                },
            ],
            [
                'class' => 'kartik\grid\ActionColumn',
                'dropdown' => false,
                'vAlign'=>'middle',
                'urlCreator' => function($action, $model, $key, $index) {
                        return Url::to(['/email/' . $action,'id'=>$key]);
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
                Html::a('<i class="fa fa-plus"></i> Add Email Address', ['/email/create'],
                ['role'=>'modal-remote','title'=> 'Add Email Address','class'=>'btn btn-xs btn-primary'])
            ],
        ],
        'striped' => false,
        'condensed' => false,
        'showPageSummary' => false,
        'responsive' => true,
        'panelHeadingTemplate' => '
            <div class="row">
                <div class="col-md-6">
                    {heading}
                </div>
                <div class="col-md-6 text-right">
                    {toolbar}
                </div>
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


<?= $this->render('_menu') ?>

<div class="row">
    <div class="col-md-8 col-md-push-2 col-lg-6 col-lg-push-3 form">
        <div class="panel panel-default">
            <div class="panel-body">


                <?php $form = ActiveForm::begin([
                    'id' => 'dynamic-form',
                    'options' => ['class' => 'form-horizontal'],
                    'fieldConfig' => [
                        'template' => "{label}\n<div class=\"col-lg-9\">{input}</div>\n<div class=\"col-sm-offset-3 col-lg-9\">{error}\n{hint}</div>",
                        'labelOptions' => ['class' => 'col-lg-3 control-label'],
                    ],
                    'enableAjaxValidation' => true,
                    'enableClientValidation' => false,
                    'validateOnBlur' => false,
                ]); ?>

                
                    <?= Html::tag('h2','Name', ['class'=>'form-title']) ?>
                    <?= $form->field($model, 'username') ?>
                    <?php //$form->field($model, 'first_name') ?>
                    <?php //$form->field($model, 'last_name') ?>

                    <?= Html::tag('h2','Password', ['class'=>'form-title']) ?>
                    <?= $form->field($model, 'new_password')->passwordInput() ?>
                    <?= $form->field($model, 'current_password')->passwordInput() ?>

                    <?= Html::tag('h2','Email Address', ['class'=>'form-title']) ?>
                    <?= $form->field($model, 'email')->label('Current Email') ?>

                    <div class="row">
                        <div class="col-md-3 col-md-push-9">
                            <?= Html::submitButton(Yii::t('user', 'Save'), ['class' => 'btn btn-success btn-block']) ?>
                        </div>
                    </div>

            <?php ActiveForm::end(); ?>
                <br><br><br>


                <?php if ($model->module->enableAccountDelete): ?>
                    <div class="panel panel-danger">
                        <div class="panel-heading">
                            <h3 class="panel-title"><?= Yii::t('user', 'Delete account') ?></h3>
                        </div>
                        <div class="panel-body">
                            <p>
                                <?= Yii::t('user', 'Once you delete your account, there is no going back') ?>.
                                <?= Yii::t('user', 'It will be deleted forever') ?>.
                                .
                            </p>
                            <?= Html::a(Yii::t('user', 'Delete account'), ['delete'], [
                                'class' => 'btn btn-danger',
                                'data-method' => 'post',
                                'data-confirm' => Yii::t('user', 'Are you sure? There is no going back'),
                            ]) ?>
                        </div>
                    </div>
                <?php endif ?>



            </div>
        </div>
    </div>
</div>






<?php Modal::begin([
    "id"=>"ajaxCrudModal",
    "footer"=>"",// always need it for jquery plugin
])?>
<?php Modal::end(); ?>


<?php $script = <<< JS

$(document).on('click', "[name='radioButtonSelection']", function() {
    $.ajax({
        url: "/email/select-primary",
        type: "POST",
        data: {id: $(this).closest("tr").attr("data-key")},
        error: function() {
            console.log("AJAX error");
        },
        success: function(data) {
            console.log("Saved");
            $.pjax.reload({container: '#crud-datatable-pjax'});
        }
    })
})

JS;
$this->registerJs($script, yii\web\View::POS_READY);
