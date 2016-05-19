<?php

namespace app\models\operations;

use Yii;
use app\models\departaments\Departaments;

/**
 * This is the model class for table "operations".
 *
 * @property integer $id
 * @property string $name
 * @property integer $departamentId
 * @property integer $defaultOp
 *
 * @property Departaments $departament
 * @property Orderdetails[] $orderdetails
 * @property Specifications[] $specifications
 */
class Operations extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'operations';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'departamentId'], 'required'],
            [['departamentId', 'defaultOp'], 'integer'],
            [['name'], 'string', 'max' => 255],
            [['departamentId'], 'exist', 'skipOnError' => true, 'targetClass' => Departaments::className(), 'targetAttribute' => ['departamentId' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Наименование',
            'departamentId' => 'Подразделение',
            'defaultOp' => 'По умолчанию',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDepartament()
    {
        return $this->hasOne(Departaments::className(), ['id' => 'departamentId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrderdetails()
    {
        return $this->hasMany(Orderdetails::className(), ['operationId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSpecifications()
    {
        return $this->hasMany(Specifications::className(), ['operationId' => 'id']);
    }
}
