<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;
use yii\widgets\Pjax;
use app\models\employees\SearchEmployeesModel;

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
		<?php Pjax::end();
	
	?>

</div>
