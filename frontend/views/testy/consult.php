<?php

use yii\widgets\ActiveForm;//para trabajar con las validacione sdel modelo
use yii\helpers\Html;//para trabajar con contenido html
use yii\data\Pagination;//para incluir la data de paginacion
use yii\widgets\LinkPager;//para incluir los link de paginacion
use yii\helpers\Url;//para redireccionar url


$this->title = 'Consult All';
$this->params['breadcrumbs'][] = $this->title;
?>  
<div class="row">  
    <?php
    $form = ActiveForm::begin([
        'id' => 'form2',
        'action' => ['testy/select'],
        'method' => 'POST',
    ]);
    ?>
    <div class="row">
        <div class="form-group">
            <?= Html::label("ingrese el nomrbe")?>  
            <?= Html::textInput('nombre', null, ['class' => 'form-control'])//name,value,options?> 
            <?= Html::submitInput('enviar', ['class' => 'btn btn-primary'])//name,options?> 
        </div>    
    </div> 
<?php $form->end() //fin form?> 
</div>
<div class="row">
    <!--mostramos el mensaje generado por el controllers delete-->
    <?php if(isset($msg)):?>
            <div class="alert <?php echo ($status==1)?'alert-success':'alert-danger'?>" role="alert"><?= $msg;?></div>
            <script type="text/javascript">setTimeout(function() {$(".alert").fadeOut();}, 3000);</script>
    <?php endif;?>
</div>
<div class="row">   
    <h3>Lista de usuarios</h3>
    <table class="table table-bordered">
        <tr>
            <th>Nombre</th>
            <th>E-mail</th>
            <th>Password</th>
            <th></th>
            <th></th>
        </tr>
    <?php if(isset($model)):?>   
        <?php foreach($model as $con): ?>
        <tr>
            <td><?= $con->username?></td>
            <td><?= $con->email?></td>
            <td><?= $con->password?></td>
            <?php //if(!\Yii::$app->user->isGuest && Yii::$app->user->identity->role==2):?>
            <td><a target="black_" href="<?= Url::toRoute(["testy/edit", "id" => $con->id]) ?>">Editar afuera</a></td>
            <td>
                <a href="#" data-toggle="modal" data-target="#id_user_update<?= $con->id ?>">Editar aqui</a>
                <div class="modal fade" role="dialog" aria-hidden="true" id="id_user_update<?= $con->id ?>">
                          <div class="modal-dialog">
                                <div class="modal-content">
                                  <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                        <h4 class="modal-title">Editar Registro #<?= $con->id ?></h4>
                                  </div>
                                  <div class="modal-body">
                                  <?php $form2 = ActiveForm::begin([
                                            'id' => 'form2',
                                            'action' => ['testy/update'],
                                            'method' => 'POST',
                                        ]); 
                                    ?>
                                        <input type="hidden" name="id" value="<?= $con->id ?>">
                                        <div class="row">
                                            <div class="form-group  col-md-3">
                                                <?= Html::label("Nomrbe: ")?>
                                            </div> 
                                            <div class="form-group  col-md-9"> 
                                                <?= Html::textInput('nombre', $con->username, ['class' => 'form-control'])//name,value,options?>    
                                            </div>    
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-md-3">
                                                <?= Html::label("E-mail: ")?>  
                                            </div> 
                                            <div class="form-group  col-md-9"> 
                                                <?= Html::textInput('email', $con->email, ['class' => 'form-control'])//name,value,options?>    
                                            </div>    
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-md-3">
                                                <?= Html::label("Password: ")?>  
                                            </div> 
                                            <div class="form-group  col-md-9"> 
                                                <?= Html::passwordInput('password', null, ['class' => 'form-control'])//name,value,options?>    
                                            </div>
                                        </div>
                                  </div>
                                  <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                                        <button type="submit" class="btn btn-primary">Actualizar</button>
                                  </div>
                                  <?php $form2->end() ?>
                                </div><!-- /.modal-content -->
                          </div><!-- /.modal-dialog -->
                </div><!-- /.modal -->                
            </td>
            <td>
                <a href="#" data-toggle="modal" data-target="#id_user<?= $con->id ?>">Eliminar</a>
                <div class="modal fade" role="dialog" aria-hidden="true" id="id_user<?= $con->id ?>">
                          <div class="modal-dialog">
                                <div class="modal-content">
                                  <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                        <h4 class="modal-title">Eliminar Registro</h4>
                                  </div>
                                  <div class="modal-body">
                                        <p>¿Realmente deseas eliminar al usuario con id <?= $con->id ?>?</p>
                                  </div>
                                  <div class="modal-footer">
                                  <?php $form3 = ActiveForm::begin([
                                            'id' => 'form3',
                                            'action' => ['testy/delete'],
                                            'method' => 'POST',
                                        ]); 
                                    ?>
                                        <input type="hidden" name="id" value="<?= $con->id ?>">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                                        <button type="submit" class="btn btn-primary">Eliminar</button>
                                  <?php $form3->end() ?>
                                  </div>
                                </div><!-- /.modal-content -->
                          </div><!-- /.modal-dialog -->
                </div><!-- /.modal -->                
            </td>
        <?php //endif;?>
        </tr>
        <?php endforeach ?>
    <?php endif;?>  
    </table>   
    <?= LinkPager::widget([
            "pagination" => $pages,
    ])?>
</div>