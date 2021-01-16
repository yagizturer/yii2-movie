<?php
namespace yagiztr\movie\controllers;

class DefaultController extends \yii\web\Controller
{
    public function actionIndex()
    {
        return $this->redirect(["movie/index"]);
    }
}