<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%movie}}`.
 */
class m210113_121109_create_movie_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%movie}}', [
            'id' => $this->primaryKey(),
            "title" => $this->string()->notNull(),
            "release_year" => $this->integer(4)->notNull(),
            "summary" => $this->text(),
            "poster_url" => $this->string(700)
        ]);

        $this->batchInsert("movie", ["title", "release_year", "summary", "poster_url"], [
            ["Euphoria", 2019, "A look at life for a group of high school students as they grapple with issues of drugs, sex and violence.", "https://m.media-amazon.com/images/M/MV5BMDMzZDkyNzEtYTY5Ni00NzlhLWI4MzUtY2UzNjNmMjI1YzIzXkEyXkFqcGdeQXVyMDM2NDM2MQ@@._V1_FMjpg_UX600_.jpg"],
            ["The Great", 2020, "A royal woman living in rural Russia during the 18th century is forced to choose between her own personal happiness and the future of Russia, when she marries an Emperor.", "https://m.media-amazon.com/images/M/MV5BY2ExZDU0YzQtOGFkNC00OWY1LWI4MzAtZDNkZmQ1OTU3YjdiXkEyXkFqcGdeQXVyOTQwNjAzMjM@._V1_FMjpg_UY911_.jpg"],
            ["Harry Potter and the Sorcerer's Stone", 2001, "An orphaned boy enrolls in a school of wizardry, where he learns the truth about himself, his family and the terrible evil that haunts the magical world.", "https://m.media-amazon.com/images/M/MV5BNTkwNWEwYjQtODRkZS00MmQ5LTk0ZDAtYjA3MWMyOTYzNzU1XkEyXkFqcGdeQXVyMzM4MjM0Nzg@._V1_FMjpg_UX700_.jpg"],
            ["Star Wars: Episode III - Revenge of the Sith", 2005, "Three years into the Clone Wars, the Jedi rescue Palpatine from Count Dooku. As Obi-Wan pursues a new threat, Anakin acts as a double agent between the Jedi Council and Palpatine and is lured into a sinister plan to rule the galaxy.", "https://m.media-amazon.com/images/M/MV5BMTkxNzE5NzIwMl5BMl5BanBnXkFtZTYwMDIwNDY3._V1_FMjpg_UX450_.jpg"]
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%movie}}');
    }
}
