<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\operations\Operations;
use app\models\products\Products;
use yii\jui\DatePicker;
/* @var $this yii\web\View */
/* @var $model app\models\specifications\Specifications */
/* @var $form yii\widgets\ActiveForm */

$operations = Operations::getOperationList();
$paramsOp = ['prompt' => 'Выберите операцию'];
$products = Products::getProductList();
$paramsProd = ['prompt' => 'Выберите продукцию'];
if (!$model->date) $model->date = date('Y-m-d');
?>

<div class="specifications-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'date')->widget(DatePicker::className(), 
		[
			'options' => ['class' => 'form-control', ],
			'clientOptions' => ['defaultDate' => date('Y-m-d')],
			'dateFormat' => 'yyyy-MM-dd',
			'language'=>'ru',
		]) ?>

    <?= $form->field($model, 'operationId')->dropDownList($operations, $paramsOp) ?>

    <?= $form->field($model, 'productId')->dropDownList($products, $paramsProd) ?>

    <?= $form->field($model, 'rate')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'sequence')->textInput() ?>

    <?= $form->field($model, 'duration')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Добавить' : 'Изменить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
