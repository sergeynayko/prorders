<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\specifications\Specifications */

$this->title = 'Добавление спецификации';
$this->params['breadcrumbs'][] = ['label' => 'Спецификации', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="specifications-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
