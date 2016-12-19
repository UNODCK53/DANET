grafica_ci.update = function (props) {		
		//desde aquí
	var options = {
	
		chart: {
			renderTo: 'grafica_ci',		
			type: 'column',
			height: 310,
			width: 295,
			spacingLeft: 0,
			spacingRight: 15,
			spacingBottom: 40,
			backgroundColor:  'rgba(255, 255, 255, 0.1)',
			spacingBottom: 3,
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
					fontSize: '8px'
				}
			}
		},
		yAxis: {
			min: 0,
			//max: 100000,
			title: {
				text: 'Hectáreas',
				align: 'high'
			},
			labels: {
				overflow: 'justify',
				style: {
					fontSize: '9px'
				}
			}
		},
		tooltip: {
			valueSuffix: ' Hectáreas'
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
			temMarginTop: 0,
			floating: true,
			enabled: true,
			margin: 15,
			
			y : -3,
			itemStyle: {
				color: '#000000',
				fontWeight: 'bold',
				fontSize: '9px'
			},
			//align: 'bottom',
			//verticalAlign: 'bottom',
			
			symbolPadding: 2,
			symbolWidth: 5
			
			
		},
		credits: {
			enabled: false
		},
		series: [{},{}],
							
	};					
			
	if (typeof(props) != "undefined"){
		XX=[{name: '2006', y: parseInt(props.C_2006)},{name: '2007', y: parseInt(props.C_2007)},{name: '2008', y: props.C_2008},{name: '2009', y: props.C_2009},{name: '2010', y: props.C_2010},{name: '2011', y: props.C_2011},{name: '2012', y: props.C_2012},{name: '2013', y: props.C_2013},{name: '2014', y: props.C_2014},{name: '2015', y: props.C_2015}]
		YY=props.NOM_MPIO + ", " +props.NOM_DPTO
		
		Z=[0,parseInt(props.GME_2007),parseInt(props.GME_2008),parseInt(props.GME_2009),parseInt(props.GME_2010),parseInt(props.GME_2011),parseInt(props.GME_2012),parseInt(props.GME_2013),parseInt(props.GME_2014),parseInt(props.GME_2015)]
		
		WW=[props.C_2007,props.C_2008,props.C_2009,props.C_2010,props.C_2011,props.C_2012,props.C_2013,props.C_2014,,props.C_2015]
		//T=[props.GME_2007,props.GME_2008,props.GME_2009,props.GME_2010,props.GME_2011,props.GME_2012,props.GME_2013]
		
	//console.log(drill);
	}
	else{
	//console.log("Hola mundo");	
	XX=[0,0,0,0,0,0,0,0,0,0]
	YY="Seleccione un municipio"
	Z=["a",0,0,0,0,0,0,0,0]
	WW=[0]
	//T=[0]
	//drill=["a"]
	//console.log(drill);
	}
						
	datos(XX,YY,WW,Z);
	function datos(a,b,d,c){		
		var S1datos = a
		var S2datos = c
		var S2Type = 'line'
		var S2Color = 'rgb(0,150,0)'
		var S2name= "Erradicación GME"
		var S1name= "Censo SIMCI"
		//options.subtitle.text = b;		
		options.series[0].name = S1name;		
		options.series[0].data = S1datos;
		options.series[1].data = S2datos;
		options.series[1].type = S2Type;
		options.series[1].color = S2Color;
		options.series[1].name = S2name;
	};

	var chart = new Highcharts.Chart(options);	
	


};