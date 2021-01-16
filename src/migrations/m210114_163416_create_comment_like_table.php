<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%comment_like}}`.
 */
class m210114_163416_create_comment_like_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%comment_like}}', [
            'id' => $this->primaryKey(),
            "user_id" => $this -> integer() -> notNull(),
            "comment_id" => $this -> integer() -> notNull()
        ]);
        $this->addForeignKey('fk-comment_like-comment_id', "comment_like", "comment_id", "comment", "id");
        $this->addForeignKey('fk-comment_like-user_id', "comment_like", "user_id", "user", "id");
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%comment_like}}');
    }
}
