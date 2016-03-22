<?php

use yii\helpers\Html;
use yii\helpers\Url;


$this->title = 'Menu';
$this->params['breadcrumbs'][] = ['label' => 'Manager', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="manager-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <h3>Содержимое каталога <?= Html::encode($this->title) ?></h3>

    <ul>
        <?php foreach($folders as $folder): ?>
            <li>
                <a href="<?= yii\helpers\Url::toRoute(['manager/open/', 'name' => $folder]) ?>"><?= Html::encode($folder) ?></a>
            </li>
        <?php endforeach; ?>
    <?php foreach($files as $file): ?>
        <li>
        <a href="<?= yii\helpers\Url::toRoute(['manager/open/', 'name' => $file]) ?>"><?= Html::encode($file) ?></a>
        </li>
    <?php endforeach; ?>
    </ul>


</div>
