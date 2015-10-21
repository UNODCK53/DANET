<?php

class DocumentosController extends BaseController {
	
	public function __construct()
	{
		$this->beforeFilter('auth');  //bloqueo de acceso
	}
	public function ListadoProini()
	{
		//return 'Aqui podemos listar a los usuarios de la Base de Datos:';
		$arrayproceso = DB::table('MODTIERRAS_PROCESO')
		->where ('id_proceso','=',$idpro)
		->select('OBJECTID','id_proceso','conceptojuridico','obsconceptojuridico','areapredioformalizada','longitud','latitud','fechainspeccionocular','viabilidad','obsviabilidad','respjuridico','requiererespgeo','respgeografico','created_at','updated_at','vereda','nombrepredio','direccionnotificacion','nombre','cedula','telefono','Shape')
		->get();

		$arrayproini = DB::select('SELECT DISTINCT * FROM MODTIERRAS_PROCESOINICIAL WHERE NOT EXISTS (SELECT * FROM MODTIERRAS_PROCESO WHERE MODTIERRAS_PROCESOINICIAL.id_proceso = MODTIERRAS_PROCESO.id_proceso)');
		$arrayconcepto = DB::select('select * from MODTIERRAS_CONCEPTO');
		$arrayrespgeografico = DB::select('SELECT id,name,last_name,grupo,level FROM users where grupo=3 and level=3');
		$arraydombobox= array($arrayconcepto, $arrayrespgeografico);

		return View::make('modulotierras.cargainicial', array('arrayproini' => $arrayproini), array('arraydombobox' => $arraydombobox));
	}
		
}
?>