<?php

namespace app\models\employees;

use Yii;
use app\models\departaments\Departaments;

/**
 * This is the model class for table "employees".
 *
 * @property integer $id
 * @property string $name
 * @property integer $departamentId
 *
 * @property Departaments $departament
 */
class Employees extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'employees';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'departamentId'], 'required'],
            [['departamentId'], 'integer'],
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
            'name' => 'Ф.И.О.',
            'departamentId' => 'Подразделение',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDepartament()
    {
        return $this->hasOne(Departaments::className(), ['id' => 'departamentId']);
    }
}
