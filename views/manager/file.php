<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Manager', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => 'menu', 'url' => ['menu']];
foreach ($items as $item) {
    $this->params['breadcrumbs'][] = ['label' => $item, 'url' => Url::to([$item, 'item' => $item.'\\'])];
}
$this->params['breadcrumbs'][] = ['label' => $this->title];
?>
<div class="manager-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <h3>Содержимое файла:</h3>

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['minlength' => true, 'value' => $model->title]) ?>

    <?= $form->field($model, 'description')->textarea(['value' => $model->description, 'rows' => 20]) ?>


    <div class="form-group">
        <?= Html::submitButton('Edit/Add', ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>


</div>




