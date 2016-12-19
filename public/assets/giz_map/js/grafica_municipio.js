municipio.update = function (props) {      
    //desde aquí
    var options = {
    
        chart: {
            renderTo: 'container2',     
            type: 'column',

            spacingLeft: 0,
            spacingRight: 15,
            spacingBottom: 40,
            backgroundColor:  'rgba(255, 255, 255, 0.1)',
            spacingBottom: 3,
            align: 'center' 
            
        },
        title: {
            text: 'Municipios con mayor afectación del bosque por cultivos de coca',
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
                    fontSize: '11px'
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
                text: 'Héctareas con afectación por coca'         
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
    
    var input=$('#departamento_select').val()
    
    categories_1= ['', '', '', '', '','','','','']
    if (input=='Caquetá'){
        categories_1= ['Cartagena del Chairá', 'Solano', 'San Vicente del Caguán', 'Montañita', 'San José del Fragua','Puerto Rico','Curillo','Belén de los Andaquíes','Milán','El Paujil']
        data_s1 = [886, 594, 173, 163, 272,119,119,125,69,33]
        data_s2 = [1338,951,544,400,148,105,75,64,106,39]
        data_s3 = [1031541,3903898,1321750,39302,71722,202381,11482,57360,26301,33063]         
    } else if(input=='Guaviare'){
        categories_1= ['San José del Guaviare', 'El Retorno', 'Miraflores', 'Calamar']
        data_s1 = [3414,2541,993,959]
        data_s2 = [1717,1400,1233,580]
        data_s3 = [1383762,1088690,1190936,1316708]
    } else if(input=='Meta'){
        categories_1= ['Puerto Rico', 'La Macarena', 'Vistahermosa', 'Mapiripán','Puerto Concordia','Uribe','Mesetas']
        data_s1 = [1684,303,672,466,148,127,35]
        data_s2 = [1053,1042,642,514,81,80,24]
        data_s3 = [196273,595510,310274,523316,15340,331666,118805]
    } else if(input=='Norte De Santander'){
        categories_1= ['Tibú', 'Sardinata', 'Teorama', 'El Tarra','El Carmen','Convención','La Esperanza','Cáchira','San Calixto','El Zulia']
        data_s1 = [4218,1059,576,478,215,204,99,100,52,33]
        data_s2 = [1149,264,245,206,140,133,16,13,22,5]
        data_s3 = [146786,69182,59317,30282,105320,62113,16332,23437,14580,9266]
    } else if(input=='Putumayo'){
        categories_1= ['Puerto Asís', 'Puerto Leguízamo', 'Orito', 'Puerto Guzmán','Puerto Caicedo','Villagarzón','Valle del Guamuez','San Miguel','Mocoa']
        data_s1 = [2213,1493,1496,1182,1190,1109,641,157,87]
        data_s2 = [1390,1093,601,821,618,354,262,159,25]
        data_s3 = [180111,957789,119140,327232,54405,89235,22117,8300,95989]
    } else if(input=='Todos'){
        categories_1= ['Tibú, NS', 'San José del Guaviare, GU', 'El Retorno, GU', 'Puerto Asís, PU','Puerto Rico, ME','Puerto Leguízamo, PU','Miraflores, GU','Cartagena del Chairá, CA','Orito, PU','Puerto Guzmán, PU']
        data_s1 = [4128,3414,2541,2213,1684,1493,993,886,1496,1182]
        data_s2 = [1149,1717,1400,1390,1053,1093,1233,1338,601,821]
        data_s3 = [146786,1383762,1088690,180111,196273,957789,1190936,1031541,119140,327232]
    }   

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