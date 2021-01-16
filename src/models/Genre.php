<?php

namespace yagiztr\movie\models;

use Yii;

/**
 * This is the model class for table "genre".
 *
 * @property int $id
 * @property string $name
 *
 * @property MovieGenre[] $movieGenres
 */
class Genre extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'genre';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
        ];
    }

    /**
     * Gets query for [[MovieGenres]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMovieGenres()
    {
        return $this->hasMany(MovieGenre::className(), ['genre_id' => 'id']);
    }
}
