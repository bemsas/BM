<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Answer;
use yii\data\Sort;

/**
 * AnswerSearch represents the model behind the search form of `app\models\Answer`.
 */
class AnswerSearch extends Answer
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'map_id', 'question'], 'integer'],
            [['content'], 'safe'],
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
        $query = Answer::find();

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
            'map_id' => $this->map_id,
            'question' => $this->question,
        ]);

        $query->andFilterWhere(['ilike', 'content', $this->content]);

        return $dataProvider;
    }
}
