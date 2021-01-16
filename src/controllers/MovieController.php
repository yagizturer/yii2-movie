<?php

namespace yagiztr\movie\controllers;

use Yii;
use yagiztr\movie\models\Movie;
use yagiztr\movie\models\MovieGenre;
use yagiztr\movie\models\MovieSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * MovieController implements the CRUD actions for Movie model.
 */
class MovieController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Movie models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new MovieSearch();
        if (array_key_exists("genre", Yii::$app->request->queryParams)) {
            $dataProvider = $searchModel->search(Yii::$app->request->queryParams, Yii::$app->request->queryParams["genre"]);
        } else {
            $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        }


        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Movie model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Movie model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Movie();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $genre_ids = Yii::$app->request->bodyParams["Genre"]["id"];
            foreach ($genre_ids as $id) {
                $genre_model = new MovieGenre();
                $genre_model->movie_id = $model["id"];
                $genre_model->genre_id = $id;
                $genre_model->save();
            }
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Movie model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            MovieGenre::deleteAll("movie_id=$id");
            if (is_array(Yii::$app->request->bodyParams["Genre"]["id"])) {
                $genre_ids = Yii::$app->request->bodyParams["Genre"]["id"];
                foreach ($genre_ids as $id) {
                    $genre_model = new MovieGenre();
                    $genre_model->movie_id = $model["id"];
                    $genre_model->genre_id = $id;
                    $genre_model->save();
                }
            }
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Finds the Movie model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Movie the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Movie::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
