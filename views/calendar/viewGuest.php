<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Calendar */

$this->title = substr($model->text, 0, 10) . '...';
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Calendars'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="calendar-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'text:ntext',
            'creatorID',
            'dateEvent',
        ],
    ]) ?>

</div>
