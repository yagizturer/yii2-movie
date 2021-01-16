<?php

namespace yagiztr\movie\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use yagiztr\movie\models\Movie;

/**
 * MovieSearch represents the model behind the search form of `frontend\modules\movie\models\Movie`.
 */
class MovieSearch extends Movie
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'release_year'], 'integer'],
            [['title',  'poster_url'], 'safe'],
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
    public function search($params, $genre = 0)
    {
        $query = Movie::find();

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
        $query->innerJoin("movie_genre");
        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'release_year' => $this->release_year,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'summary', $this->summary])
            ->andFilterWhere(['like', 'poster_url', $this->poster_url]);

        if ($genre != 0) {
            $query->andWhere("movie.id IN (SELECT movie_id FROM movie_genre WHERE genre_id=$genre)");
        }
        return $dataProvider;
    }
}
