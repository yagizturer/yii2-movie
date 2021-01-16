<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%watchlist}}`.
 */
class m210116_124532_create_watchlist_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%watchlist}}', [
            'id' => $this->primaryKey(),
            "user_id"=>$this->integer(),
            "name"=>$this->string()->notNull()
        ]);

        $this->addForeignKey('fk-watchlist-user_id', "watchlist", "user_id", "user", "id");
        
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%watchlist}}');
    }
}
