<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use app\models\departaments\Departaments;
/* @var $this yii\web\View */
/* @var $searchModel app\models\operations\SearchOperationsModel */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Операции';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="operations-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Добавить операцию', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            
            'name',
            [
				'attribute' => 'departamentId',
				'label' => 'Подразделение',
				'content' => function($data){return $data->departament->name;},
				'filter' => Departaments::getDepartamentList(),
			],
			[
				'attribute' => 'defaultOp',
				'format' => 'raw',
				'content' => function($data){
					return $data->defaultOp == 1 ? "<span class='glyphicon glyphicon-ok'></span>" : "";
				},
			],	

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
