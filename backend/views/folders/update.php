<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Folders */

$this->title = 'Update Folders: ' . ' ' . $model->nameFolder;
$this->params['breadcrumbs'][] = ['label' => 'Folders', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->nameFolder, 'url' => ['view', 'id' => $model->idFolder]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="folders-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
