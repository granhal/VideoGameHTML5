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
		<!--<script src="js/jquery.knob.js"></script>-->
		<script src="js/bootstrap.min.js"></script>

		<script src="js/three.min.js"></script>
		<!--<script src="js/raphael-min.js"></script>-->
		
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

		<script src="engine/postprocessing.js"></script>
		<script src="engine/render.js"></script>
		<script src="engine/onwindowsresize.js"></script>
		<script src="engine/luces.js"></script>
		<script src="engine/stars.js"></script>
		<script src="engine/moon.js"></script>
		<script src="engine/planet.js"></script>
		<script src="engine/fragata.js"></script>
		<script src="engine/pilotoautomatico.js"></script>
		<script src="engine/combustible.js"></script>
		<script src="engine/ui.js"></script>
		<script src="engine/statsinwindows.js"></script>
	</head>
	<body>
		<div id="menuSuperior" class="text-right">
			<img src="logo.png" width="30%" >
		</div>
		<div id="controles" style="font-size:9px;">
			<button class="close" id="cerrarControles">&times;</button>
			<span style="font-size:18px"><span class="icon-wrench  icon-white"></span> Controles</span><br> 
			<span style="color:#0CF">A</span>: Girar izquierda<br>
			<span style="color:#0CF">S</span>: Frenar<br>
			<span style="color:#0CF">D</span>: Girar derecha<br>
			<span style="color:#0CF">W</span>: Acelerar<br> 
			<span style="color:#0CF">Q</span>: Bajar<br>
			<span style="color:#0CF">E</span>: Subir<br> 
			<span style="color:#0CF">Shift</span>: Turbo <br>
			<span style="color:#0CF">Botón derecho ratón</span>: Camara giratoria <br>
		</div>
		<div id="pilotoAutomatico" style="color:#42ff00">
			<center>Piloto automático activado</center>
		</div>
		<div id="sincombustible" class="sincombustible" style="color:red">
			<center>Sin combustible</center>
		</div>
		<div class="alert alert-error" id="sincombustibleayuda" style="width:24%; z-index:100; position:fixed; top:65%; left:33%; font-size:10px;">	</div>

		<div id="barrasdeestado" style="margin: 300px; position:fixed; font-size:10px; line-height:5px; width:250px; line-height:5px">

				<a id="ayuda" data-toggle="tooltip" data-placement="top" title="Velocidad actual en metros por segundo">
					<span class="icon-tasks icon-white"></span>
					Velocidad: <span id="velocidadReal"></span> m/s
				</a>
			<div class="progress progress-striped active" style="width:100px; height:5px;">
				<div class="bar" id="barravelocidad" style="width: 100%"></div>
			</div>
				<a id="ayuda" data-toggle="tooltip" data-placement="top" title="Combustible actual, se regenera con energía solar">
					<span class="icon-tint icon-white"></span>
					Combustible: <span id="combustibleReal"></span>%
				</a>
			<div class="progress progress-danger progress-striped active" style="width:100px; height:5px;">
				<div class="bar" id="barracombustible" style="width: 100%"></div>
			</div>
				<a id="ayuda" data-toggle="tooltip" data-placement="top" title="Estado de los escudos">
					<span class="icon-certificate icon-white"></span>
					Escudos: 100%
				</a>
			<div class="progress progress-warning progress-striped active" style="width:100px; height:5px;">
				<div class="bar" id="barraescudos" style="width: 100%"></div>
			</div>
				<a id="ayuda" data-toggle="tooltip" data-placement="top" title="Estado del blindaje interno">
					<span class="icon-heart icon-white"></span>
					Blindaje: 100%
				</a>
			<div class="progress progress-success progress-striped active" style="width:100px; height:5px;">
				<div class="bar" id="barrablindaje" style="width: 100%"></div>
			</div>			
			<p style="line-height:10px"><span class="icon-map-marker icon-white"></span>
			<a id="ayuda" data-toggle="tooltip" data-placement="top" title="Esta es tu posición actual">
				Posición actual: 
				<span id="posicion"></span>
				</a>
			</p>
			<div style="line-height:5px; font-size:10px;">
				<p><span id="duracionDelViaje"></span><br>
				<span id="consumoViaje"></span></p>
			</div>	
		</div>

		<div id="creditos">
			<button class="close" id="cerrarCreditos" >&times;</button>
			<span style="font-size:14px"><span class="icon-info-sign icon-white"></span> Créditos</span><br>
			<p class="text-left">Este juego está en desarrollo, estas jugando a una ALFA de prueba, gracias por testear y formar parte de esto.
				v.0.0.307 alfa - más info en: <u><a href="https://github.com/granhal/VideoGameHTML5">Github</a></u></p><br>
				<p class="text-center">
					<a href="http://www.cantelymedia.com" target="_blank"><img src="cantelymedia.jpg" width="30%"></a>&nbsp;&nbsp;&nbsp;
					<a href="http://www.brainside.es" target="_blank"><img src="brainside.jpg" width="20%"></a>
				</p>
		</div>

		<div id="radar" >
			<button class="close" id="cerrarRadar">&times;</button>
			<span style="font-size:14px"><span class="icon-eye-open icon-white"></span> Radar</span>
			<table class="table table-condensed" style="font-size:10px;">
			  	<tr>
  				    <td>ID</td>
    				<td>Distancia</td>
    				<td></td>
    				<td>Opc.</td>
    			</tr>
  				<tr>
  				    <td>
  				    	<a id="ayuda" data-toggle="tooltip" data-placement="top" title="Aliados" href="#">
  				    	<span style="color:#5aff00;">&#8226;</span> Planeta</a>
  				    </td>
    				<td><span id="distanciaPlaneta"></span> Km.</td>
    				<td><i class="icon-globe icon-white"></i></td>
    				<td>
						<div class="btn-group">
						  <a class="btn dropdown-toggle btn-mini btn-inverse" data-toggle="dropdown" href="#" style="font-size:8px;"><span class="icon-cog icon-white"></span><span class="caret"></span></a>
						  <ul class="dropdown-menu">
						    <li><a href="#" style="font-size:10px;" id="1" alt="1" class="acercarse"><i class="icon-map-marker"></i> Acercarse</a></li>
						    <li><a href="#" style="font-size:10px;" id="1" alt="1" class="atacar"><i class="icon-screenshot"></i> Apuntar y atacar</a></li>
						    <li><a href="#" style="font-size:10px;" id="1" alt="1" class="extraer"><i class="icon-fullscreen"></i> Extraer mineral</a></li>
						    <li class="divider"></li>
						    <li><a href="#" style="font-size:10px;" id="1" alt="1" class="info"><i class="icon-info-sign"></i> Información</a></li>
						  </ul>
						</div>
					</td>
    			</tr>
    			<tr>
    				<td>
    				  	<a id="ayuda" data-toggle="tooltip" data-placement="top" title="Neutral" href="#">
  				    	<span style="color:#0CF;">&#8226;</span> Satélite</a>
    				</td>
    				<td><span id="distanciaMoon"></span> Km.</td>
    				<td><i class="icon-globe icon-white"></i></td>
    				<td>
    					<div class="btn-group">
						  <a class="btn dropdown-toggle btn-mini btn-inverse" data-toggle="dropdown" href="#" style="font-size:8px;"><span class="icon-cog icon-white"></span><span class="caret"></span></a>
						  <ul class="dropdown-menu">
						    <li><a href="#" style="font-size:10px;" id="2" alt="2" class="acercarse"><i class="icon-map-marker"></i> Acercarse</a></li>
						    <li><a href="#" style="font-size:10px;" id="2" alt="2" class="atacar"><i class="icon-screenshot"></i> Apuntar y atacar</a></li>
						    <li><a href="#" style="font-size:10px;" id="2" alt="2" class="extraer"><i class="icon-fullscreen"></i> Extraer mineral</a></li>
						    <li class="divider"></li>
						    <li><a href="#" style="font-size:10px;" id="2" alt="2" class="info"><i class="icon-info-sign"></i> Información</a></li>
						  </ul>
						</div>
    				</td>
    			</tr>
    			<tr>
    				<td>
    				  	<a id="ayuda" data-toggle="tooltip" data-placement="top" title="Neutral" href="#">
  				    	<span style="color:#0CF;">&#8226;</span> Nave espacial</a>
  				    </td>
    				<td><span id="distanciaNave"></span> Km.</td>
    				<td><i class="icon-plane icon-white"></i></td>
    				<td>
    					<div class="btn-group">
						  <a class="btn dropdown-toggle btn-mini btn-inverse" data-toggle="dropdown" href="#" style="font-size:8px;"><span class="icon-cog icon-white"></span><span class="caret"></span></a>
						  <ul class="dropdown-menu">
						    <li><a href="#" style="font-size:10px;" id="3" alt="3" class="acercarse"><i class="icon-map-marker"></i> Acercarse</a></li>
						    <li><a href="#" style="font-size:10px;" id="3" alt="3" class="atacar"><i class="icon-screenshot"></i> Apuntar y atacar</a></li>
						    <li><a href="#" style="font-size:10px;" id="3" alt="3" class="espiar"><i class="icon-qrcode"></i> Espiar y robar</a></li>
						    <li><a href="#" style="font-size:10px;" id="3" alt="3" class="robar"><i class="icon-random"></i> Intercambio</a></li>
						    <li><a href="#" style="font-size:10px;" id="3" alt="3" class="robar"><i class="icon-comment"></i> Mensaje</a></li>
						    <li><a href="#" style="font-size:10px;" id="3" alt="3" class="robar"><i class="icon-wrench"></i> Reparar</a></li>
						    <li><a href="#" style="font-size:10px;" id="3" alt="3" class="opcionesradar"><i class="icon-cog"></i> Más</a></li>
						    <li class="divider"></li>
						    <li><a href="#" style="font-size:10px;"id="3" alt="3" class="info"><i class="icon-user"></i> Información</a></li>
						  </ul>
						</div>
    				</td>
    			</tr>
			</table>
 		<center><button id="coordenadas" class="btn btn-mini btn-inverse" type="button">
			<a id="ayuda" data-toggle="tooltip" data-placement="top" title="Introducir las coordenadas donde apuntar el piloto automático." href="#"><span class="icon-edit icon-white"></span> Coordenadas</a>
 		</button>&nbsp;<button id="cancelarpilotoautomatico" class="btn btn-mini btn-inverse" type="button">
			<a id="ayuda" data-toggle="tooltip" data-placement="top" title="Desactivar piloto automático" href="#"><span class="icon-ban-circle icon-white"></span> Desactivar P/A.</a>
 		</button></center>	<br>

		</div>

		<div id="introducirCoordenadas" style="z-index:1000;">
			<button class="close" id="cerrarIntroducirCoordenadas">&times;</button>
			<p class="text-center" style="font-size:10px">Solo números negativos y positivos</p>
				<input id="irx" class="input-mini" type="text" placeholder="x" name="solonum" maxlength="6" tabindex="1">
				<input id="iry" class="input-mini" type="text" placeholder="y" name="solonum" maxlength="6" tabindex="2">
				<input id="irz" class="input-mini" type="text" placeholder="z" name="solonum" maxlength="6" tabindex="3">
				<button id="iracoordenadas" class="btn btn-primary btn-inverse">
		 			<a id="ayuda" data-toggle="tooltip" data-placement="top" title="Activar el piloto automático"><span class="icon-map-marker icon-white">&nbsp;&nbsp;&nbsp;</span></a>
				</button>
 		</div>

		<div id="container"></div>
		
		<div id="menuInferior"> 
			<button class="close" id="cerrarMenuInferior">&times;</button>
			<button class="btn btn-inverse" id="verRadar" alt="Radar">
				<a id="ayuda" data-toggle="tooltip" data-placement="right" title="Radar"><span class="icon-eye-open icon-white">&nbsp;&nbsp;&nbsp;</span></a>
			</button>
			<button class="btn btn-inverse" id="verControles">			
				<a id="ayuda" data-toggle="tooltip" data-placement="right" title="Configuración"><span class="icon-wrench icon-white">&nbsp;&nbsp;&nbsp;</span></a>
			</button>
		 	<button class="btn btn-inverse" id="verCreditos">			
		 		<a id="ayuda" data-toggle="tooltip" data-placement="right" title="Créditos"><span class="icon-info-sign icon-white">&nbsp;&nbsp;&nbsp;</span></a>
			</button>
		 	<button class="btn btn-inverse" id="verSalirUniverso">		
		 		<a id="ayuda" data-toggle="tooltip" data-placement="right" title="Hangar"><span class="icon-home icon-white">&nbsp;&nbsp;&nbsp;</span></a>
			</button>
		 </div>

