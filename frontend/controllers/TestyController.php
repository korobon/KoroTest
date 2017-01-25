<?php

namespace frontend\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use frontend\models\ValidarRegistro;
use frontend\models\ConsultasDB;
use yii\data\Pagination;
use yii\helpers\Html;
use frontend\models\ValidarRegisterUsers;
use frontend\models\Users;
use yii\helpers\Url;//para redireccionar url
use yii\widgets\ActiveForm;//para que funcione la validacion con ajax
use yii\web\Response;//para que funcione la validacion con ajax
use yii\web\Session;//para trabajar con las sesiones
use frontend\models\ValidarRecoverPass;
use frontend\models\ValidarResetPass;
use frontend\models\ValidarUpload;
use yii\web\UploadedFile;//para la carga de archivos
use frontend\models\Files;
use common\models\User;
use common\models\User_Otros;
use yii\web\ForbiddenHttpException;
use yii\web\NotFoundHttpException;


class TestyController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['download', 'upload', 'delete', 'update', 'edit', 'consult', 'register'],
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],/*
                    [
                    	'actions' => ['download', 'consult'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                    [
                    	'actions' => ['upload', 'delete', 'edit', 'register'],
                        'allow' => true,
                        'roles' => ['@'],
                        'matchCallback'=> function ($rule, $action) {                        
                        		return (!User::isUserAdmin(Yii::$app->user->identity->id))?User_Otros::isUserAdmin(Yii::$app->user->identity->id):User::isUserAdmin(Yii::$app->user->identity->id);
                    			}
                    ],*/
                ],
            ],
        ];
    }
	/**
	 * Declares class-based actions.
	 */
	public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
			),
			// page action renders "static" pages stored under 'protected/views/site/pages'
			// They can be accessed via: index.php?r=site/page&view=FileName
			'page'=>array(
				'class'=>'CViewAction',
			),
		);
	}

	public function actionRegister()
	{
		if(Yii::$app->user->can('register-persons'))
		{
				$msg="";
				$model = new ValidarRegistro;
				$model->sexo=2;
				$model->terminos=1;
				if($model->load(Yii::$app->request->post())){
					if ($model->validate()) {
						$consulta = new ConsultasDB;
						$consulta->username=$model->nombre;
						$consulta->password=sha1($model->password);
						$consulta->email=$model->email;

						if ($consulta->insert()) {
							$msg = "los datos se han guardado con exito";
							$model->nombre=null;
							$model->email=null;
							$model->sexo=2;
							$model->terminos=1;
						}else{
							$msg = "ha ocurrido un error al insertar el registro";
						}				

					}else{
						$model->getErrors();				
					}
				}
				return $this->render('register', ['model' => $model,'msg' => $msg]);
		}else{            
            throw new NotFoundHttpException('access denied');
        }
	}

	public function actionConsult($nombre=null,$msg=null,$status=null)
	{
			$model = new ConsultasDB;
			$data = $model->find();
			//$data = $model->find()->all();
			$search = null;
			if(isset($nombre) && !empty($nombre)) $search = $model->find()->where(["like", "username", $nombre]);
			//if(isset($nombre) && !empty($nombre)) $search = $model->find()->where(["like", "username", $nombre])->all();
			//if(isset($nombre) && !empty($nombre)) $search = $model->find()->where("username=:username", [":username" => $nombre])->all();
			//if(isset($nombre)) $search = $model->findBySql("SELECT * FROM tbl_user WHERE username='$nombre'")->all();
			if(isset($search) && !empty($search)) $data = $search;
			
			$count = clone $data;
			$pages = new Pagination([
					"pageSize" => 3,
					"totalCount" => $count->count()
				]);
			$data = $data->offset($pages->offset)
						 ->limit($pages->limit)
						 ->all();

			return $this->render('consult', ['model' => $data, 'pages' => $pages, 'msg' => $msg, 'status' => $status]);
 	}

	public function actionSelect()
	{
		return $this->redirect( 
			[
			'testy/consult',
			'nombre' => $_REQUEST["nombre"],
			]);
	}

	public function actionEdit()
	{
		if(Yii::$app->user->can('update-persons'))
		{
			$msg=null;
			$status=null;
			$model = new ValidarRegistro;			

			if (Yii::$app->request->get("id")){
				$consulta = new ConsultasDB;
				$consulta = $consulta->findOne($_GET["id"]);
		        if($consulta){
		            $model->id = $consulta->id;
		            $model->nombre = $consulta->username;
		            $model->email = $consulta->email;
		            $model->password = $consulta->password;
		        }
		        else{
		            $msg = "El usuario seleccionado no ha sido encontrado";
					$status = 2;
		        }
		    }else if($model->load(Yii::$app->request->post())){
				if (!$model->validate()) {	
					$consulta = new ConsultasDB;
					$consulta = $consulta->findOne($_POST["id"]);
					$consulta->username=$model->nombre;
					$consulta->password=sha1($model->password);
					$consulta->email=$model->email;
					if ($consulta->update()){
						$msg = "El usuario ha sido actualizado correctamente";
						$status = 1;
						$consulta = new ConsultasDB;
						$consulta = $consulta->findOne($_POST["id"]);
		            	$model->id = $consulta->id;
			            $model->nombre = $consulta->username;
			            $model->email = $consulta->email;
			            $model->password = $consulta->password;
					}else{
						$msg = "El usuario no ha podido ser actualizado";
						$status = 2;
					}
				}
			}

			return $this->render('edit', ['model' => $model,'msg' => $msg,'status' => $status]);
		}else{            
            throw new NotFoundHttpException('access denied');
        }

	}

	public function actionUpdate()
	{
		if(Yii::$app->user->can('update-persons'))
		{
			$model = new ConsultasDB;
			if(Yii::$app->request->post()){
				$model = $model->findOne($_POST["id"]);
				if($model){
					$model->username=$_POST["nombre"];
					$model->password=sha1($_POST["password"]);
					$model->email=$_POST["email"];
					if ($model->update()){
						$msg = "El usuario ha sido actualizado correctamente";
						$status = 1;
					}else{
						$msg = "El usuario no ha podido ser actualizado";
						$status = 2;
					}
				}else{
					$msg = "El usuario seleccionado no ha sido encontrado";
					$status = 2;
				}
				return $this->redirect( 
				[
				'testy/consult',
				'msg' => $msg,
				'status' => $status,
				]);			
			}
		}else{            
            throw new NotFoundHttpException('access denied');
        }
	}

	public function actionDelete()
	{
		if(Yii::$app->user->can('delete-persons'))
		{
			$model = new ConsultasDB;
			$msg = null;
			$status = null;
			if(Yii::$app->request->post()){
				$id_user = Html::encode($_POST["id"]);
				if($model->deleteAll("id=:id", [":id" => $id_user])){
					$msg = "El usuario con id $id_user eliminado con éxito";
					$status = 1;
				}else{
					$msg = "No se ha logrado eliminar el usuario con id $id_user";
					$status = 2;
				}
				return $this->redirect( 
				[
				'testy/consult',
				'msg' => $msg,
				'status' => $status,
				]);
			}
		}else{            
            throw new NotFoundHttpException('access denied');
        }
	}

	public function actionUpload()
	{
		if(Yii::$app->user->can('upload-files'))
		{	 
			 $model = new ValidarUpload;
			 $files = new Files;
			 $msg = null;
			 
			 if ($model->load(Yii::$app->request->post()))
			 {
			  $model->file = UploadedFile::getInstances($model, 'file');

			  if ($model->file && $model->validate()) {
			   foreach ($model->file as $file) {
				$files->name=$file->baseName . '.' . $file->extension;

				if ($files->insert()) {
				    $file->saveAs('archivos/' . $file->baseName . '.' . $file->extension);
				    $msg = "<p><strong class='label label-info'>Enhorabuena, subida realizada con éxito</strong></p>";			
				}else{
				    $msg = "<p><strong class='label label-danger'>Hubo un error, intentelo más tarde</strong></p>";			
				}
			   }
			  }
			 }
			 return $this->render("upload", ["model" => $model, "msg" => $msg]);
		}else{            
            throw new NotFoundHttpException('access denied');
        }
	}

	private function downloadFile($dir, $file, $extensions=[]){
	 //Si el directorio existe
	 if (is_dir($dir))
	 {
	  //Ruta absoluta del archivo
	  $path = $dir.$file;
	  
	  //Si el archivo existe
	  if (is_file($path))
	  {
	   //Obtener información del archivo
	   $file_info = pathinfo($path);
	   //Obtener la extensión del archivo
	   $extension = $file_info["extension"];
	   
	   if (is_array($extensions))
	   {
	    //Si el argumento $extensions es un array
	    //Comprobar las extensiones permitidas
	    foreach($extensions as $e)
	    {
	     //Si la extension es correcta
	     if ($e === $extension)
	     {
	      //Procedemos a descargar el archivo
	      // Definir headers
	      $size = filesize($path);
	      header("Content-Type: application/force-download");
	      header("Content-Disposition: attachment; filename=$file");
	      header("Content-Transfer-Encoding: binary");
	      header("Content-Length: " . $size);
	      // Descargar archivo
	      readfile($path);
	      //Correcto
	      return true;
	     }
	    }
	   }
	   
	  }
	 }
	 //Ha ocurrido un error al descargar el archivo
	 return false;
	}

	public function actionDownload(){
		if(Yii::$app->user->can('download-files'))
		{
			 $files = new Files;
			 $data = $files->find()->all();

			 if (Yii::$app->request->get("file")){
			  //Si el archivo no se ha podido descargar
			  //downloadFile($dir, $file, $extensions=[])
			  if (!$this->downloadFile("archivos/", Html::encode($_GET["file"]), ["pdf", "txt", "doc"])){
			   //Mensaje flash para mostrar el error
			   Yii::$app->session->setFlash("errordownload");
			  }
			 }
			 
			 return $this->render("download", ["data" => $data]);
		}else{            
            throw new NotFoundHttpException('access denied');
        }
	}

}

?>