<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Upload';
$this->params['breadcrumbs'][] = $this->title;
?>

<?= $msg ?>

<h3>Subir archivos</h3>

<?php $form = ActiveForm::begin([
     "method" => "post",
     "enableClientValidation" => true,
     "options" => ["enctype" => "multipart/form-data"],
     ]);
?>

<?= $form->field($model, "file[]")->fileInput(['multiple' => true]) ?>

<?= Html::submitButton("Subir", ["class" => "btn btn-primary"]) ?>

<?php $form->end() ?>

<script type="text/javascript">setTimeout(function() {$(".label-info").fadeOut();}, 3000);</script>
<script type="text/javascript">setTimeout(function() {$(".label-danger").fadeOut();}, 3000);</script>