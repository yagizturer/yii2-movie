<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%watchlist_movie}}`.
 */
class m210116_125047_create_watchlist_movie_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%watchlist_movie}}', [
            'id' => $this->primaryKey(),
            "movie_id"=>$this->integer(),
            "watchlist_id"=>$this->integer()
        ]);
        $this->addForeignKey('fk-watchlist_movie-movie_id', "watchlist_movie", "movie_id", "movie", "id");
        $this->addForeignKey('fk-watchlist_movie-watchlist_id', "watchlist_movie", "watchlist_id", "watchlist", "id");
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%watchlist_movie}}');
    }
}
