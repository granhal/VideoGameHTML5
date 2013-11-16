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
<!-- fonts 
		<link href='http://fonts.googleapis.com/css?family=Aldrich' rel='stylesheet' type='text/css'>-->
<!-- js -->
		<script src="js/jquery.min.js"></script>
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
	<span style="color:#0CF">A</span>: Girar izquierda, 
	<span style="color:#0CF">S</span>: Descelerar, 
	<span style="color:#0CF">D</span>: Girar derecha, 
	<span style="color:#0CF">W</span>: Acelerar<br> 
	<span style="color:#0CF">Q</span>: Bajar, 
	<span style="color:#0CF">E</span>: Subir<br> <span style="color:#0CF">Shift</span>: Turbo, <span style="color:#0CF">Ratón</span>: girar <br>
	<div id="velocidad" style="margin-top:150px; position:relative;"></div>
	<!--<button id="botonoculus">activar oculusrift</button><br>-->
	<p>Velocidad: <span id="test"></span> m/s</p>
</div>
	
  <div id="container">
    </div>
<script>

 
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