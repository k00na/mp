<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\MeetingReminder */

$this->title = Yii::t('frontend', 'Update {modelClass}: ', [
    'modelClass' => 'Meeting Reminder',
]) . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('frontend', 'Meeting Reminders'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('frontend', 'Update');
?>
<div class="meeting-reminder-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
