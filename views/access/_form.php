<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\web\JsExpression;

/* @var $this yii\web\View */
/* @var $model app\models\Access */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="access-form">

    <?php $form = ActiveForm::begin(); ?>

    <label for="autocomplete_guest_id">Choose user</label>
    <?= \yii\jui\AutoComplete::widget([
        'id' => 'autocomplete_guest_id',
        'clientOptions' => [
            'name' => 'guestID',
            'source' => $autocompleteUsers,
            'select' => new JsExpression("function(event, ui) {
                $('#access-guestid').val(ui.item.id);
            }")
        ]
    ]);
    ?>

    <?= Html::activeHiddenInput($model, 'guestID')?>

    <?= $form->field($model, 'date')->widget(\yii\jui\DatePicker::classname(), [
    //'language' => 'ru',
      'dateFormat' => 'yyyy-MM-dd',
    ]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
