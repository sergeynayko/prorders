<?php

namespace app\models\specifications;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\specifications\Specifications;

/**
 * SearchSpecificationsModel represents the model behind the search form about `app\models\specifications\Specifications`.
 */
class SearchSpecificationsModel extends Specifications
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'operationId', 'productId', 'sequence', 'duration'], 'integer'],
            [['date'], 'safe'],
            [['rate'], 'number'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Specifications::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'date' => $this->date,
            'operationId' => $this->operationId,
            'productId' => $this->productId,
            
        ]);

        return $dataProvider;
    }
}
