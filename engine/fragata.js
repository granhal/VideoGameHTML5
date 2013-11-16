		
		function fragata(){

				texture = new THREE.Texture();
				loadTexture = new THREE.ImageLoader();
				loadTexture.load( 'models/fragata_01.jpg', function ( image ) {
					texture.image = image;
					texture.needsUpdate = true;
				} );

				loader = new THREE.OBJLoader();
					loader.load( 'models/fragata_01.obj', function ( spacialship ) {
					spacialship.traverse( function ( child ) {
						if ( child instanceof THREE.Mesh ) {
							child.material.map = texture;
						}
					} );
					
					spacialship.position.set(150000,0,0);
					//spacialship.rotation.set(0,0,0);
					spacialship.scale.set(0.1,0.1,0.1);
					scene.add(spacialship);
					
					this.controlsnave = new THREE.FlyControls(spacialship);
					controlsnave.rollSpeed = 0.08;
					controlsnave.autoForward = false;
					controlsnave.dragToLook = true;

					camera.position.set(80,20,0);
					camera.rotation.set(0,1.6,0);

					spacialship.add(camera);
					spacialship.add(particles);

					this.nave = spacialship;

				
					requestAnimationFrame( animate );
					
					particles.position.set(24,1,0);
					particles.scale.set(0.00009,0.00009,0.00009);
					
				});

			console.log("fragata cargada");

		};
