<!doctype html>
<html lang="en">
	<head>
		<meta name="html5" value="notranslate">
		<meta name="description" content="html5 videogame">

		<script type='text/javascript'>window.mod_pagespeed_start = Number(new Date());</script>
		<link rel="shortcut icon" href="img/favicon.gif" type="image/gif">
		<title>html5 videogame</title>
		<meta charset="utf-8">
		<meta name="viewport" content="user-scalable=no, minimum-scale=1.0, maximum-scale=1.0, initial-scale=1.0, user-scalable=no">
<!-- css -->
		<link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
<!-- fonts -->
		<link href='http://fonts.googleapis.com/css?family=Aldrich' rel='stylesheet' type='text/css'>
<!-- js -->
		<script src="http://code.jquery.com/jquery.js"></script>
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

		<script src="engine/render.js"></script>
		<script src="engine/onwindowsresize.js"></script>
		<script src="engine/fragata.js"></script>
		<script src="engine/postprocessing.js"></script>
		<script src="engine/renderer.js"></script>
		<script src="engine/statsinwindows.js"></script>
		<script src="engine/stars.js"></script>
		<script src="engine/moon.js"></script>
		<script src="engine/planet.js"></script>
		<script src="engine/particulas.js"></script>
		<!--<script src="engine/crearProvidence.js"></script>-->

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

#menuSuperior{
	width:100%;
	height:90px;
	position:fixed;
    background : rgba(255, 255, 255, 0.2);
    min-width: 750px;
    max-width: 100%;
    margin:auto;
    z-index: 1;
}

#menuInferior{
	width:100%; 
	height:10%; 
	position:fixed; 
	bottom:0; 
	right:0; 
	left:0; 
	overflow:hidden; 
	font-size: 15px;
	color:white;
	background-color: rgba(255, 255, 255, 0.2);
	z-index: 1;
}
		</style>
	</head>

<body style="">
<div id="menuSuperior">
	<span style="font-size:24px">Controles</span><br> 
	<span style="color:#0CF">A</span>: Girar izquierda, <span style="color:#0CF">S</span>: Marcha atrás, <span style="color:#0CF">D</span>: Girar derecha, <span style="color:#0CF">W</span>: Acelerar<br> 
	<span style="color:#0CF">Q</span>: Bajar, <span style="color:#0CF">E</span>: Subir<br> <span style="color:#0CF">Shift</span>: Turbo, <span style="color:#0CF">Ratón</span>: girar <br>
	<div id="velocidad" style="margin-top:150px; position:relative;">a</div>
</div>
	

<script>

			if ( ! Detector.webgl ) Detector.addGetWebGLMessage();

			var radius = 6371;
			var tilt = 0.41;
			var rotationSpeed = 0.02;
			var movementSpeed = 0.02;
			var cloudsScale = 1.1;
			var moonScale = 0.55;

			var container, stats, stats2;
			var camera, controls, scene, sceneCube, renderer;
			var geometry, meshPlanet, meshClouds, meshMoon, meshProvidence;
			var dirLight, pointLight, ambientLight, light;
			var objecto2, object;
			var controlsnave, cameraTarget;
			var d, dPlanet, dMoon, dMoonVec = new THREE.Vector3();
			var clock = new THREE.Clock();

			init();
			

function init() {

				container = document.createElement( 'div' );
				document.body.appendChild( container );

				
				this.camera = new THREE.PerspectiveCamera( 50, window.innerWidth / window.innerHeight, 1, 1e7 );

				this.scene = new THREE.Scene();
				scene.fog = new THREE.FogExp2( 0x000000, 0.0000004 );
				scene.add( camera );

				dirLight = new THREE.DirectionalLight( 0xc2c2c2 );
				dirLight.position.set( 20, 0, 1 ).normalize();
				scene.add( dirLight );

				ambientLight = new THREE.AmbientLight( 0x4f3f1f );
				scene.add( ambientLight );

				light = new THREE.Light(0x333333);
				light.position.set( -1, 0, 1 ).normalize();
				scene.add(light);

				//crearProvidence();
				planet();
				moon();
				starts();
				statsinwindows();
				renderer();
				prostprocessing();
				fragata();
				particulas();


				window.addEventListener( 'resize', onWindowResize, false );
				animate();

}
function animate() {
				
				requestAnimationFrame( animate );
				cloudsScale += 0.2
				render();
				stats.update();
				stats2.update();

}



		</script>


</body>
</html>