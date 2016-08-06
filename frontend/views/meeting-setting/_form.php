<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\MeetingSetting */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="meeting-setting-form">

    <?php $form = ActiveForm::begin(); ?>
<div class="vertical-pad" id="preferences">
    <?= $form->field($model, 'participant_add_place')->checkbox(['uncheck' =>  $model::SETTING_NO, 'checked' => $model::SETTING_YES]); ?>
    <?= $form->field($model, 'participant_add_date_time')->checkbox(['uncheck' =>  $model::SETTING_NO, 'checked' => $model::SETTING_YES]); ?>
    <?= $form->field($model, 'participant_choose_place')->checkbox(['uncheck' =>  $model::SETTING_NO, 'checked' => $model::SETTING_YES]); ?>
    <?= $form->field($model, 'participant_choose_date_time')->checkbox(['uncheck' =>  $model::SETTING_NO, 'checked' => $model::SETTING_YES]); ?>
    <?= $form->field($model, 'participant_finalize')->checkbox(['uncheck' =>  $model::SETTING_NO, 'checked' => $model::SETTING_YES]); ?>
</div>
    <div class="form-group">
        <?= Html::submitButton(Yii::t('frontend', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('frontend','Cancel'), Url::to(['/meeting/index']), ['class' => 'btn btn-danger']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
