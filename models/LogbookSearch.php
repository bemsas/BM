<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Logbook;
use yii\data\Sort;

/**
 * LogbookSearch represents the model behind the search form of `app\models\Logbook`.
 */
class LogbookSearch extends Logbook
{
    public $company_id;
    public $cellIds;
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'user_id', 'contact_id', 'company_id', 'cell_id'], 'integer'],
            [['date_in', 'content', 'cellIds'], 'safe'],
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
        $query = Logbook::find();
        
        $sort = new Sort();
        $sort->defaultOrder = ['date_in' => SORT_DESC, 'id' => SORT_DESC];

        // add conditions that should always apply here

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
        
        if($this->company_id) {
            $query->joinWith('user u');
            $query->andWhere(['u.company_id' => $this->company_id]);
        }
        if($this->cellIds) {
            $query->andWhere(['cell_id' => $this->cellIds]);
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'user_id' => $this->user_id,
            'contact_id' => $this->contact_id,
            'cell_id' => $this->cell_id,
            'date_in' => $this->date_in,
        ]);

        $query->andFilterWhere(['ilike', 'content', $this->content]);

        return $dataProvider;
    }
}
