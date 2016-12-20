resguardos.update = function (props) {      
    //desde aquí
    var x=$('#container').width()
    if (x==0){
        x=$('#container2').width()
    }
    if(x==0){
        x=$('#container3').width()
    }    
    var options = {    
        chart: {
            renderTo: 'container4',     
            type: 'column',
            width: x,
            backgroundColor:  'rgba(255, 255, 255, 0.1)',
            
        },
        title: {
            text: 'Resguardos con mayor afectación del bosque por cultivos de coca',
            style: {
                fontSize: '14px'
            }
        },
        subtitle: {
            
        },
        xAxis: {
            //categories: ['Putumayo', 'Guaviare', 'Norde de Santander', 'Meta', 'Caquetá'],
            type: 'category',
            title: {
                text: '',
                //align: 'high'
            },
            labels: {
                style: {
                    fontSize: '12px'
                }
            }
        },
        yAxis: [{
            min: 0,
            //max: 100000,
            title: {
                text: 'Héctareas con Bosque 2005'
                
            },
            labels: {
                overflow: 'justify',
                style: {
                    fontSize: '10px'
                }
            }
        },
        {
            opposite: true,
            title: {
                text: 'Afectación por coca (Ha)',
                style:{
                    color: 'rgb(200,55,53)',
                }                         
            },
            labels: {
                style: {
                    color: 'rgb(200,55,53)',                    
                }
            }
        }],
        tooltip: {
            valueSuffix: ' Hectáreas'
        },
        plotOptions: {

            column: {
            stacking: 'normal',   
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
            //temMarginTop: 0,
            //floating: true,
            enabled: true,
            //margin: 15,
            //y : -3,
            itemStyle: {
                color: '#000000',
                fontWeight: 'bold',
                fontSize: '12px'
            },
            //align: 'bottom',
            //verticalAlign: 'bottom',
            
        },
        credits: {
            enabled: false
        },
        series: [{},{},{}]
                            
    };             
       
            
    name_s1 = 'Degradación 2005-2014'
    name_s2 = 'Deforestación 2005-2014'
    name_s3 = 'Bosque 2005'
    categories_1= ['NUKAK - MAKU', 'MORICHAL VIEJO, SANTA ROSA, CERRO CUCUY, SANTA CRUZ, CAÑO DANTA- OTROS', 'LAGOS DEL DORADO, LAGOS DEL PASO Y EL REMANSO', 'MOTILÓN - BARÍ', 'PREDIO PUTUMAYO','JERUSALÉN-SAN LUIS ALTO PICUDITO','VILLA CATALINA-DE PUERTO ROSARIO','LA YUQUERA','EL HACHA','BUENAVISTA']
    data_s1 = [830,181,73,121,81,96,50,44,50,45]
    data_s2 = [408,141,107,43,50,33,65,48,24,17]
    data_s3 = [937890,652058,30415,97093,250341,3541,63303,6236,5027,4207] 

    datos(name_s1,data_s1,name_s2,data_s2,name_s3,data_s3,categories_1);
    function datos(a,b,c,d,e,f,g){ 
        var S1name  = a       
        var S1datos = b
        var S2name  = c       
        var S2datos = d
        var S3name  = e       
        var S3datos = f
        var S3Type = 'line'
        var S1Color = 'rgb(230,185,184)'
        var S2Color = 'rgb(149,55,53)'
        //options.subtitle.text = b;        
        options.series[0].name = S1name;        
        options.series[0].data = S1datos;
        options.series[0].type = 'column';
        options.series[0].yAxis = 1;
        options.series[1].data = S2datos;
        options.series[1].name = S2name;
        options.series[1].type = 'column';
        options.series[1].yAxis = 1;
        options.series[2].data = S3datos;
        options.series[2].name = S3name;
        options.series[2].type = S3Type;        
        options.series[0].color = S1Color;
        options.series[1].color = S2Color;
        options.series[2].color = "Black"; 
        options.xAxis.categories=g;
    };
    return options;
};