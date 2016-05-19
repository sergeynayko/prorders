<?php

namespace app\models\departaments;
use yii\helpers\ArrayHelper;
use Yii;

/**
 * This is the model class for table "departaments".
 *
 * @property integer $id
 * @property string $name
 *
 * @property Employees[] $employees
 */
class Departaments extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'departaments';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'max' => 255],
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
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEmployees()
    {
        return $this->hasMany(Employees::className(), ['departamentId' => 'id']);
    }
	
	public static function getDepartamentList()
	{
		$departaments = Departaments::find()->all();
 
		return ArrayHelper::map($departaments, 'id', 'name');
	}	
}
