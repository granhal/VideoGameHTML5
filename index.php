<!doctype html>
<html lang="es-ES">
	<head>
		<meta charset="utf-8">
		<meta name="robots" content="index, follow" />
		<meta name="viewport" content="user-scalable=no, minimum-scale=1.0, maximum-scale=1.0, initial-scale=1.0, user-scalable=no">
		<meta content='Embrion' name='application-name'/>
		<meta content='Embrion MMO GALAXY BROWSER VIDEOGAME HTML5' name='msapplication-tooltip'/>
		<meta content='http://cantely.com/demo/lab3d/' name='msapplication-starturl'/>
		<meta content='black' name='msapplication-navbutton-color'/>
		<meta content='name=HTML5 - Etiqueta Meta;action-uri=http://cantely.com/demo/lab3d/'/>		 
		<meta http-equiv="X-UA-Compatible" content="IE=edge" />
		<meta name="html5" value="notranslate">
		<meta name="description" content="html5 videogame">
		<meta name="Author" content="@granhal">
		<link rel="shortcut icon" href="favicon.ico" />

		<title>embrion mmo galaxy browser video-game html5</title>

<!-- css -->
		<link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
		<link href="css/ui.css" rel="stylesheet" media="screen">

<!-- fonts -->
		<link href='http://fonts.googleapis.com/css?family=Aldrich' rel='stylesheet' type='text/css'>
