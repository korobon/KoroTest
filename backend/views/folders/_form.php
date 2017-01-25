<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use frontend\models\Files;
use app\models\Categorys;
use app\models\Sites;

/* @var $this yii\web\View */
/* @var $model app\models\Folders */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="folders-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nameFolder')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'cant_files')->textInput() ?>

    <?= $form->field($model, 'ruta')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'list1')->dropDownList(
            ArrayHelper::map(Categorys::find()->all(),'id','name_fr'),
            [
                'prompt'=>'Select Category...',
                'onchange'=>'
                    $.post("index.php?r=sites/list&id='.'"+$(this).val(), function(data){
                            $("select#folders-list2").html(data);
                    });
                    '
            ]
    ) ?>

    <?= $form->field($model, 'list2')->dropDownList([''=>'Select Sites...']) ?>

    <?= $form->field($model, 'id_files')->dropDownList(
            ArrayHelper::map(Files::find()->all(),'id','name'),
            ['prompt'=>'Select File...']
    ) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
