<?php

namespace app\models\specifications;

use Yii;
use app\models\operations\Operations;
use app\models\products\Products;

/**
 * This is the model class for table "specifications".
 *
 * @property integer $id
 * @property string $date
 * @property integer $operationId
 * @property integer $productId
 * @property string $rate
 * @property integer $sequence
 * @property integer $duration
 *
 * @property Operations $operation
 * @property Products $product
 */
class Specifications extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'specifications';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['date', 'operationId', 'productId', 'rate', 'sequence', 'duration'], 'required'],
            [['date'], 'safe'],
            [['operationId', 'productId', 'sequence', 'duration'], 'integer'],
            [['rate'], 'number'],
            [['operationId'], 'exist', 'skipOnError' => true, 'targetClass' => Operations::className(), 'targetAttribute' => ['operationId' => 'id']],
            [['productId'], 'exist', 'skipOnError' => true, 'targetClass' => Products::className(), 'targetAttribute' => ['productId' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'date' => 'Дата',
            'operationId' => 'Операция',
            'productId' => 'Продукция',
            'rate' => 'Расценка',
            'sequence' => 'Порядок',
            'duration' => 'Длительность',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOperation()
    {
        return $this->hasOne(Operations::className(), ['id' => 'operationId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProduct()
    {
        return $this->hasOne(Products::className(), ['id' => 'productId']);
    }
}
