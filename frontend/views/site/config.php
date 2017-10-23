<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\Pjax;
use yii\widgets\ActiveForm;
use dosamigos\fileupload\FileUpload;

/* @var $this yii\web\View */
/* @var $model maissoftware\mm\models\MeetingSystemConfiguration */
/* @var $form ActiveForm */
?>
<div class="site-config">

	<div class="page-header section-header">
		<h3 class="title"><i class="fa fa-cog"></i> System Config</h3>
	</div>

	<div class="panel-body">

		<div class="row">
			<div class="col-md-8">

				<label>Logo</label>

				<?php Pjax::begin(['id' => 'logo-pjax']) ?>
					<?php if (!empty($company->logo)): ?><img src="/logo/<?= $company->logo ?>" alt="Company Logo" class="company-logo"><?php endif ?>
				<?php Pjax::end() ?>

				<?= FileUpload::widget([
                    'model' => $company,
                    'attribute' => 'logo',
                    'url' => ['upload-logo'],
                    'clientEvents' => [
                        'fileuploaddone' => 'function(e, data) {
                        		growl("Uploaded", "Logo uploaded successfully");
                                $.pjax.reload({container: "#logo-pjax", timeout: 5000});
                            }',
                        'fileuploadfail' => 'function(e, data) {
                        		growl("Error", "File upload failed", "TYPE_DANGER");
                                $.pjax.reload({container: "#logo-pjax", timeout: 5000});
                            }',
                        ]
                ]); ?>

            </div>
		</div>

        <div class="row">
			<div class="col-md-8">

			    <?php $form = ActiveForm::begin(); ?>
					<?= $form->field($company, 'name')->label('Company Name') ?>

					<div class="form-group">
			    		<?= Html::submitButton('Save', ['class' => 'btn btn-default']) ?>
			    	</div>
			    <?php ActiveForm::end(); ?>

		    </div>
		</div>
			

	</div><!-- panel-body -->

</div><!-- site-config -->