<script>
        if (!Detector.webgl) {
            Detector.addGetWebGLMessage();
            document.getElementById('container').innerHTML = "";
        }

		var d, dPlanet, dMoon, dMoonVec = new THREE.Vector3();
		this.clock = new THREE.Clock();
		this.delta = clock.getDelta();
		init();
		animate();	

		function init() {

				this.camera = new THREE.PerspectiveCamera( 39, window.innerWidth / window.innerHeight, 1, 1e7 );
				camera.position.set(150,0,0);
				camera.rotation.set(0,0,90);
				camera.useQuaternion = true;
				
				cameraControls = new THREE.OrbitControls(camera);
				cameraControls.maxDistance = 300;
				cameraControls.minDistance = 10;
				
				this.scene = new THREE.Scene();
				scene.fog = new THREE.FogExp2( 0x000000, 0.0000003 );

				renderer = new THREE.WebGLRenderer();
		        renderer.setSize( window.innerWidth, window.innerHeight );
		        renderer.sortObjects = true;
		        renderer.autoClear = true;
		        renderer.setClearColor(new THREE.Color(0x000000));
		        container = document.createElement('div');
				document.body.appendChild( container );
		        container.appendChild( renderer.domElement );

		        luces();

				starts();
				planet();
				moon();
				tubo();
				enemigo();
				prostprocessing();
				fragata();

				statsinwindows();

				setInterval(gastarcombustible,1000);
				window.addEventListener( 'resize', onWindowResize, false );
		}   
					

		function animate() {

				requestAnimationFrame( animate );
				render();
				stats.update();
				stats2.update();

		}
</script>
</body>
</html>