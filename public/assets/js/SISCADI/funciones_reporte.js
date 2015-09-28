		
				function borrar(x){
					
					if	(x.id == "intervencion"){// condicional que borra los valores en el formulario de mision
						document.getElementById("mision").value="";
						document.getElementById("cod_depto").value="";
						document.getElementById("cod_dane").value="";
					}else if(x.id=="mision"){
						document.getElementById("cod_depto").value="";
						document.getElementById("cod_dane").value="";						
					}else if(x.id=="cod_depto"){
						document.getElementById("cod_dane").value="";	
					}else if(x.id=="intervencion_gen"){
						document.getElementById("mision_gen").value="";	
					}
					
					if	(x.id == "intervencion_moni"){// condicional que borra los valores en el formulario de monitor
						document.getElementById("mision_moni").value="";
						document.getElementById("cod_depto_moni").value="";
						document.getElementById("cod_dane_moni").value="";
					}else if(x.id=="mision_moni"){
						document.getElementById("cod_depto_moni").value="";
						document.getElementById("cod_dane_moni").value="";						
					}else if(x.id=="cod_depto"){
						document.getElementById("cod_dane_moni").value="";	
					}else if(x.id=="intervencion_gen_moni"){
						document.getElementById("mision_gen_moni").value="";	
					}
					
					
				}
				
				function change(){
					if	(document.getElementById("cod_depto").value!="" && document.getElementById("cod_dane").value!=""){
						document.getElementById("formulairo").disabled = false;
					}
					
					if	(document.getElementById("cod_depto_moni").value!="" && document.getElementById("cod_dane_moni").value!=""){
						document.getElementById("formulairo_moni").disabled = false;
					}
				}				
				
				function depto(){
				
					var inter = document.getElementById("intervencion").value
					var mision=document.getElementById("mision").value;
					var piloto = document.querySelector('input[name="Piloto"]:checked').value;
					var monitor="";
					if(inter!="" && mision!=""){
					
						document.getElementById("cod_depto").disabled = false;	
						document.getElementById("cod_dane").disabled = true;
						datadepto='inter='+ inter + '&mision='+mision+'&piloto='+piloto+'&monitor='+monitor;
						$.ajax({
										data:  datadepto,
										url:   'depto',
										type:  'post',

										success:  function (data) {
											$('#cod_depto').html("");
											$('#cod_depto').html("<option value=''>Seleccione uno </option>");
											for (datas in data) {
												$('#cod_depto').append("<option value='"+ data[datas]['cod_depto'] +"'>" + data[datas]['nom_depto'] + "</option>")
											};
										}
						});

					}
				}
				function depto_moni(){
				
					var inter = document.getElementById("intervencion_moni").value
					var mision=document.getElementById("mision_moni").value;
					var piloto = document.querySelector('input[name="Piloto_moni"]:checked').value;
					var monitor=document.getElementById("monitor").value;
					if(inter!="" && mision!="" && monitor!=""){
					
						document.getElementById("cod_depto_moni").disabled = false;	
						document.getElementById("cod_dane_moni").disabled = true;
						datadepto='inter='+ inter + '&mision='+mision+'&piloto='+piloto+'&monitor='+monitor;
						$.ajax({
										data:  datadepto,
										url:   'depto',
										type:  'post',

										success:  function (data) {
											$('#cod_depto_moni').html("");
											$('#cod_depto_moni').html("<option value=''>Seleccione uno </option>");
											for (datas in data) {
												$('#cod_depto_moni').append("<option value='"+ data[datas]['cod_depto'] +"'>" + data[datas]['nom_depto'] + "</option>")
											};
										}
						});

					}
				}
				
					function muni(){
					
					
					var inter = document.getElementById("intervencion").value
					var mision=document.getElementById("mision").value;
					var piloto = document.querySelector('input[name="Piloto"]:checked').value;
					var monitor="";
					datamuni='inter='+ inter + '&mision='+mision+'&id='+ $("#cod_depto").val()+'&piloto='+piloto+'&monitor='+monitor;
					$.ajax({
						type: "post",
						url: "muni", 
						data: datamuni,
						success: function(data)
						{

							$('#cod_dane').html("");
							$('#cod_dane').html("<option value=''>Seleccione uno </option>");
							for (datas in data) {
								
								$('#cod_dane').append("<option value='"+ data[datas]['cod_dane'] +"'>" + data[datas]['nom_muni'] + "</option>")
							};
							document.getElementById("cod_dane").disabled = false;
						} 
						
					});
				}	
				
				function muni_moni(){
					
					document.getElementById("cod_dane_moni").disabled = false;
					var inter = document.getElementById("intervencion_moni").value
					var mision=document.getElementById("mision_moni").value;
					var piloto = document.querySelector('input[name="Piloto_moni"]:checked').value;
					var monitor=document.getElementById("monitor").value;
					datamuni='inter='+ inter + '&mision='+mision+'&id='+ $("#cod_depto_moni").val()+'&piloto='+piloto+'&monitor='+monitor;
					$.ajax({
						type: "post",
						url: "muni", 
						data: datamuni,
						success: function(data)
						{
							$('#cod_dane_moni').html("");
							$('#cod_dane_moni').html("<option value=''>Seleccione uno </option>");
							for (datas in data) {
								
								$('#cod_dane_moni').append("<option value='"+ data[datas]['cod_dane'] +"'>" + data[datas]['nom_muni'] + "</option>")
							};
							document.getElementById("cod_dane_moni").disabled = false;
						} 
						
					});
				}
				
				function general(){
					if	(document.getElementById("intervencion_gen").value!="" && document.getElementById("mision_gen").value!=""){
						document.getElementById("formulairo_gen").disabled = false;
					}
				}
				
				function monitores(){
				
					var inter = document.getElementById("intervencion_moni").value
					var mision=document.getElementById("mision_moni").value;
					var piloto = document.querySelector('input[name="Piloto_moni"]:checked').value;
					if(inter!="" && mision!=""){
					
						document.getElementById("monitor").disabled = false;
						document.getElementById("cod_depto_moni").disabled = true;
						document.getElementById("cod_dane_moni").disabled = true;	
						datadepto='inter='+ inter + '&mision='+mision+'&piloto='+piloto;
						$.ajax({
										data:  datadepto,
										url:   'monit',
										type:  'post',

										success:  function (data) {
											$('#monitor').html("");
											$('#monitor').html("<option value=''>Seleccione uno </option>");
											for (datas in data) {
												$('#monitor').append("<option value='"+ data[datas]['cod_moni'] +"'>" + data[datas]['nom_moni'] + "</option>")
											};
										}
						});

					}
				}
				
				