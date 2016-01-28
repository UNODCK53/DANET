<?php

class AdminController extends BaseController {

	/*
	|--------------------------------------------------------------------------
	| Default Home Controller
	|--------------------------------------------------------------------------
	|
	| You may wish to use controllers instead of, or in addition to, Closure
	| based routes. That's great! Here is an example controller method to
	| get you started. To route to this controller, just add the route:
	|
	|	Route::get('/', 'HomeController@showWelcome');
	|
	*/

	public function postIndividual()
	{
		$usuarios = DB::table('Vista_seguridad_por_usuario')
			->select('id','username')
			->orderBy('username', 'asc')
			->groupBy('username','id')
			->get();
		return Response::json($usuarios);
	}

	public function postGrupo()
	{
		$grupos = DB::table('users_grupo')
			->select('id','nom_grupo')
			->orderBy('nom_grupo', 'asc')
			->get();
		return Response::json($grupos);
	}
	public function postVistalevel()
	{		
		$level = DB::table('users_level')
			->select('id','nom_level')
			->orderBy('nom_level', 'asc')
			->get();
		return Response::json($level);
	}
	public function postAccgrupo()
	{
		$grupo=Input::get('grupo');
		$level=Input::get('level');
		$vistaacc = DB::table('vistas')
			->join('acceso_grupo', 'vistas.id', '=','acceso_grupo.id_vista')
			->where('id_grupo','=',$grupo)
			->where('id_level','=', $level)
			->select('id','nom_vista','acces')			
			->get();
		return Response::json($vistaacc);
	}
	public function postAccindividual()
	{
		$usuario=Input::get('usu');
		$idividual = DB::table('Vista_seguridad_por_usuario')
			->where('id','=', $usuario)
			->select('vista','nom_vista','acces','id')
			->orderBy('vista')
			->get();
		return Response::json($idividual);
	}
	public function postGuardavistas()
	{
		$mod=Input::get('modradiousu');
		$selmodificar=Input::get('selmodificar');
		$sellevel=Input::get('selmodificarlevel');
		$vistas=Input::get('selectvistas');		
		$datos=array($mod,$selmodificar,$sellevel,$vistas);
		$fecha = date("Y-m-d H:i:s");

		if($mod==1){
			if(($sellevel == null) || empty($sellevel) ||($vistas == null) || empty($vistas))
			{
				return Redirect::to('accvistas')->with('status', 'error_estatus');
			}
			DB::table('acceso_grupo')
			->where('id_grupo',$selmodificar)
			->where('id_level',$sellevel)
			->update(array('acces'=>0));

			DB::table('Vista_seguridad_por_usuario')
			->where('grupo',$selmodificar)
			->where('level',$sellevel)
			->update(array('acces'=>0));

			foreach ($vistas as $vista){
				DB::table('acceso_grupo')
				->where('id_grupo',$selmodificar)
				->where('id_level',$sellevel)
				->where('id_vista',$vista)
				->update(array('acces'=>1));

				DB::table('Vista_seguridad_por_usuario')
				->where('grupo',$selmodificar)
				->where('level',$sellevel)
				->where('vista',$vista)
				->update(array('acces'=>1));
			}

			$accesusers = DB::table('Vista_seguridad_por_usuario')
				->where('grupo',$selmodificar)
				->where('level',$sellevel)
				->select('vista','id','acces')
				->get();

			foreach($accesusers as $accesuser){
				DB::table('acceso_his')->insert(
					array('id_user'=>$accesuser->id,
						'id_vista'=>$accesuser->vista,
						'acces'=>$accesuser->acces,
						'fecha_mod'=>$fecha
						)
				);
			}
			return Redirect::to('accvistas')->with('status', 'ok_estatus');
		}
		else if($mod==2){
			DB::table('acceso')
			->where('id_user',$selmodificar)
			->update(array('acces'=>0));

			foreach ($vistas as $vista){
				DB::table('acceso')
				->where('id_user',$selmodificar)
				->where('id_vista',$vista)
				->update(array('acces'=>1));
			}
			
			$accesusers = DB::table('acceso')
				->where('id_user',$selmodificar)
				->get();

			foreach($accesusers as $accesuser){
				DB::table('acceso_his')->insert(
					array('id_user'=>$accesuser->id_user,
						'id_vista'=>$accesuser->id_vista,
						'acces'=>$accesuser->acces,
						'fecha_mod'=>$fecha
						)
				);
			}
			return Redirect::to('accvistas')->with('status', 'ok_estatus');
		}
		return Redirect::to('accvistas')->with('status', 'error_estatus');
	}
}