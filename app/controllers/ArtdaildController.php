<?php

class ArtdaildController extends BaseController {
	

	//-------------------------------------------------------------------------------------
	//Controladores para la vista de edicion

	public function DaildPreload()
	{
		

		$arraydaild = DB::table('MODART_DAILD_ACUERDOSCOLEC')	
			->select('id_acuerdo', DB::raw("concat(DATENAME(weekday, fechafirma),','  ,DATENAME(day, fechafirma),' de ',DATENAME(month, fechafirma),' de ',DATENAME(year, fechafirma)) as fecha,  MUNICIPIOS.NOM_DPTO AS depto,MUNICIPIOS.NOM_MPIO AS mpio,COUNT(mpio) AS terr,sum(familias) AS familias,sum(hectareas) AS has"))
			->join('MUNICIPIOS','MUNICIPIOS.COD_DANE','=','MODART_DAILD_ACUERDOSCOLEC.mpio')
			->groupby('id_acuerdo','MUNICIPIOS.NOM_DPTO ','MUNICIPIOS.NOM_MPIO','fechafirma')
			->orderby('id_acuerdo','desc')
			->orderby('depto','asc')
			->orderby('mpio','asc')
			->get();

		
		return View::make('modulodaild/acuerdoscolectivos',array('arraydaild' => $arraydaild));
	}

	public function postDaildConsulta()
	{
		

		$arraydaild = DB::table('MODART_DAILD_ACUERDOSCOLEC')	
			->select('id_acuerdo', DB::raw("concat(DATENAME(weekday, fechafirma),','  ,DATENAME(day, fechafirma),' de ',DATENAME(month, fechafirma),' de ',DATENAME(year, fechafirma)) as fecha,  MUNICIPIOS.NOM_DPTO AS depto,MUNICIPIOS.NOM_MPIO AS mpio,nucleoterritorial,veredadaild,familias,hectareas"))
			->join('MUNICIPIOS','MUNICIPIOS.COD_DANE','=','MODART_DAILD_ACUERDOSCOLEC.mpio')
			->where('id_acuerdo','=',Input::get('acuerdo'))
			->orderby('nucleoterritorial','asc')
			->orderby('veredadaild','asc')
			->get();

		
		return array('arraydaildconsul' => $arraydaild);
	}

	
}
?>