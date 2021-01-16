<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yagiztr\movie\models\Movie;
use yagiztr\movie\models\Genre;

/* @var $this yii\web\View */
/* @var $searchModel frontend\modules\movie\models\MovieSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Movies';
$this->params['breadcrumbs'][] = $this->title;
?>

<style>
    .summary-column {
        column-width: 25rem;
        overflow: hidden;
    }
    .genre-container{
        display: flex;
        justify-content: center;
        font-size: 1.5em;
    }
</style>
<div class="movie-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Movie', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <div class="genre-container" style="color:mediumblue">
        <label for="genres">Genre:</p>
        <select name="genres" id="genres">
            <option value="0">All</option>
            <?php
            foreach (Genre::find()->all() as $genre_row) {
                echo "<option value=\"$genre_row->id\">$genre_row->name</option>";
            }
            ?>
        </select>
    </div>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            'title',
            'release_year',
            [
                "attribute" => "summary",
                "contentOptions" => [
                    "class" => ["summary-column"]
                ]
            ],
            [
                "attribute" => "genre",
                "value" => function ($data) {
                    return Movie::find()->where("id=$data->id")->one()->getMovieGenres();
                }
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                "buttons" => [
                    "delete" => function ($data) {
                        return "<div style=\"display: \"none\"\"/>";
                    }
                ]
            ],
        ],
    ]); ?>


</div>

<script>
    const queryParams = new URLSearchParams(window.location.search);
    if (queryParams.has("genre")) {
        document.querySelector("option[value=\"" + queryParams.get("genre") + "\"]").selected = "selected";
    }
    document.getElementById("genres").addEventListener("change", (event) => {
        queryParams.set("genre", event.target.value);
        const myURL = new URL(window.location.href.split("?")[0]);
        for (const [key, value] of queryParams) {
            myURL.searchParams.append(key, value);
        }
        window.location.href = myURL.href;
    })
</script>