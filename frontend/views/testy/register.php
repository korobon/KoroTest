<?php

use yii\widgets\ActiveForm;//para trabajar con las validacione sdel modelo
use yii\helpers\Html;//para trabajar con contenido html

$this->title = 'Register';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">   
    <h3>
    <?= $msg;?>
    <?php if(isset($valor)):?>
        <?php foreach ($valor as $var) {?>
            <div class="row"> <?= $var;?></div>
        <?php }?>
    <?php endif;?>
    </h3>         
</div>
<h1>formulario</h1>
<div class="row">  
    <?php
    $form = ActiveForm::begin([
        'id' => 'form',
        'method' => 'POST',
        'enableClientValidation' => true,
    ]);
    ?>
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
    <div class="row">
        <div class="form-group">   
            <?= $form->field($model,'confirm_password')->input("password"); ?> 
        </div>    
    </div>
    <div class="row">
        <div class="form-group">   
            <?= $form->field($model,'sexo')->radioList(array(1=>'f', 2=>'m')); ?> 
        </div>    
    </div>
    <div class="row">
        <div class="form-group">   
            <?= $form->field($model,'terminos')->checkbox(); ?> 
        </div>    
    </div>
    <div class="row">
        <div class="form-group">
            <?= $form->field($model, 'captcha')->widget(\yii\captcha\Captcha::classname(), []) ?>
        </div>
    </div>
    <div class="row">
        <?= Html::submitInput('enviar', ['class' => 'btn btn-primary'])//name,options?>      
    </div>
     

<?php $form->end() //fin form?> 
</div>