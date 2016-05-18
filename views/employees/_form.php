<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use app\models\departaments\Departaments;
/* @var $this yii\web\View */
/* @var $model app\models\employees\Employees */
/* @var $form yii\widgets\ActiveForm */

$departaments = Departaments::find()->all();
$items = ArrayHelper::map($departaments,'id','name');
$params = ['prompt' => 'Выберите подразделение'];
?>

<div class="employees-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'departamentId')->dropDownList($items, $params) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Добавить' : 'Изменить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
