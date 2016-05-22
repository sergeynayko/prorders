<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use app\models\operations\Operations;
use app\models\products\Products;
/* @var $this yii\web\View */
/* @var $searchModel app\models\specifications\SearchSpecificationsModel */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Спецификации';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="specifications-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Добавить спецификацию', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'date',
            [
				'attribute' => 'operationId',
				'label' => 'Операция',
				'content' => function($data){return $data->operation->name;},
				'filter' => Operations::getOperationList(),
			],
            [
				'attribute' => 'productId',
				'label' => 'Продукция',
				'content' => function($data){return $data->product->name;},
				'filter' => Products::getProductList(),
			],
            'rate',
            'sequence',
            'duration',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
