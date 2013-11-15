function onWindowResize( event ) {

				SCREEN_HEIGHT = window.innerHeight;
				SCREEN_WIDTH  = window.innerWidth;

				renderer.setSize( SCREEN_WIDTH, SCREEN_HEIGHT );

				camera.aspect = SCREEN_WIDTH / SCREEN_HEIGHT;
				camera.updateProjectionMatrix();

				composer.reset();

}