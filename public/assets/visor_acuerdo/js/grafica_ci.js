	var grafica2 = L.control({position: 'topright'});
	grafica2.onAdd = function (map) {
			this._div = L.DomUtil.create('div', 'graficamuni');
			this.update();
			this._div.id="grafica2";
			return this._div;
		};
		
		grafica2.update = function (props) {
		
		//desde aquí
		
			var options = {
			
				chart: {
					renderTo: 'grafica2',		
					type: 'column',
					backgroundColor:  'rgba(255, 255, 255, 0.1)',
					spacingBottom: 1 
				},
				title: {
					text: 'Histórico Cultivos Ilícitos'
				},
				subtitle: {
					
				},
				xAxis: {
					//categories: ['2013', '2012', '2011', '2010', '2009','2008','2007'],
					//categories: ['2007', '2008', '2009', '2010', '2011','2012','2013'],
					type: 'category',
					title: {
						text: 'Censo',
						align: 'high'
					},
					labels: {
						style: {
							fontSize: '10px'
						}
					}
				},
				yAxis: {
					min: 0,
					//max: 100000,
					title: {
						text: 'Área (hectáreas)',
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
					valueSuffix: ' hectáreas'
				},
				plotOptions: {
					column: {
                    dataLabels: {
                        enabled: false						
                    },
					color: '#CCCCCC'
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
				series: [{},{}],
									
			};					
			
			if (typeof(props) != "undefined"){
				X=[{name: '2006', y: parseInt(props.C_2006)},{name: '2007', y: parseInt(props.C_2007)},{name: '2008', y: props.C_2008},{name: '2009', y: props.C_2009},{name: '2010', y: props.C_2010},{name: '2011', y: props.C_2011},{name: '2012', y: props.C_2012},{name: '2013', y: props.C_2013},{name: '2014', y: props.C_2014}]
				Y=props.NOM_MPIO + ", " +props.NOM_DPTO
				
				Z=[0,parseInt(props.GME_2007),parseInt(props.GME_2008),parseInt(props.GME_2009),parseInt(props.GME_2010),parseInt(props.GME_2011),parseInt(props.GME_2012),parseInt(props.GME_2013),parseInt(props.GME_2014)]
				
				W=[props.C_2007,props.C_2008,props.C_2009,props.C_2010,props.C_2011,props.C_2012,props.C_2013]
				T=[props.GME_2007,props.GME_2008,props.GME_2009,props.GME_2010,props.GME_2011,props.GME_2012,props.GME_2013,props.GME_2014]
				
			//console.log(drill);
			}
			else{
			//console.log("Hola mundo");	
			X=[{name: '2006', y: 77870},{name: '2007', y: 98899},{name: '2008', y: 80953},{name: '2009', y: 68027},{name: '2010', y: 61815},{name: '2011', y: 63764},{name: '2012', y: 47788},{name: '2013', y: 48189},{name: '2014', y: 69132},,{name: '2015', y: ""}]
			Y="Nacional"
			Z=[0,50583,84034,48899,30667,25141,14529,10344,6099,5254]


			W=[0]
			T=[0]
			//drill=["a"]
			//console.log(drill);
			}
						
			$(function (){
				datos(X,Y,Z,W,T);				
				var chart = new Highcharts.Chart(options);
			});
		
			function datos(a,b,c,d,e){
				
				var S1datos = a
				var S1name= "Censo SIMCI"
				var S2name= "Erradicación Manual Forzosa"
				var S2datos = c
				var S2Type = 'line'
				var S2Color = 'rgb(0,150,0)'
				var de= d.concat(e);
				var maximo=Math.max.apply(null,de);
				var maximo=1000;
				//var drilldo=f;
				//console.log(drilldo);
				options.subtitle.text = b;
				//options.yAxis.max = maximo;
				options.series[0].name = S1name;
				options.series[1].name = S2name;
				options.series[0].data = S1datos;
				options.series[1].data = S2datos;
				options.series[1].type = S2Type;
				options.series[1].color = S2Color;
				//options.drilldown.series = drilldo;
		};

		};

		grafica2.addTo(map);	