<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Shift;
use yii\data\Sort;

/**
 * ShiftSearch represents the model behind the search form of `app\models\Shift`.
 */
class ShiftSearch extends Shift
{
    public $mapId;
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'cell_start_id', 'cell_end_id'], 'integer'],
            [['question1_content', 'question2_content'], 'safe'],
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
        $query = Shift::find();

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
        if($this->mapId) {
            $query->joinWith(['cellEnd.answer1 a1']);
            $query->andWhere(['a1.map_id' => $this->mapId]);
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'cell_start_id' => $this->cell_start_id,
            'cell_end_id' => $this->cell_end_id,
        ]);

        $query->andFilterWhere(['ilike', 'question1_content', $this->question1_content])
            ->andFilterWhere(['ilike', 'question2_content', $this->question2_content]);

        return $dataProvider;
    }
}
