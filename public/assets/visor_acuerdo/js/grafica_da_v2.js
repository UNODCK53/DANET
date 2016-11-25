grafica_da.update = function (props) {
		
		//desde aquí
	var options = {
	
		chart: {
			renderTo: 'grafica_da',		
			type: 'column',
			height: 290,
			width: 295,
			spacingLeft: 0,
			spacingRight: 15,
			spacingBottom: 30,
			backgroundColor:  'rgba(255, 255, 255, 0.1)',
			spacingBottom: 1,
			align: 'center' 
			
		},
		title: {
			text: ''
		},
		subtitle: {
			
		},
		xAxis: {
			//categories: ['2013', '2012', '2011', '2010', '2009','2008','2007'],
			//categories: ['2007', '2008', '2009', '2010', '2011','2012','2013'],
			type: 'category',
			title: {
				text: 'Año',
				align: 'high'
			},
			labels: {
				style: {
					fontSize: '9px'
				}
			}
		},
		yAxis: {
			min: 0,
			//max: 100000,
			title: {
				text: 'Número de veredas',
				align: 'high'
			},
			labels: {
				overflow: 'justify',
				style: {
					fontSize: '10px'
				}
			}
		},
		tooltip: {
			valueSuffix: ' veredas'
		},
		plotOptions: {
			column: {
            dataLabels: {
                enabled: false						
            },
			color: '#99bbff'
			},
			bar: {
				dataLabels: {
					enabled: true						
				},
				color: '#CCCCCC'
			}
		},
		legend: {
			enabled: true,
			itemStyle: {
				color: '#000000',
				fontWeight: 'bold',
				fontSize: '10px'
			},
			//align: 'bottom',
			//verticalAlign: 'bottom',
			x: -17,
			y: -4,
			floating: true,
			symbolPadding: 2,
			symbolWidth: 5
			
			
		},
		credits: {
			enabled: false
		},
		series: [{}],
							
	};					
			
	if (typeof(props) != "undefined"){
		XX=[{name: '2006', y: parseInt(props.DA_2006)},{name: '2007', y: parseInt(props.DA_2007)},{name: '2008', y: props.DA_2008},{name: '2009', y: props.DA_2009},{name: '2010', y: props.DA_2010},{name: '2011', y: props.DA_2011},{name: '2012', y: props.DA_2012},{name: '2013', y: props.DA_2013},{name: '2014', y: props.DA_2014}]
		YY=props.NOM_MPIO + ", " +props.NOM_DPTO
		
		//Z=[0,parseInt(props.GME_2007),parseInt(props.GME_2008),parseInt(props.GME_2009),parseInt(props.GME_2010),parseInt(props.GME_2011),parseInt(props.GME_2012),parseInt(props.GME_2013)]
		
		WW=[props.DA_2007,props.DA_2008,props.DA_2009,props.DA_2010,props.DA_2011,props.DA_2012,props.DA_2013]
		//T=[props.GME_2007,props.GME_2008,props.GME_2009,props.GME_2010,props.GME_2011,props.GME_2012,props.GME_2013]
		
	//console.log(drill);
	}
	else{
	//console.log("Hola mundo");	
	XX=[0,0,0,0,0,0,0,0,0]
	YY="Seleccione un municipio"
	//Z=["a",0,0,0,0,0,0]
	WW=[0]
	//T=[0]
	//drill=["a"]
	//console.log(drill);
	}
						
	datos(XX,YY,WW);
	function datos(a,b,d){		
		var S1datos = a
		var S1name= "Veredas de desarrollo alternativo"
		//options.subtitle.text = b;		
		options.series[0].name = S1name;		
		options.series[0].data = S1datos;
	};

	var chart = new Highcharts.Chart(options);	



};