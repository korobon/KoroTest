<?php

namespace frontend\models;

use Yii;
use yii\base\Model;

class ValidarRegistro extends Model{

	public $id;
	public $nombre;
	public $email;
	public $password;
	public $confirm_password;
	public $sexo;
	public $terminos;
	public $captcha;

	public function rules(){
		return [
					//validation name
					['nombre', 'required', 'message' => 'el campo no puede estar vacio'],
					[
					'nombre',
					'match',
					'pattern' => '/^.{3,10}$/',
					'message' => 'minimo 3 maximo 10'
					],
					[
					'nombre',
					'match',
					'pattern' => '/^.[a-z]+$/i',
					'message' => 'solo se aceptan letras'
					],
					//validation email
					['email', 'required', 'message' => 'el campo no puede estar vacio'],
					[
					'email',
					'match',
					'pattern' => '/^.{10,20}$/',
					'message' => 'minimo 10 maximo 20'
					],
					['email', 'email', 'message' => 'email invalido'],
					['email', 'validate_email'],
					//validation password 
					['password', 'required', 'message' => 'el campo no puede estar vacio'],
					[
					'password',
					'match',
					'pattern' => '/^.[0-9a-z]+$/i',
					'message' => 'obligatorio letras o numeros'
					],
					//validation confirmation password
					['confirm_password', 'required', 'message' => 'el campo no puede estar vacio'],
					[
					'confirm_password',
					'compare',
					'compareAttribute' => 'password',
					'message' => 'las contraseñas no coinciden',
					],
					//validation sexo
					['sexo', 'required', 'message' => 'debe seleccionar una opicion'],
					//validation terminos
					['terminos', 'required', 'message' => 'debe seleccionar esta opicion'],

					//validation captcha
					['captcha', 'captcha', 'message' => 'EL {attribute} es incorrecto'],
					
				];
	}
	
	public function validate_email($attribute,$params){
		$emails = ['manue@gmail.com','coro@gmail.com'];
		foreach ($emails as $em) {
			if($this->email == $em){
				$this->addError($attribute,'Email no disponible');
				return true;
			}else{
				return false;
			}
		}
	}

	public function attributeLabels()
	{
		return [
				'nombre'=>'Nombre: ',
				'email'=>'E-mail: ',
				'sexo'=>'Sexo: ',
				'terminos'=>'Acepta los terminos',
				];
	}
}

?>