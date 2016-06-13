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
            <?= Html::a(Yii::t('app', 'Share the day'), ['/access/create'], ['class' => 'btn btn-primary']) ?>
        </p>

        <?= $this->render('_listViewWidget', [
            'dataProvider' => $dataProviderMy
        ]) ?>

    </div>

    <div>
        <h1><?= Html::encode($this->title) ?>: shared events</h1>

        <?= $this->render('_listViewWidget', [
            'dataProvider' => $dataProviderShared
        ]) ?>

    </div>
</div>
