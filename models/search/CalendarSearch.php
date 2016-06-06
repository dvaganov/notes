<?php

namespace app\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Calendar;

/**
 * CalendarSearch represents the model behind the search form about `app\models\Calendar`.
 */
class CalendarSearch extends Calendar
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'creatorID'], 'integer'],
            [['text', 'dateEvent'], 'safe'],
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
        $query = Calendar::find();

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
            'creatorID' => $this->creatorID,
            'dateEvent' => $this->dateEvent,
        ]);

        $query->andFilterWhere(['like', 'text', $this->text]);

        return $dataProvider;
    }

    /**
     * Creates data provider instance with own events
     * @param int $ownerID
     * @return ActiveDataProvider
     */
    public function byOwner($ownerID)
    {
        $query = Calendar::find()->whereOwner($ownerID);
        return new ActiveDataProvider(['query' => $query]);
    }

    /**
     * Creates data provider instance with shared events
     * @param \app\models\Access $accesses
     * @return ActiveDataProvider
     */
    public function searchShared($accesses)
    {
        $query = Calendar::find();

        foreach($accesses as $access) {
            $query->withUserAndDate($access->ownerID, $access->date);
        }

        if (is_null($query->sql)) {
            $query->where('0 = 1');
        }

        return new ActiveDataProvider(['query' => $query]);
    }
}
