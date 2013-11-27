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
			<span style="color:#0CF">Arrastrar ratón</span>: Girar <br>
		</div>
		<div id="velocidad" style="margin: 450px; position:fixed; font-size:9px; line-height:10px;">
				<p>Velocidad: <span id="velocidadReal"></span> m/s</p>
				<p>Posición: <span id="posicion"></span></p>
		</div>
		<div id="creditos">
			<button class="close" id="cerrarCreditos" >&times;</button>
			<span style="font-size:14px">Créditos</span><br>
			<p class="text-left">Este juego está en desarrollo, estas jugando a una ALFA de prueba, gracias por testear y formar parte de esto.
				v.0.0.107 alfa - más info en: <u><a href="https://github.com/granhal/VideoGameHTML5">Github</a></u></p><br>
				<p class="text-center">
					<a href="http://www.cantelymedia.com" target="_blank"><img src="cantelymedia.jpg" width="30%"></a>&nbsp;&nbsp;&nbsp;
					<a href="http://www.brainside.es" target="_blank"><img src="brainside.jpg" width="20%"></a>
				</p>
		</div>
		<div id="pilotoAutomatico">
		Piloto automático activado
		</div>
		<div id="radar" >
			<button class="close" id="cerrarRadar">&times;</button>
			<span style="font-size:14px">Radar</span>
			<table class="table table-condensed" style="font-size:8px;">
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
						    <li><a href="#" style="font-size:8px;" id="1" alt="1" class="acercarse"><i class="icon-map-marker"></i> Acercarse t</a></li>
						    <li><a href="#" style="font-size:8px;" id="atacar"><i class="icon-screenshot"></i> Atacar</a></li>
						    <li><a href="#" style="font-size:8px;" id="minear"><i class="icon-fullscreen"></i> Minear</a></li>
						    <li class="divider"></li>
						    <li><a href="#" style="font-size:8px;"><i class="icon-info-sign"></i> Info</a></li>
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
						    <li><a href="#" style="font-size:8px;" id="2" alt="2" class="acercarse"><i class="icon-map-marker"></i> Acercarse l</a></li>
						    <li><a href="#" style="font-size:8px;"><i class="icon-screenshot"></i> Atacar</a></li>
						    <li><a href="#" style="font-size:8px;"><i class="icon-fullscreen"></i> Minear</a></li>
						    <li class="divider"></li>
						    <li><a href="#" style="font-size:8px;"><i class="icon-info-sign"></i> Info</a></li>
						  </ul>
						</div>
    				</td>
    			</tr>
			</table>
		</div>
		<div id="container"></div>
		<div id="menuInferior"> 
			<button class="close" id="cerrarMenuInferior">&times;</button>
			<button class="btn btn-inverse" id="verRadar"> ver radar</button>
			<button class="btn btn-inverse" id="verControles"> ver controles</button>
		 	<button class="btn btn-inverse" id="verCreditos"> ver créditos</button>
		 	<button class="btn btn-inverse" id="verSalirUniverso">Ir al hangar</button>
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
  				$("div#pilotoAutomatico").show("fold");
			});

});

        if (!Detector.webgl) {
            Detector.addGetWebGLMessage();
            document.getElementById('container').innerHTML = "";
        }

		var d, dPlanet, dMoon, dMoonVec = new THREE.Vector3();
		this.clock = new THREE.Clock();
			
		init();
		animate();	

		function init() {

				this.camera = new THREE.PerspectiveCamera( 50, window.innerWidth / window.innerHeight, 1, 1e7 );
				cameraControls = new THREE.OrbitControls(camera);
				cameraControls.target.set( 0, 0, 0);
				cameraControls.maxDistance = 400;
				cameraControls.minDistance = 50;
				//cameraControls.update();
				camera.position.set(80,20,0);
				this.scene = new THREE.Scene();
				scene.fog = new THREE.FogExp2( 0x000000, 0.00000011 );

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

				/*$("#botonoculus").click(function(){
					  effect = new THREE.OculusRiftEffect( renderer, {worldScale: 10000} );
					  effect.setSize( window.innerWidth, window.innerHeight );
				});*/
				
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

				var velocidadUiaumentandose = parseInt(controlsnave.moveState.left*100);
				var velocidadUireduciendose = parseInt(controlsnave.moveState.right*100);
				var velocidadReal = velocidadUiaumentandose - velocidadUireduciendose;
				$("#velocidadReal").html(velocidadReal);
				particles.scale.x = velocidadReal/900000;
				particles.scale.z = velocidadReal/90000000;
				particles.position.x = 15+velocidadReal/90000;
				particles.rotation.x = 0.9+velocidadReal/1000;
				//particles.rotation.x += 0.9;

				var posicionXnave = Math.abs(nave.position.x);
				var posicionYnave = Math.abs(nave.position.y);
				var posicionZnave = Math.abs(nave.position.z);
				var radioTierra = 6370/2;
				var distanciaPlaneta = Math.sqrt(posicionZnave+posicionYnave+posicionXnave-radioTierra);
				$("#distanciaPlaneta").html(parseInt(distanciaPlaneta)+"K.");

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

				if(velocidadReal <= -50){
					controlsnave.moveState.right = 0.50;
				};

				if(controlsnave.movementSpeedMultiplier == 1){ 
					controlsnave.moveState.left = 5; 
				}
				/*$("#botonoculus").click(function(){
					effect.render( scene, camera );
				});*/
				cameraControls.update( delta ); 
				controlsnave.update(  delta );
				composer.render( delta );
				
				this.acercarse = function(id){
					console.log(id);
					$("div#pilotoAutomatico").show("fold");
					//Mostrar cartel piloto automatico activado (si se toca cualquier tecla se desactiva)
					//reducir la velocidad a 0
					//girar la nave hasta el punto fijado (puede valer 0,0,0 que es la tierra como prueba)
					//acelerar hasta estar a 10K km. del objetivo
				}
		}

</script>
</body>
</html>