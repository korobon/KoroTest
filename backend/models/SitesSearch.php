<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Sites;

/**
 * SitesSearch represents the model behind the search form about `app\models\Sites`.
 */
class SitesSearch extends Sites
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'image_category_id'], 'integer'],
            [['field', 'description', 'observation', 'created', 'modified'], 'safe'],
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
        $query = Sites::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'image_category_id' => $this->image_category_id,
            'created' => $this->created,
            'modified' => $this->modified,
        ]);

        $query->andFilterWhere(['like', 'field', $this->field])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'observation', $this->observation]);

        return $dataProvider;
    }
}
