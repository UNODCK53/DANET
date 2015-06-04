<?php


class UserLogin extends Basecontroller
{
	
	public function user()
	{
		//get  POST data
		$userdata = array(//se obtiene los datos de le login del formulario
			'username' => Input::get('username'),
			'password' => Input::get('password')
			
		);
	
	//'estado'=> $user->estado;


		if (Auth::attempt($userdata))//hace la compraracion de los datos y permite el ingreso
		{
			$my_id = Auth::user()->estado;
			
			if ($my_id==1){
			return Redirect::to('principal');
				}
				// usted esta logueado
			else{
				Auth::logout();
		return Redirect::to('/')->with('usuario_inactivo', true);
	}
			}
		
		else
		{
			return Redirect::to('/')->with('login_errors', true);//si estan mal los datos nos redirige al index
		}
		
	}
}
	
?>