<!-- js -->
		<script src="js/jquery.min.js"></script>
		<script src="js/jquery-ui.min.js"></script>
		<script src="js/bootstrap.min.js"></script>

		<script src="js/three.min.js"></script>
		
		<script src="js/controls/FlyControls.js"></script>
		<script src="js/controls/OrbitControls.js"></script>

		<script src="js/shaders/CopyShader.js"></script>
		<script src="js/shaders/FilmShader.js"></script>

		<script src="js/postprocessing/EffectComposer.js"></script>
		<script src="js/postprocessing/ShaderPass.js"></script>
		<script src="js/postprocessing/MaskPass.js"></script>
		<script src="js/postprocessing/RenderPass.js"></script>
		<script src="js/postprocessing/FilmPass.js"></script>
		<script src="js/loaders/OBJLoader.js"></script>
		<script src="js/loaders/MTLLoader.js"></script>
		<!--<script src="js/loaders/ColladaLoader.js"></script>
		<script src="js/loaders/AssimpJSONLoader.js"></script>
		<script src="js/effects/OculusRiftEffect.js"></script>-->

		<script src="js/Detector.js"></script>
		<script src="js/libs/stats.min.js"></script>
		<script src="js/libs/tween.min.js"></script>

		<script src="engine/onwindowsresize.js"></script>
		<script src="engine/fragata.js"></script>
		<script src="engine/postprocessing.js"></script>
		<script src="engine/statsinwindows.js"></script>
		<script src="engine/stars.js"></script>
		<script src="engine/moon.js"></script>
		<script src="engine/planet.js"></script>
	</head>
	<body>
		<div id="menuSuperior" class="text-right">
			<img src="logo.png" width="30%" >
		</div>
		<div id="controles" style="font-size:9px;">
			<button class="close" id="cerrarControles">&times;</button>
			<span style="font-size:22px">Controles</span><br> 
			<span style="color:#0CF">A</span>: Girar izquierda<br>
			<span style="color:#0CF">S</span>: Descelerar<br>
			<span style="color:#0CF">D</span>: Girar derecha<br>
			<span style="color:#0CF">W</span>: Acelerar<br> 
			<span style="color:#0CF">Q</span>: Bajar<br>
			<span style="color:#0CF">E</span>: Subir<br> 
			<span style="color:#0CF">Shift</span>: Turbo <br>
			<span style="color:#0CF">Ratón</span>: OrbitCamera <br>
		</div>
		<div id="pilotoAutomatico" style="color:#42ff00">
			<center>Piloto automático activado</center>
		</div>
		<div id="sincombustible" class="sincombustible" style="color:red">
			<center>Sin combustible</center>
		</div>
		<div class="alert alert-error" id="sincombustibleayuda" style="width:18%; z-index:100; position:fixed; top:58%; left:65%;">
		  <button type="button" class="close" data-dismiss="alert">&times;</button>
		  	<h4>Sin combustible</h4>
			Para usar el piloto automático debes tener mínimo 50% de combustible
		</div>
		<div id="velocidad" style="margin: 300px; position:fixed; font-size:10px; line-height:9px; width:160px;">
			<p>Velocidad: <span id="velocidadReal"></span> m/s</p>
			<div class="progress progress-striped active" style="width:150px;">
				<div class="bar" id="barravelocidad" style="width: 100%"></div>
			</div>
			<p>Combustible: <span id="combustibleReal"></span>%</p>
			<div class="progress progress-danger progress-striped active" style="width:100px;">
				<div class="bar" id="barracombustible" style="width: 100%"></div>
			</div>
			<p>Escudos: 100%</p>
			<div class="progress progress-warning progress-striped active" style="width:100px;">
				<div class="bar" id="barraescudos" style="width: 100%"></div>
			</div>
			<p>Blindaje: 100%</p>
			<div class="progress progress-success progress-striped active" style="width:100px;">
				<div class="bar" id="barrablindaje" style="width: 100%"></div>
			</div>			
			<p>Posición: <span id="posicion"></span></p>
		</div>

		<div id="creditos">
			<button class="close" id="cerrarCreditos" >&times;</button>
			<span style="font-size:14px">Créditos</span><br>
			<p class="text-left">Este juego está en desarrollo, estas jugando a una ALFA de prueba, gracias por testear y formar parte de esto.
				v.0.0.207 alfa - más info en: <u><a href="https://github.com/granhal/VideoGameHTML5">Github</a></u></p><br>
				<p class="text-center">
					<a href="http://www.cantelymedia.com" target="_blank"><img src="cantelymedia.jpg" width="30%"></a>&nbsp;&nbsp;&nbsp;
					<a href="http://www.brainside.es" target="_blank"><img src="brainside.jpg" width="20%"></a>
				</p>
		</div>

		<div id="radar" >
			<button class="close" id="cerrarRadar">&times;</button>
			<span style="font-size:14px">Radar</span>
			<table class="table table-condensed" style="font-size:10px;">
			  	<tr>
  				    <td>Target</td>
    				<td>Distancia</td>
    				<td></td>
    				<td>Opciones</td>
    			</tr>
  				<tr>
  				    <td>Tierra</td>
    				<td><span id="distanciaPlaneta"></span> Km.</td>
    				<td><i class="icon-globe icon-white"></i></td>
    				<td>
						<div class="btn-group">
						  <a class="btn dropdown-toggle btn-mini btn-inverse" data-toggle="dropdown" href="#" style="font-size:8px;">Opciones <span class="caret"></span></a>
						  <ul class="dropdown-menu">
						    <li><a href="#" style="font-size:10px;" id="1" alt="1" class="acercarse"><i class="icon-map-marker"></i> Acercarse</a></li>
						    <li><a href="#" style="font-size:10px;" id="atacar"><i class="icon-screenshot"></i> Atacar</a></li>
						    <li><a href="#" style="font-size:10px;" id="minear"><i class="icon-fullscreen"></i> Minear</a></li>
						    <li class="divider"></li>
						    <li><a href="#" style="font-size:10px;"><i class="icon-info-sign"></i> Info</a></li>
						  </ul>
						</div>
					</td>
    			</tr>
    			<tr>
    				<td>Luna</td>
    				<td><span id="distanciaMoon"></span> Km.</td>
    				<td><i class="icon-globe icon-white"></i></td>
    				<td>
    					<div class="btn-group">
						  <a class="btn dropdown-toggle btn-mini btn-inverse" data-toggle="dropdown" href="#" style="font-size:8px;">Opciones <span class="caret"></span></a>
						  <ul class="dropdown-menu">
						    <li><a href="#" style="font-size:10px;" id="2" alt="2" class="acercarse"><i class="icon-map-marker"></i> Acercarse</a></li>
						    <li><a href="#" style="font-size:10px;"><i class="icon-screenshot"></i> Atacar</a></li>
						    <li><a href="#" style="font-size:10px;"><i class="icon-fullscreen"></i> Minear</a></li>
						    <li class="divider"></li>
						    <li><a href="#" style="font-size:10px;"><i class="icon-info-sign"></i> Info</a></li>
						  </ul>
						</div>
    				</td>
    			</tr>
			</table>
		</div>
		<div id="container"></div>
		<div id="menuInferior"> 
			<button class="close" id="cerrarMenuInferior">&times;</button>
			<button class="btn btn-inverse" id="verRadar"> Radar </button>
			<button class="btn btn-inverse" id="verControles"> Controles </button>
		 	<button class="btn btn-inverse" id="verCreditos"> Créditos </button>
		 	<button class="btn btn-inverse" id="verSalirUniverso"> Hangar</button>
		 </div>

