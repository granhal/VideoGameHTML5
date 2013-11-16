		function prostprocessing(){
				var renderModel = new THREE.RenderPass( scene, camera );
				var effectFilm = new THREE.FilmPass( 0.35, 0.75, 2048, false );

				effectFilm.renderToScreen = true;

				composer = new THREE.EffectComposer( renderer );

				composer.addPass( renderModel );
				composer.addPass( effectFilm );
		}