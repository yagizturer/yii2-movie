<?php
use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\Url;



/* @var $this yii\web\View */
/* @var $model frontend\modules\movie\models\Movie */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Movies', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>

<style>
    .movie-container {
        display: flex;
    }

    img {
        width: auto;
    }
</style>
<div class="movie-view">
<a href="<?php echo Url::toRoute(['/movie/movie/index']); ?>" style="font-size:2em; margin-right:2em;">Movies</a>
    <a href="<?php echo Url::toRoute(['/watchlist/watchlist/index']); ?>" style="font-size:2em; margin-right:2em;">My Watchlists</a>
    <a href="<?php echo Url::toRoute(['/comment/comment/index']); ?>" style="font-size:2em; margin-bottom: 2em;">My Comments</a>
    <h1><?= Html::encode($this->title) ?></h1>
    <div class="movie-container">
        <div class="poster-container">
            <img src="<?php echo $model->poster_url ?>" alt="">
        </div>
        <?= DetailView::widget([
            'model' => $model,
            'attributes' => [
                'id',
                'title',
                'release_year',
                'summary:ntext',
                "genre" => [
                    "attribute" => "genre",
                    "value" => $model->getMovieGenres()
                ]
            ],
        ]) ?>
    </div>
    <?php
    try {
        if (class_exists('xedeer\watchlist\models\Watchlist')) {
            if (Yii::$app->user->isGuest) {
                echo '<h4 style="color: red;">Please login to enable watchlists.</h4>';
            } else {
                echo $this->render("@vendor/xedeer/yii2-watchlist/src/views/watchlist-movie/_form", [
                    "model" => new xedeer\watchlist\models\WatchlistMovie(),
                    "movie_id" => $model->id,
                    "is_delete" => false
                ]);
                echo $this->render("@vendor/xedeer/yii2-watchlist/src/views/watchlist-movie/_form", [
                    "model" => new xedeer\watchlist\models\WatchlistMovie(),
                    "movie_id" => $model->id,
                    "is_delete" => true
                ]);
            }
        } else {
            throw new ErrorException();
        }
    } catch (Exception $e) {
        echo '<h4 style="color: red;">You cannot view watchlists as the watchlist module isn\'t installed.</h4>';
    }
    ?>
    <?php
    try {
        if (class_exists('huseyinyilmaz\comment\models\Comment')) {
            $comment_module = new huseyinyilmaz\comment\models\Comment();
        } else {
            throw new ErrorException();
        }
        echo '<div class="comment-list">';

        echo
        $this->render('@vendor/huseyinyilmaz/yii2-comment/src/views/comment/view', [
            "movie_id" => $model->id
        ]);

        echo "</div>";

        if (!Yii::$app->user->isGuest) {
            echo "<div class=\"comment-create\">
    
            <h1>New Comment</h1>";

            echo  $this->render('@vendor/huseyinyilmaz/yii2-comment/src/views/comment/_form', [
                'model' => $comment_module,
                'movie_id' => $model->id
            ]);

            echo "</div>";
        } else {
            echo '<h4 style="color: red;">You must login to post a comment.</h4>';
        }
    } catch (Exception $e) {
        echo '<h4 style="color: red;">You cannot view comments about this movie as the comment module isn\'t installed.</h4>';
    }

    ?>

</div>

<script>
    document.querySelector("img").style.height = document.getElementById("w0").offsetHeight + "px";
</script>