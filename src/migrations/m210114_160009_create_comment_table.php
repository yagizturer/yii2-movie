<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%comment}}`.
 */
class m210114_160009_create_comment_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%comment}}', [
            'id' => $this->primaryKey(),
            "user_id" => $this -> integer() -> notNull(),
            "movie_id" => $this -> integer() -> notNull(),
            "title" => $this -> text() -> notNull(),
            "content" => $this -> text() -> notNull(),
            "created_at" => $this -> timestamp() -> defaultValue(null) -> append("ON UPDATE CURRENT_TIMESTAMP")
        ]);
        $this->addForeignKey('fk-comment-movie_id', "comment", "movie_id", "movie", "id");
        $this->addForeignKey('fk-comment-user_id', "comment", "user_id", "user", "id");
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%comment}}');
    }
}
