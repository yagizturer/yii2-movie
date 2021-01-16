<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%movie_genre}}`.
 */
class m210113_121941_create_movie_genre_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%movie_genre}}', [
            'id' => $this->primaryKey(),
            "movie_id" => $this->integer(),
            "genre_id" => $this->integer()
        ]);
        $this->addForeignKey('fk-movie_genre-movie_id', "movie_genre", "movie_id", "movie", "id");
        $this->addForeignKey('fk-movie_genre-genre_id', "movie_genre", "genre_id", "genre", "id");
        $this->batchInsert("movie_genre", ["movie_id", "genre_id"], [
            [1, 6], [1, 4], [2, 1], [2, 5], [3, 2], [3, 3], [3, 5], [4, 2], [4, 3], [4, 4], [4, 5]
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%movie_genre}}');
    }
}
