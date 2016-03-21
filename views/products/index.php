<?php

use yii\helpers\Url;

/* @var $this yii\web\View */

$this->title = 'Products';
?>

<div class="site-index">

    <h4>Products</h4>
    <ol>
        <li><a href="<?= Url::toRoute('products/books') ?>">Книги</a></li>
        <li><a href="<?= Url::toRoute('products/films') ?>">Фильмы</a></li>
    </ol>

</div>