<?php

use yii\helpers\Html;
use yii\helpers\Url;


$this->title = 'menu';
$this->params['breadcrumbs'][] = ['label' => 'Manager', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $this->title, 'url' => [$this->title]];
foreach ($items as $item) {
    $this->params['breadcrumbs'][] = ['label' => $item, 'url' => Url::to([$this->title, 'item' => $item.'\\'])];
}
?>
<div class="manager-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <h3>Содержимое каталога <?= Html::encode($this->title) ?></h3>

    <ul>
        <p>Список всех файлов и каталогов:</p>
        <?php print_r($catalog); ?>
    </ul>



</div>
