<?php

use yii\helpers\Html;
use yii\widgets\ListView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\CalendarSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Calendars');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="calendar-index">
    <div>
        <h1><?= Html::encode($this->title) ?>: my events</h1>

        <p>
            <?= Html::a(Yii::t('app', 'Add event'), ['create'], ['class' => 'btn btn-success']) ?>
        </p>
        <?= ListView::widget([
            'dataProvider' => $dataProviderMy,
            'itemOptions' => ['class' => 'item'],
            'itemView' => function ($model, $key, $index, $widget) {
                return Html::a(Html::encode($model->id), ['view', 'id' => $model->id]);
            },
        ]) ?>
    </div>
    <div>
        <h1><?= Html::encode($this->title) ?>: shared events</h1>

        <p>
            <?= Html::a(Yii::t('app', 'Add event'), ['create'], ['class' => 'btn btn-success']) ?>
        </p>
        <?= ListView::widget([
            'dataProvider' => $dataProviderShared,
            'itemOptions' => ['class' => 'item'],
            'itemView' => function ($model, $key, $index, $widget) {
                return Html::a(Html::encode($model->id), ['view', 'id' => $model->id]);
            },
        ]) ?>
    </div>
</div>
