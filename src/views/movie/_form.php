<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\URL;
use yagiztr\movie\models\Genre;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model frontend\modules\movie\models\Movie */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="movie-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'release_year')->textInput() ?>

    <?= $form->field($model, 'summary')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'poster_url')->textInput(['maxlength' => true]) ?>

    <?= $form->field(new Genre, "id")->dropDownList(ArrayHelper::map(Genre::find()->all(), "id", "name"), [
        'multiple' => 'multiple'
    ])->label("Genre"); ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>