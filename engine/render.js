		function render() {   

				var delta = clock.getDelta();
				//Providence.rotation.y += 0.1 * delta;
				tuboMesh.rotation.y += 0.1 * delta;
				tuboMesh.rotation.x += 0.1 * delta;
				tuboMesh.rotation.z += 0.5 * delta;

				meshPlanet.rotation.y += 0.02 * delta;
				meshClouds.rotation.y += 5 * 0.02 * delta;
				stars.rotation.y += 15 * delta;

				var velocidadUiaumentandose = parseInt(controlsnave.moveState.left*100);
				var velocidadUireduciendose = parseInt(controlsnave.moveState.right*100);
				var velocidadReal = velocidadUiaumentandose - velocidadUireduciendose;

				$("div.bar#barravelocidad").css("width", velocidadReal);
				$("div.bar#barracombustible").css("width", Math.round( combustible* 10 ) / 10);

				$("#combustibleReal").html(Math.round( combustible* 10 ) / 10);

				$("div.bar#barrablindaje").css("width", 100);
				$("div.bar#barraescudos").css("width", 100);

				$("#velocidadReal").html(velocidadReal);
				particles.scale.x = velocidadReal/900000;
				particles.scale.z = velocidadReal/90000000;
				particles.position.x = 15+velocidadReal/90000;
				particles.rotation.x = 0.9+velocidadReal/1000;
				


				/*var objetos = function(id, tipoObjeto, nombreObjeto, alineacion, posicionX, posicionY, posicionZ, icono){
					var idObjeto = id; // 0
					var tipoObjeto = tipoObjeto; // planeta
					var nombreObjeto = nombreObjeto; // tierra
					var alineacion = alineacion; // neutral
					var posicionX = posicionX; // 0
					var posicionY = posicionY; // 0
					var posicionZ = posicionZ; // 0
					var icono = icono; // planeta

					var distanciaObjetos = function(){
						var distancia = 
						var elevarX =
						var elevarY =
						var elevarZ =
						var resultadoDistancia =
						var resultadoUI =
						$(resultadoUI).html(parseInt(resultadoDistancia/1000)+"K.");
					}
				}*/

				var distanciaTierra = 6370/2;
				var elevarXplanet = Math.pow(meshPlanet.position.x-nave.position.x,2);
				var elevarYplanet = Math.pow(meshPlanet.position.y-nave.position.y,2);
				var elevarZplanet = Math.pow(meshPlanet.position.z-nave.position.z,2);
				this.distanciaPlaneta = Math.sqrt(elevarXplanet+elevarYplanet+elevarZplanet-distanciaTierra);
				$("#distanciaPlaneta").html(parseInt(distanciaPlaneta/1000)+"K.");

				var distanciaMoon = 1737/2;
				var elevarXmoon = Math.pow(meshMoon.position.x-nave.position.x,2);
				var elevarYmoon = Math.pow(meshMoon.position.y-nave.position.y,2);
				var elevarZmoon = Math.pow(meshMoon.position.z-nave.position.z,2);
				var resultadoDistanciaMoon = Math.sqrt(elevarXmoon+elevarYmoon+elevarZmoon-distanciaMoon);
				$("#distanciaMoon").html(parseInt(resultadoDistanciaMoon/1000)+"K.");
				
				/*var distanciaNave = 0;
				var elevarXnave = Math.pow(Providence.position.x-nave.position.x,2);
				var elevarYnave = Math.pow(Providence.position.y-nave.position.y,2);
				var elevarZnave = Math.pow(Providence.position.z-nave.position.z,2);
				var resultadoDistanciaNave = Math.sqrt(elevarXnave+elevarYnave+elevarZnave-distanciaNave);
				$("#distanciaNave").html(parseInt(resultadoDistanciaNave/1000)+"K.");*/

				this.posicionXnave = nave.position.x;
				this.posicionYnave = nave.position.y;
				this.posicionZnave = nave.position.z;
				$("#posicion").html("<br>x:"+parseInt(posicionXnave)+"<br>y:"+parseInt(posicionYnave)+"<br>z:"+parseInt(posicionZnave));

                                if(velocidadReal >= 250){
                                    controlsnave.moveState.left = 2.50;
                                };

                                if(velocidadReal <= -10){
                                	controlsnave.moveState.left = 0;
                                    controlsnave.moveState.right = 0.10;
                                };

                                if(controlsnave.movementSpeedMultiplier == 1){ 
                                    controlsnave.moveState.left = 5; 
                                };


				/*$("#botonoculus").click(function(){
					effect.render( scene, camera );
				});*/

				TWEEN.update( );
				cameraControls.update( delta ); 
				controlsnave.update(  delta );
				composer.render( delta );

		}