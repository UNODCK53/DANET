<?php

class gizController extends BaseController {
	public function DistribGIZdepartamental()
	{	
		//consulta para retornar la distribucion departameNTAL
		$dptos= DB::select("SELECT [NOM_REGION],[NOM_DPTO],  FLOOR(sum([Bosque_05])) as Bosque_05,FLOOR(sum([Defo_05_14])) as Defo_05_14,FLOOR(sum([Degra_05_14])) as Degra_05_14,FLOOR(sum([Afec_05_14])) as Afec_05_14, cast(ROUND(max(Tasa_depto_05_14),2) as numeric(36,2)) as Tasa_05_14, FLOOR(sum([Defo_asoc_05_14])) as Defo_asoc_05_14  FROM [DABASE].[sde].[MUNICIPIOS_GIZ] group by NOM_REGION, NOM_DPTO order by NOM_REGION");

		$mpios= DB::select("SELECT [NOM_REGION],[NOM_DPTO],[NOM_MPIO],FLOOR([Bosque_05]) as Bosque_05,FLOOR([Defo_05_14]) as Defo_05_14,FLOOR([Degra_05_14]) as Degra_05_14,FLOOR([Afec_05_14]) as Afec_05_14,CAST(ROUND([Tasa_05_14],2) as numeric(36,2)) as Tasa_05_14,FLOOR([Defo_asoc_05_14]) as Defo_asoc_05_14  FROM [DABASE].[sde].[MUNICIPIOS_GIZ] order by NOM_REGION, NOM_DPTO");

		$parques= DB::select("SELECT [NOM_PNN], FLOOR([Defo_05_14]) as Defo_05_14,FLOOR([Degra_05_14]) as Degra_05_14,FLOOR([Afec_05_14]) as Afec_05_14 FROM [DABASE].[sde].[PNN_GIZ]");

		$resguardos= DB::select("SELECT [NOM_RI],[NOM_ETNIA], FLOOR([Defo_05_14]) as Defo_05_14,FLOOR([Degra_05_14]) as Degra_05_14,FLOOR([Afec_05_14]) as Afec_05_14 FROM [DABASE].[sde].[RESGUARDOS_GIZ]");
		
		$arreglo=array($dptos, $mpios, $parques, $resguardos);		
		return View::make('access_outside.giz.gizdatrelev', array('Datos_arreglo' => $arreglo));
		//return $dptos;
	}

	public function mapGIZ()
	{	
		//consulta para retornar la distribucion departameNTAL
		$dptos= DB::select("SELECT [NOM_DPTO] FROM [DABASE].[sde].[MUNICIPIOS_GIZ] group by NOM_DPTO order by NOM_DPTO");

		$array = array_add($dptos, '5', ['NOM_DPTO' => 'Todos']);
		//return $array;
		$arreglo=array($dptos,$array);

		return View::make('access_outside.giz.gizvisor', array('Datos_arreglo' => $arreglo));
		//return $dptos;
	}
}
?>
