<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\operations\Operations */

$this->title = 'Добавление операции';
$this->params['breadcrumbs'][] = ['label' => 'Операции', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="operations-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
