<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\departaments\Departaments;
/* @var $this yii\web\View */
/* @var $model app\models\operations\Operations */
/* @var $form yii\widgets\ActiveForm */

$items = Departaments::getDepartamentList();
$params = ['prompt' => 'Выберите подразделение'];
?>

<div class="operations-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'departamentId')->dropDownList($items, $params) ?>

    <?= $form->field($model, 'defaultOp')->checkbox() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Добавить' : 'Изменить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
