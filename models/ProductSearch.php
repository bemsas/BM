<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Product;

/**
 * ProductSearch represents the model behind the search form of `app\models\Product`.
 */
class ProductSearch extends Product
{
    public $companyId;
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'map_id', 'companyId'], 'integer'],
            [['name', 'description', 'introduction', 'resources'], 'safe'],
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
        $query = Product::find();

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

        if($this->companyId) {
            $query->joinWith('companyProducts cp', false);
            $query->andWhere(['cp.company_id' => $this->companyId]);
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'map_id' => $this->map_id,
        ]);

        $query->andFilterWhere(['ilike', 'name', $this->name])
            ->andFilterWhere(['ilike', 'description', $this->description])
            ->andFilterWhere(['ilike', 'resources', $this->resources])
            ->andFilterWhere(['ilike', 'introduction', $this->introduction]);

        return $dataProvider;
    }
}
