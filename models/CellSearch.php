<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Cell;
use yii\data\Sort;

/**
 * CellSearch represents the model behind the search form of `app\models\Cell`.
 */
class CellSearch extends Cell
{
    public $mapId;
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'answer1_id', 'answer2_id', 'mapId'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
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
        $query = Cell::find();

        // add conditions that should always apply here
        
        $sort = new Sort();
        $sort->defaultOrder = ['id' => SORT_ASC];

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => $sort
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
            'answer1_id' => $this->answer1_id,
            'answer2_id' => $this->answer2_id,
        ]);
        
        if($this->mapId) {
            $query->joinWith(['answer1 a1']);
            $query->andWhere(['a1.map_id' => $this->mapId]);
        }

        return $dataProvider;
    }
}
