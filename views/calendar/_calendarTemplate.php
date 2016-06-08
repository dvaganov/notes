<?php
/***
 * @var $model app\models\Calendar
 */
?>
<div style='padding: 40px; margin: 10px; display: inline-block; background: #f5f5f5; cursor: pointer;'
      onclick='location.assign("/calendar/<?= $model->id ?>")'>
    <?= $model->dateEvent ?> (<?= $model->creator->username ?>)
</div>
