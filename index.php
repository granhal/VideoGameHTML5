<!doctype html>
<html lang="es-ES">
	<head>
		<meta name="html5" value="notranslate">
		<meta name="description" content="html5 videogame">

		<script type='text/javascript'>window.mod_pagespeed_start = Number(new Date());</script>
		<link rel="shortcut icon" href="img/favicon.gif" type="image/gif">
		<title>Embrion MMO GALAXY BROWSER VIDEOGAME</title>
		<meta charset="utf-8">
		<meta name="viewport" content="user-scalable=no, minimum-scale=1.0, maximum-scale=1.0, initial-scale=1.0, user-scalable=no">
<!-- css -->
		<link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
<!-- fonts -->
		<link href='http://fonts.googleapis.com/css?family=Aldrich' rel='stylesheet' type='text/css'>
<!-- js -->
		<script src="js/jquery.min.js"></script>
		<script src="js/jquery-ui.min.js"></script>
		<script src="js/bootstrap.min.js"></script>

		<script src="js/three.min.js"></script>
		
		<script src="js/controls/FlyControls.js"></script>

		<script src="js/shaders/CopyShader.js"></script>
		<script src="js/shaders/FilmShader.js"></script>

		<script src="js/postprocessing/EffectComposer.js"></script>
		<script src="js/postprocessing/ShaderPass.js"></script>
		<script src="js/postprocessing/MaskPass.js"></script>
		<script src="js/postprocessing/RenderPass.js"></script>
		<script src="js/postprocessing/FilmPass.js"></script>
		<script src="js/OBJLoader.js"></script>

		<script src="js/Detector.js"></script>
		<script src="js/libs/stats.min.js"></script>
		<!--<script src="js/loaders/ColladaLoader.js"></script>-->
		<script src="js/loaders/AssimpJSONLoader.js"></script>

		<script src="engine/onwindowsresize.js"></script>
		<script src="engine/fragata.js"></script>
		<script src="engine/postprocessing.js"></script>
		<script src="engine/statsinwindows.js"></script>
		<script src="engine/stars.js"></script>
		<script src="engine/moon.js"></script>
		<script src="engine/planet.js"></script>
		<script src="engine/particulas.js"></script>
		<!--<script src="engine/crearProvidence.js"></script>-->
		<script src="js/effects/OculusRiftEffect.js"></script>

		<style>
body{
	font-family: 'Aldrich', sans-serif;
	color: white;
	background:#000;
	color: #eee;
	padding:0;
	margin:0;
	font-weight:bold;
	overflow:hidden;
}
div#menuSuperior{
	width:99%; 
	height:80px; 
	position:fixed; 
	overflow:hidden; 
	font-size: 15px;
	color:white;
	background-color: rgba(255, 255, 255, 0.1);
    z-index: 10;
    padding: 5px;

}
div#menuInferior{
	width:99%; 
	height:30px; 
	position:fixed; 
	bottom:0; 
	right:0; 
	left:0; 
	overflow:hidden; 
	font-size: 15px;
	color:white;
	background-color: rgba(255, 255, 255, 0.2);
    z-index: 10;
    padding: 5px;
}
div#controles{
	width:235px;
	height:130px;
	position:fixed;
    background : rgba(255, 255, 255, 0.2);
    margin:auto;
    left:10px;
	top:180px;
    z-index: 10;
    padding: 8px;
    line-height:15px;
}
div#creditos{
	padding: 8px;
	font-size: 10px;
	position:fixed;
	width:235px;
	height:155px;
	background:rgba(255, 255, 255, 0.2);
	left:10px;
	top:350px;
	vertical-align: 1px;
	z-index: 10;
	line-height:15px;
}
		</style>
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
<div id="velocidad" style="margin: 450px; position:fixed; font-size:9px;">
		<p>Velocidad: <span id="test"></span> m/s</p>
</div>
<div id="creditos">
	<button class="close" id="cerrarCreditos">&times;</button>
	<span style="font-size:14px">Créditos</span><br>
	<p class="text-left">Este juego está en desarrollo, estas jugando a una ALFA de prueba, gracias por testear y formar parte de esto.
		v.0.0.107 alfa - más info en: <u><a href="https://github.com/granhal/VideoGameHTML5">Github</a></u></p><br>
		<p class="text-center">
			<a href="http://www.cantelymedia.com" target="_blank"><img src="cantelymedia.jpg" width="30%"></a>&nbsp;&nbsp;&nbsp;
			<a href="http://www.brainside.es" target="_blank"><img src="brainside.jpg" width="20%"></a>
		</p>
