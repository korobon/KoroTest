<?php 
use yii\helpers\Url; 

$this->title = 'Download';
$this->params['breadcrumbs'][] = $this->title;
?>

<h3>Lista de archivos disponibles para descargar</h3>
<?php if (Yii::$app->session->hasFlash('errordownload')): ?>
<strong class="label label-danger">¡Ha ocurrido un error al descargar el archivo!</strong>

<?php else: ?>
	<!--<a href="<?//= Url::toRoute(["testy/download", "file" => "ACTA1.doc"]) ?>">Descargar archivo</a>-->

    <?php if(isset($data)):?>   
    	<div class="list-group col-md-6">
        <?php foreach($data as $dat): ?>
			<a href="<?= Url::toRoute(["testy/download", "file" => $dat->name]) ?>" class="list-group-item"><?= $dat->name;?></a>
        <?php endforeach ?>
        </div>
    <?php endif;?>
<?php endif; ?>