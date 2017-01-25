<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Folders;

/**
 * FoldersSearch represents the model behind the search form about `app\models\Folders`.
 */
class FoldersSearch extends Folders
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idFolder', 'cant_files'], 'integer'],
            [['nameFolder', 'ruta', 'id_files'], 'safe'],
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
        $query = Folders::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->joinWith('idFiles');

        $query->andFilterWhere([
            'idFolder' => $this->idFolder,
            'cant_files' => $this->cant_files,
        ]);

        $query->andFilterWhere(['like', 'nameFolder', $this->nameFolder])
            ->andFilterWhere(['like', 'ruta', $this->ruta])
            ->andFilterWhere(['like', 'files.name', $this->id_files]);

        return $dataProvider;
    }
}