</div>
<div id="container"></div>
<div id="menuInferior"> 
	<button class="close" id="cerrarMenuInferior">&times;</button>
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
				$("div#controles").show();
			});
			$("button#verCreditos").click(function(){
				$("div#creditos").show();
			});		
			$( "div#controles" ).draggable();
			$( "div#creditos" ).draggable();
			$("button#cerrarControles").click(function(){
				$("div#controles").hide();
			});
			$("button#cerrarCreditos").click(function(){
				$("div#creditos").hide();
			});
			$("button#cerrarMenuInferior").click(function(){
				$("div#menuInferior").hide();
			});
		});



        if (!Detector.webgl) {

            Detector.addGetWebGLMessage();
            document.getElementById('container').innerHTML = "";

        }
			//radio
			var radius = 7371;
			//
			var tilt = 0.41;
			//velocidad de rotacion de las nubes
			var rotationSpeed = 0.02;
			//escala de las nubes
			var cloudsScale = 1.1;
			//escala de la luna
			var moonScale = 0.50;

			var container, stats, stats2;
			var camera, controls, scene, sceneCube, renderer;
			var geometry, meshPlanet, meshClouds, meshMoon, meshProvidence;
			var dirLight, pointLight, ambientLight, light;
			var objecto2, object, effect;
			var controlsnave, cameraTarget;
			var d, dPlanet, dMoon, dMoonVec = new THREE.Vector3();
			this.clock = new THREE.Clock();
			
			init();
			animate();	


function init() {

				container = document.createElement('div');
				document.body.appendChild( container );

			
				this.camera = new THREE.PerspectiveCamera( 50, window.innerWidth / window.innerHeight, 1, 1e7 );

				this.scene = new THREE.Scene();
				scene.fog = new THREE.FogExp2( 0x000000, 0.0000004 );
				//scene.add( camera );

				dirLight = new THREE.DirectionalLight( 0xc2c2c2 );
				dirLight.position.set( 20, 0, 1 ).normalize();
				scene.add( dirLight );

				ambientLight = new THREE.AmbientLight( 0x4f3f1f );
				scene.add( ambientLight );

				light = new THREE.Light(0x333333);
				light.position.set( -1, 0, 1 ).normalize();
				scene.add(light);


		renderer = new THREE.WebGLRenderer();
        renderer.setSize( window.innerWidth, window.innerHeight );
        renderer.sortObjects = false;
        renderer.autoClear = false;
        renderer.setClearColor(new THREE.Color(0x000000));
        container.appendChild( renderer.domElement );
				
				planet();
				moon();
				starts();
				statsinwindows();
				prostprocessing();
				fragata();
				particulas();

          
				/*$("#botonoculus").click(function(){
					  effect = new THREE.OculusRiftEffect( renderer, {worldScale: 10000} );
					  effect.setSize( window.innerWidth, window.innerHeight );
				});*/
				
				window.addEventListener( 'resize', onWindowResize, false );
}   

function animate() {
				
				requestAnimationFrame( animate );
				render();
				renderParticulas();
				stats.update();
				stats2.update();

}

function render() {
		                        
            					
				// rotate the planet and clouds

				var delta = clock.getDelta();
				meshPlanet.rotation.y += rotationSpeed * delta;
				meshClouds.rotation.y += 5 * rotationSpeed * delta;

				// slow down as we approach the surface

				dPlanet = camera.position.length();

				dMoonVec.subVectors( camera.position, meshMoon.position );
				dMoon = dMoonVec.length();
				if ( dMoon < dPlanet ) {
					d = ( dMoon - radius * moonScale * 1.01 );
				} else {
					d = ( dPlanet - radius * 1.01 );
				}

				particles.rotation.z += 0.009;
				var velocidadUiaumentandose = parseInt(controlsnave.moveState.left*100);
				var velocidadUireduciendose = parseInt(controlsnave.moveState.right*100);

				var velocidadReal = velocidadUiaumentandose - velocidadUireduciendose;

				$("#test").html(velocidadReal);
				
				if(velocidadReal >= 250){
					//$("#test").html("velocidad maxima");
					controlsnave.moveState.left = 2.50;
					particles.rotation.z += 0.03;
				};
				if(velocidadReal <= -50){
					//$("#test").html("velocidad maxima");
					controlsnave.moveState.right = 0.50;
					particles.rotation.z -= 0.03;
				};

				if(controlsnave.movementSpeedMultiplier == 1){ 
					controlsnave.moveState.left = 5; 
				}
				/*$("#botonoculus").click(function(){
					effect.render( scene, camera );
				});*/
				
				//controlsnave.movementSpeed = 1.33 * d;
				controlsnave.update( delta );
				composer.render( delta );

				

}


		</script>


</body>
</html>