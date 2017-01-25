<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
?>

<a href="<?= Url::toRoute("testy/consult") ?>">Ir a la lista</a>

<h1>Editar usuario con id #<?= Html::encode($model->id) ?></h1>

<?php $form = ActiveForm::begin([
	'action' => ['testy/edit'],
    "method" => "post",
    'enableClientValidation' => true,
]);
?>

<div class="row">
    <!--mostramos el mensaje generado por el controllers delete-->
    <?php if(isset($msg)):?>
            <div class="alert <?php echo ($status==1)?'alert-success':'alert-danger'?>" role="alert"><?= $msg;?></div>
            <script type="text/javascript">setTimeout(function() {$(".alert").fadeOut();}, 3000);</script>
    <?php endif;?>
</div>

<input type="hidden" name="id" value="<?= $model->id ?>">
<div class="row">
    <div class="form-group">
        <?= $form->field($model,'nombre')->input("text"); ?> 
    </div>    
</div>
<div class="row">
    <div class="form-group">   
        <?= $form->field($model,'email')->input("email"); ?> 
    </div>    
</div>
<div class="row">
    <div class="form-group">   
        <?= $form->field($model,'password')->input("password"); ?> 
    </div>    
</div>

<?= Html::submitInput("Actualizar", ["class" => "btn btn-primary"]) ?>

<?php $form->end() ?>

