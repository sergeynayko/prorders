<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;
use yii\widgets\Pjax;
use app\models\employees\SearchEmployeesModel;
use app\models\operations\SearchOperationsModel;

/* @var $this yii\web\View */
/* @var $model app\models\departaments\Departaments */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Подразделения', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="departaments-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Изменить', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
        ],
    ]) ?>
	
	<div>

  
	<ul class="nav nav-tabs" role="tablist">
		<li role="presentation" class="active"><a href="#employees" aria-controls="employees" role="tab" data-toggle="tab">Сотрудники</a></li>
		<li role="operations"><a href="#operations" aria-controls="operations" role="tab" data-toggle="tab">Операции</a></li>
    </ul>

  <!-- Tab panes -->
	<div class="tab-content">
		<div role="tabpanel" class="tab-pane active" id="employees">
	<p>
        <?= "<form action='/employees/create' method='post'>
		<input type='hidden' name='departamentId' value=$model->id />
		<input type='hidden' name='_csrf' value=" . Yii::$app->request->getCsrfToken() . " />
		<input type='submit' value='Добавить сотрудника' class='btn btn-success' />
		</form>"
		?>
    </p>	
			
	<?php
	
		$emplSearchModel = new SearchEmployeesModel();
		$emplSearchModel->departamentId = $model->id;
		$emplDataProvider = $emplSearchModel->search([]);
		Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $emplDataProvider,
        'filterModel' => $emplSearchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            
            'name',
            
            ['class' => 'yii\grid\ActionColumn'],
        ],
		]); ?>
		
		
		<?php Pjax::end(); ?>
		</div>
		<div role="tabpanel" class="tab-pane" id="operations">
		<?php 
		$operSearchModel = new SearchOperationsModel();
		$operSearchModel->departamentId = $model->id;
		$operDataProvider = $operSearchModel->search([]);
		Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $operDataProvider,
        'filterModel' => $operSearchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            
            'name',
            
            ['class' => 'yii\grid\ActionColumn'],
        ],
		]); ?>
		<?php Pjax::end();?>
		</div>
	</div>
	</div>
</div>
