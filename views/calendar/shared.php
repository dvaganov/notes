<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\CalendarSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Calendars');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="calendar-index">
    <h1><?= Html::encode($this->title) ?>: shared events</h1>

    <?= $this->render('_listViewWidget', [
        'dataProvider' => $dataProvider
    ]) ?>
</div>
