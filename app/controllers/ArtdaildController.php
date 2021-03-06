<?php

class ArtdaildController extends BaseController {
	

	//-------------------------------------------------------------------------------------
	//Controladores para la vista de edicion
	public function __construct()
	{
		$this->beforeFilter('auth');  //bloqueo de acceso
	}
	public function DaildPreload()
	{
		

		$arraydaild = DB::table('MODART_DAILD_ACUERDOSCOLEC')	
			->select('id_acuerdo', DB::raw("concat(DATENAME(weekday, fechafirma),','  ,DATENAME(day, fechafirma),' de ',DATENAME(month, fechafirma),' de ',DATENAME(year, fechafirma)) as fecha,  MUNICIPIOS.NOM_DPTO AS depto,MUNICIPIOS.NOM_MPIO AS mpio,COUNT(mpio) AS terr,ISNULL(sum(familias),0) AS familias,ISNULL(sum(hectareas),0) AS has"))
			->join('MUNICIPIOS','MUNICIPIOS.COD_DANE','=','MODART_DAILD_ACUERDOSCOLEC.mpio')
			->groupby('id_acuerdo','MUNICIPIOS.NOM_DPTO ','MUNICIPIOS.NOM_MPIO','fechafirma')
			->orderby('id_acuerdo','desc')
			->orderby('depto','asc')
			->orderby('mpio','asc')
			->get();

		$arraygeneral = DB::table('MODART_DAILD_ACUERDOSCOLEC')	
			->select( DB::raw("count(veredadaild) as veredadaild,  ISNULL(sum(familias),0) AS familias,ISNULL(sum(hectareas),0) AS has"))
			->get();	

		$arrayacuerdos = DB::select("select count(id_acuerdo) as acu from (SELECT id_acuerdo FROM MODART_DAILD_ACUERDOSCOLEC group by id_acuerdo) as t");	

		return View::make('modulodaild/acuerdoscolectivos',array('arraydaild' => $arraydaild,'arraygeneral' => $arraygeneral,'arrayacuerdos'=>$arrayacuerdos));
	}

	public function postDaildConsulta()
	{
		

		$arraydaild = DB::table('MODART_DAILD_ACUERDOSCOLEC')	
			->select('id_acuerdo', DB::raw("concat(DATENAME(weekday, fechafirma),','  ,DATENAME(day, fechafirma),' de ',DATENAME(month, fechafirma),' de ',DATENAME(year, fechafirma)) as fecha,  MUNICIPIOS.NOM_DPTO AS depto,MUNICIPIOS.NOM_MPIO AS mpio,nucleoterritorial,veredadaild,ISNULL(familias,0)as familias,ISNULL(hectareas,0)as hectareas"))
			->join('MUNICIPIOS','MUNICIPIOS.COD_DANE','=','MODART_DAILD_ACUERDOSCOLEC.mpio')
			->where('id_acuerdo','=',Input::get('acuerdo'))
			->orderby('nucleoterritorial','asc')
			->orderby('veredadaild','asc')
			->get();

		
		return array('arraydaildconsul' => $arraydaild);
	}

	
}
?>