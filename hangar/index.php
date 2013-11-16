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

		<title>embrion MMO GALAXY BROWSER VIDEOGAME HTML5 - VIEWER</title>

		<link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
		<link href="css/ui.css" rel="stylesheet" media="screen">

		<script src="js/jquery.min.js"></script>
		<script src="js/jquery-ui.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
		<script src="js/three.min.js"></script>
		<script src="js/loaders/AssimpJSONLoader.js"></script>
		<script src="js/loaders/OBJLoader.js"></script>

		<script src="js/Detector.js"></script>
		<script src="js/libs/stats.min.js"></script>
		<script src="js/config.js"></script>
	</head>
	<body>
	
			<div id="menuSuperior" class="text-right">
				<img src="logo.png" width="30%" >
			</div>
			<div id="caracteristicas" style="font-size:9px;">
				<button class="close" id="cerrarCaracteristicas">&times;</button>
				<span style="font-size:22px">Hal - h1</span><br> 
				<span style="color:#0CF">Velocidad</span>: 250 m/s<br>
				<span style="color:#0CF">Turbo</span>: 500 m/s<br>
				<span style="color:#0CF">Capacidad</span>: 10 huecos.<br>
				<span style="color:#0CF">Tripulación</span>: 2 <br> 
				<span style="color:#0CF">Envergadura</span>: 8,13m<br>
				<span style="color:#0CF">Altura</span>: 4.08m<br> 
				<span style="color:#0CF">Peso vacío</span>: 4349kg <br>
				<span style="color:#0CF">Peso con carga</span>: 11.187kg <br>
				<span style="color:#0CF">Combustible</span>: 2500l. <br>
				<span style="color:#0CF">Motor</span>: General Electric J85-GE-21B  <br>
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
				<button class="btn btn-inverse" id="verCaracteristicas">ver carasterísticas de la nave</button>
			 	<button class="btn btn-inverse" id="verCreditos">ver créditos</button>
			 	<button class="btn btn-inverse" id="verSalirUniverso">salir al universo</button>
			</div>
		<script>

		$(function() {
			$("button#verSalirUniverso").click(function(){
				var pagina = 'http://cantely.com/demo/lab3d/';
				document.location.href=pagina;

			});


			$("button#verCaracteristicas").click(function(){
				$("div#caracteristicas").show();
			});
			
			$("button#verCreditos").click(function(){
				$("div#creditos").show();
			});		
			
			$( "div#caracteristicas" ).draggable();
			$( "div#creditos" ).draggable();

			$("button#cerrarCaracteristicas").click(function(){
				$("div#caracteristicas").hide();
			});
			
			$("button#cerrarCreditos").click(function(){
				$("div#creditos").hide();
			});
			
			$("button#cerrarMenuInferior").click(function(){
				$("div#menuInferior").hide();
			});
		});

		$(function(){

			if ( ! Detector.webgl ) {
				Detector.addGetWebGLMessage();
			}

			/* 
			https://github.com/acgessler/assimp2json
			assimp2json uses assimp (http://assimp.sf.net) to import 40+ 3D file
			formats, including 3ds, obj, dae, blend, fbx, x, ms3d, lwo (and many
			more).*/

			var container, stats;
			var camera, scene, renderer;
			var clock = new THREE.Clock();
			var movimiento;

			// init scene
			init();
			animate();

			// cristal
			function cristal(){
				// texture
				var texture = new THREE.Texture();
				var loader = new THREE.ImageLoader();
				loader.load( 'models/crystal_1/crystal_1_color.jpg', function ( image ) {
					texture.image = image;
					texture.needsUpdate = true;
				});
				// model
				var loader = new THREE.OBJLoader();
				loader.load( 'models/crystal_1/crystal_1.obj', function ( object ) {
					object.traverse( function ( child ) {
						if ( child instanceof THREE.Mesh ) {
							child.material.map = texture;
						}
					});
					object.position.y = 4;
					object.position.x = -20;
					object.scale.set(1,1,1);

					scene.add( object );
				});
			};
			// fragata

			function fragata(posiciony){
				
				var texture2 = new THREE.Texture();
				var loader4 = new THREE.ImageLoader();
				loader4.load( 'models/fragata_01.jpg', function ( image ) {
					texture2.image = image;
					texture2.needsUpdate = true;
				} );

				var loader5 = new THREE.OBJLoader();
				loader5.load( 'models/fragata_01.obj', function ( object2 ) {
					object2.traverse( function ( child ) {
						if ( child instanceof THREE.Mesh ) {
							child.material.map = texture2;
						}
					} );
					//posiciony = 2;
					object2.position.y = 5;
					object2.position.x = 10;

					object2.scale.set(1,1,1);

					scene.add( object2 );
					
				} );

			};


			// load interior model
			function mapa(){
				var loader2 = new THREE.AssimpJSONLoader();
				loader2.load( 'models/assimp/interior/interior.3ds.json', function ( assimpjson ) {

					assimpjson.scale.x = assimpjson.scale.y = assimpjson.scale.z = 4;
					assimpjson.updateMatrix();

					scene.add( assimpjson );

				} );
			;}
			//

			function init() {
				// Camera y Scene
				camera = new THREE.PerspectiveCamera( 70, window.innerWidth / window.innerHeight, 1, 100 );
				scene = new THREE.Scene();
				scene.fog = new THREE.FogExp2( 0x000000, 0.0002 );

				// Renderer
				renderer = new THREE.WebGLRenderer();
				renderer.setSize( window.innerWidth, window.innerHeight);
				$("#salida").append(renderer.domElement);

				// Lights
				scene.add( new THREE.AmbientLight( /*Math.random() */ 0xffffff ) );

				var directionalLight = new THREE.DirectionalLight(/*Math.random() **/ 0xf02 );
				directionalLight.position.x = 0;
				directionalLight.position.y = 10;
				directionalLight.position.z = 0;
				directionalLight.position.normalize();
				scene.add( directionalLight );

				//objetos
				mapa();
				//fragata(2);
				cristal();
				
				fragata();
				// Stats
				//stats = new Stats();
				//container.appendChild( stats.domElement );

				// Events
				window.addEventListener( 'resize', onWindowResize, false );

			}

			// tamaño de la api
			function onWindowResize( event ) {
				renderer.setSize( window.innerWidth, window.innerHeight );
				camera.aspect = window.innerWidth / window.innerHeight;
				camera.updateProjectionMatrix();
			}

			// animate escena
			var t = 0;
			function animate() {
				requestAnimationFrame( animate );
				render();
				//console.log(fragata);
				//stats.update();
			}

			// render escena
			function render() {
				var timer = Date.now() * 0.00006;

				camera.position.x = Math.cos( timer ) * 35;
				camera.position.y = 1;
				camera.position.z = Math.sin( timer ) * 35;
				camera.lookAt( scene.position );

				renderer.render( scene, camera );
			}

		});

		</script>
<div id="salida" style="width:100%; height:100%;"></div>
	</body>
</html>