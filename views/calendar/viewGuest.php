<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Calendar */

$this->title = $model->dateEvent;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Calendars'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="calendar-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            [
                'attribute' => 'creatorName',
                'format' => 'raw',
                'value' => Html::a(
                    $model->creator->username,
                    ['/calendar/shared']
                )
            ],
            'dateEvent',
            'text:ntext',
        ],
    ]) ?>

</div>