<script>
$(function() {


			$("button#verSalirUniverso").click(function(){
				var pagina = 'http://cantely.com/demo/lab3dviewver/';
				document.location.href=pagina;
			});

			$("button#verControles").click(function(){
				$( "div#controles" ).toggle("fold");
			});

			$("button#verCreditos").click(function(){
				$("div#creditos").toggle("fold");
			});	

			$("button#verRadar").click(function(){
				$("div#radar").toggle("fold");
			});	

			$("div#radar").draggable();
			$("div#controles").draggable();
			$("div#creditos").draggable();

			$("button#cerrarControles").click(function(){
				$("div#controles").hide();
			});

			$("button#cerrarCreditos").click(function(){
				$("div#creditos").hide();
			});

			$("button#cerrarRadar").click(function(){
				$("div#radar").hide();
			});

			$("button#cerrarMenuInferior").click(function(){
				$("div#menuInferior").hide();
			});
			
			$("div#pilotoAutomatico").hide();
			$("a.acercarse").click(function(){
  				var id = $( this ).attr("id");
  				acercarse(id);
			});

 			$("div#sincombustibleayuda").hide().draggable();

});

        if (!Detector.webgl) {
            Detector.addGetWebGLMessage();
            document.getElementById('container').innerHTML = "";
        }

		var d, dPlanet, dMoon, dMoonVec = new THREE.Vector3();
		this.clock = new THREE.Clock();
		var combustible = 100;
		var numPoints;
		var delta = clock.getDelta();
		init();
		animate();	

		function init() {

				this.camera = new THREE.PerspectiveCamera( 50, window.innerWidth / window.innerHeight, 1, 1e7 );
				camera.position.set(80,0,0);
				camera.useQuaternion = true;
				
				cameraControls = new THREE.OrbitControls(camera);
				cameraControls.maxDistance = 400;
				cameraControls.minDistance = 50;
				
				this.scene = new THREE.Scene();
				scene.fog = new THREE.FogExp2( 0x000000, 0.0000003 );

				dirLight = new THREE.DirectionalLight( 0xc2c2c2 );
				dirLight.position.set( 2000, 1000, 1 ).normalize();
				scene.add( dirLight );

				ambientLight = new THREE.AmbientLight( 0x4f3f1f );
				scene.add( ambientLight );

				renderer = new THREE.WebGLRenderer();
		        renderer.setSize( window.innerWidth, window.innerHeight );
		        renderer.sortObjects = true;
		        renderer.autoClear = true;
		        renderer.setClearColor(new THREE.Color(0x000000));
		        container = document.createElement('div');
				document.body.appendChild( container );
		        container.appendChild( renderer.domElement );
				

				planet();
				moon();
				tubo();
				tuboOBJ();
				starts();
				statsinwindows();
				prostprocessing();
				fragata();
				motor();

			this.acercarse = function(id){
					console.log(id);

					if(id == "1"){ 
						idx = -10000/3;
						idy = 0;
						idz = 10000;
					};
					if(id == "2"){ 
						idx = -384400/3.1;
						ixy = 0;
						idz = 0;
					};
					console.log(idx+","+idy+","+idz);

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
					if(combustible >= 50){
					var pilotoautomatico = new TWEEN.Tween( nave.position )
						.to( { x: idx, y: idy, z: idz }, 15000 )
						//TWEEN.Easing.Elastic.InOut
						.easing( TWEEN.Easing.Exponential.Out )
						.onUpdate( function () {
	           				$( "div#pilotoAutomatico" ).show("fade", function() {
	      						$( this ).hide("fade");
							});
							combustible -= 0.03;
							velocidadReal = 150;
							$("#velocidadReal").html(velocidadReal);
							$("div.bar#barravelocidad").css("width", velocidadReal);
							$( "div#sincombustible" ).hide();
           				})
						.start();						
					}else{
						console.log("sin combustible");
						$( "div#sincombustible" ).show();
						$("div#sincombustibleayuda").show("fold");
					}
			}

			var gastarcombustible = function(){
					var maxcombustible = 99;
					var mincombusitlbe = 0;

					if(velocidadReal > 10){
							combustible -= velocidadReal/50;
					}else{
						if(combustible <= maxcombustible){
							combustible += 1.9;
						}
					}
					if(combustible <= 0){
						combustible = mincombusitlbe;
						controlsnave.moveState.right = 0;
						controlsnave.moveState.left = 0;
						$( "div#sincombustible" ).show();
					}else{
						$( "div#sincombustible" ).hide();
					}
			}
				setInterval(gastarcombustible,1000);

				window.addEventListener( 'resize', onWindowResize, false );
		}   
					

		function animate() {

				requestAnimationFrame( animate );
				render();
				stats.update();
				stats2.update();
				//renderParticulas();
		}


		function render() {   

				var delta = clock.getDelta();

				meshPlanet.rotation.y += 0.02 * delta;
				meshClouds.rotation.y += 5 * 0.02 * delta;
				stars.rotation.y += 15 * delta;

				var velocidadUiaumentandose = parseInt(controlsnave.moveState.left*100);
				var velocidadUireduciendose = parseInt(controlsnave.moveState.right*100);
				this.velocidadReal = velocidadUiaumentandose - velocidadUireduciendose;

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
				
				this.posicionXnave = Math.abs(nave.position.x);
				this.posicionYnave = Math.abs(nave.position.y);
				this.posicionZnave = Math.abs(nave.position.z);

				var radioTierra = 6370/2;
				var elevarXplanet = Math.pow(meshPlanet.position.x-nave.position.x,2);
				var elevarYplanet = Math.pow(meshPlanet.position.y-nave.position.y,2);
				var elevarZplanet = Math.pow(meshPlanet.position.z-nave.position.z,2);
				var distanciaPlaneta = Math.sqrt(elevarXplanet+elevarYplanet+elevarZplanet-radioTierra);
				$("#distanciaPlaneta").html(parseInt(distanciaPlaneta/1000)+"K.");

				var radioMoon = 1737/2;
				var elevarXmoon = Math.pow(meshMoon.position.x-nave.position.x,2);
				var elevarYmoon = Math.pow(meshMoon.position.y-nave.position.y,2);
				var elevarZmoon = Math.pow(meshMoon.position.z-nave.position.z,2);
				var resultadoDistanciaMoon = Math.sqrt(elevarXmoon+elevarYmoon+elevarZmoon-radioMoon);
				$("#distanciaMoon").html(parseInt(resultadoDistanciaMoon/1000)+"K.");
				
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

</script>
</body>
</html>