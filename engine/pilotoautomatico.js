			function acercarse(id, irx, iry, irz){

					if(id == "0"){ //introducir coordenadas
						idx = irx;
						idy = iry;
						idz = irz;
					}
					if(id == "1"){ //Coordenadas planeta
						idx = -10000/3;
						idy = 0;
						idz = 10000;
					};
					if(id == "2"){ //Coordenadas satelite
						idx = -384400/3.1;
						idy = 0;
						idz = 0;
					};
					if(id == "3"){ //Coordenadas providence
						idx = -1000/1.1;
						idy = 0;
						idz = 0; 
					}
					
					var elevarXtotal = Math.pow(idx-nave.position.x,2);
					var elevarYtotal = Math.pow(idy-nave.position.y,2);
					var elevarZtotal = Math.pow(idz-nave.position.z,2);
					var resultadoDistanciaTotal = Math.sqrt(elevarXtotal+elevarYtotal+elevarZtotal);
					var tiempoViaje = resultadoDistanciaTotal/2000;
						//35000km = consume 100% combustible
						//1km = consutme 0,003%
					var consumoTotal = resultadoDistanciaTotal * 0.003;

					$("span#consumoViaje").html("<span class='icon-tint icon-white'></span>Consumo de combustible: <span style='color:red'>-"+parseInt(consumoTotal)+"%</span>");

					this.restarViaje = function(){
								tiempoViaje -= 1
								$("span#duracionDelViaje").html("<span class='icon-time icon-white'></span>Duración del viaje: <span style='color:#0CF'>"+parseInt(tiempoViaje)+"</span> seg.");
							if(tiempoViaje <= 0 || combustible <= 5){
								clearInterval(refrescarTiempoViaje);
								$("span#duracionDelViaje").html("");
								$("span#consumoViaje").html("");

							}
					}
							
					if(tiempoViaje >= 0 ){
						this.refrescarTiempoViaje = setInterval(restarViaje, 1000);

					}

					if(consumoTotal <= 999){
					this.pilotoautomatico = new TWEEN.Tween( nave.position )
						.to( { x: idx, y: idy, z: idz }, tiempoViaje*1000 )
						//TWEEN.Easing.Elastic.InOut
						.easing( TWEEN.Easing.Exponential.Out )
						.onUpdate( function () {

	           				$( "div#pilotoAutomatico" ).show("fade", function() {
	      						$( this ).hide("fade");
							});

							if(combustible <= 1){ 
								pilotoautomatico.stop();
								pilotoautomatico.stop();
								pilotoautomatico.stop();
								controlsnave.moveState.right = 0;
								controlsnave.moveState.left = 0;
							$("div#sincombustible").show();
							$("div#sincombustibleayuda")
								.show("fold")
								.html("<button id='cerrarCombustible' class='close'>&times;</button>No tienes suficiente combustible, el piloto automático se ha desactivado.");
							
							$("button#cerrarCombustible").click(function(){
								$("div#sincombustibleayuda").hide();
	 						});

							}

							combustible -= 0.02;
							velocidadReal = 250;

							$("#velocidadReal").html(velocidadReal);
							$("div.bar#barravelocidad").css("width", velocidadReal);
							$( "div#sincombustible" ).hide();

           				})
						.start();				
					}
			}


					/*var numPoints = 2;
					this.spline = new THREE.SplineCurve3([
				  	 	new THREE.Vector3( nave.position.x,nave.position.y,nave.position.z ),
				   		new THREE.Vector3( idx,idy,idz ),
					]);
				
					var material = new THREE.LineBasicMaterial({
						color: 0xff00f0,
					});
					
					var geometry = new THREE.Geometry();
					var splinePoints = spline.getPoints( numPoints );
					
					for( var i = 0; i < splinePoints.length; i++ ){
						geometry.vertices.push( splinePoints[i] );  
					}
					
					var line = new THREE.Line( geometry, material );
					scene.add( line );*/