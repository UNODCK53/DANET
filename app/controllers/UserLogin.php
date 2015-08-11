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
			$my_check = Auth::user()->pass_check;
			
			if ($my_id==1){
				if ($my_check==1){
				return Redirect::to('principal');
				}
				else{
				return Redirect::to('principal')->with('cambiar_pass', true);
				}
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

	public function cambiar()
	{
		$user_id = Auth::user()->id;
		$user = User::find($user_id);
		$password = Input::get('password1');
		$user->password = Hash::make($password);
		$user->pass_check = 1;
		$user->save();
		return Redirect::to('principal')->with('cambiopassok', true);
	}
}
?>