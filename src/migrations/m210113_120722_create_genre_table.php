<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%genre}}`.
 */
class m210113_120722_create_genre_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%genre}}', [
            'id' => $this->primaryKey(),
            "name" => $this->string()->notNull()
        ]);

        $this->batchInsert("genre",["name"],[
            ["Comedy"],
            ["Action"],
            ["Sci-Fi"],
            ["Romance"],
            ["Adventure"],
            ["Drama"],
            ["Horror"],
            ["Documentary"]
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%genre}}');
    }
}
