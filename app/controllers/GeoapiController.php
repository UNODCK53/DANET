<?php

class GeoapiController extends BaseController {
	
	public function __construct()
	{
		$this->beforeFilter('auth');  //bloqueo de acceso
	}
	public function DistribOrganiz()
	{
		//consulta para retornar la distribucion por organizacion

		$distribucion = DB::select("SELECT PP1.id_categoria_ejecutor, MEMOEJEC.organizacion,MEMOEJEC.memorando, PP1.POLY, PP1.PTO, PP1.TOTALPP, PP1.BENEF, (PP1.BENEF-PP1.TOTALPP) as asociados FROM(SELECT PP.id_categoria_ejecutor, SUM(PUNTO) as PTO, SUM(POLIG) as POLY, COUNT(PP.OBJECTID) as TOTALPP, SUM(n_asociado) as BENEF FROM(SELECT [OBJECTID],CONCAT(id_estrate,'_',ejecutor) as id_categoria_ejecutor, SUM(CASE WHEN geometria=1 THEN 1 ELSE 0 END) as PUNTO, SUM(CASE WHEN geometria=2 THEN 1 ELSE 0 END) as POLIG, n_asociado FROM [DABASE].[sde].[PROYECTOS_PRODUCTIVOS] group by OBJECTID, id_estrate, ejecutor, n_asociado) as PP group by PP.id_categoria_ejecutor) AS PP1 JOIN (SELECT EJECUTORES.organizacion, MEMORANDOS.memorando, EJECUTORES.id_categoria_ejecutor FROM EJECUTORES INNER JOIN MEMORANDOS ON EJECUTORES.id_categoria_ejecutor = MEMORANDOS.id_estrategia_ejecutor GROUP BY EJECUTORES.organizacion, MEMORANDOS.memorando, EJECUTORES.id_categoria_ejecutor) as MEMOEJEC ON PP1.id_categoria_ejecutor=MEMOEJEC.id_categoria_ejecutor order by PP1.id_categoria_ejecutor DESC");

		//return $distribucion;

		return View::make('modulogeoapi.repordistorg', array('distribucion' => $distribucion));

	}
	    public function Excelexport()
	{	
		Excel::create('Procesos iniciales',function($excel)
		{
			$excel->sheet('Tierras',function($sheet)
			{
				$data = array();
				$results = DB::select('SELECT DISTINCT id_proceso, vereda, nombrepredio, direccionnotificacion, nombre, cedula, telefono, areaprediopreliminar FROM MODTIERRAS_PROCESOINICIAL WHERE NOT EXISTS (SELECT * FROM MODTIERRAS_PROCESO WHERE MODTIERRAS_PROCESOINICIAL.id_proceso = MODTIERRAS_PROCESO.id_proceso)');
				foreach ($results as $result) {
				$data[] = (array)$result;
				}  	
				$sheet->with($data);
				$sheet->freezeFirstRow();
				$sheet->setAutoFilter();
				$sheet->cells('A1:H1', function($cells) {
			    	$cells->setBackground('#dadae3');
				});
			})->download('xlsx');
		});
    }

}
?>