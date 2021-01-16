<?php

namespace yagiztr\movie\models;

use yagiztr\movie\models\Genre;

use Yii;

/**
 * This is the model class for table "movie".
 *
 * @property int $id
 * @property string $title
 * @property int $release_year
 * @property string|null $summary
 * @property string|null $poster_url
 *
 * @property MovieGenre[] $movieGenres
 */
class Movie extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'movie';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'release_year'], 'required'],
            [['release_year'], 'integer'],
            [['summary'], 'string'],
            [['title'], 'string', 'max' => 255],
            [['poster_url'], 'string', 'max' => 700],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'release_year' => 'Release Year',
            'summary' => 'Summary',
            'poster_url' => 'Poster Url',
            "genre" => "Genre"
        ];
    }

    /**
     * Gets query for [[MovieGenres]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMovieGenres()
    {
        $get_genre_id = function ($el) {
            return $el->genre_id;
        };
        $genre_ids = array_map($get_genre_id, $this->hasMany(MovieGenre::className(), ['movie_id' => 'id'])->all());
        if(sizeof($genre_ids)>0){
            $get_genre_name = function ($el) {
                return $el->name;
            };
            $query = Genre::find();
            foreach ($genre_ids as $id) {
                $query->orWhere("id=$id");
            }
            return implode(", ", array_map($get_genre_name, $query->all()));
        }
        else{
            return "No Genre";
        }
        
    }
}
