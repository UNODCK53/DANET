parques.update = function (props) {      
    //desde aquí
    var options = {
    
        chart: {
            renderTo: 'container3',     
            type: 'column',

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
                text: 'Héctareas con afectación por coca '         
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
    
 
    categories_1= ['Sierra de la Macarena', 'Nukak', 'La Paya', 'Catatumbo - Barí', 'Tinigua','Alto Fragua - Indiwasi','Plantas Medicinales Orito Ingi Ande','Cordillera de los Picachos','Serranía de Chibiriquete','Serranía de los Churumbelos','Los Estoraques']
    data_s1 = [1415,967,477,334,62,20,8,5,2,0,0]
    data_s2 = [1364,684,462,129,243,9,2,0,1,0,0]
    data_s3 = [533310,845303,429348,140547,191223,59243,8850,237333,2604885,21,5749] 

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