function fragata(){


				texture = new THREE.Texture();
				loadTexture = new THREE.ImageLoader();
				loadTexture.load( 'models/fragata_01.jpg', function ( image ) {
					texture.image = image;
					texture.needsUpdate = true;
				} );

				loader = new THREE.OBJLoader();
					loader.load( 'models/fragata_01.obj', function ( object ) {
					object.traverse( function ( child ) {
						if ( child instanceof THREE.Mesh ) {
							child.material.map = texture;
						}
					} );
					
					object.position.set(150000,0,0);
					//object.rotation.set(0,0,0);
					object.scale.set(0.1,0.1,0.1);

					
					controlsnave = new THREE.FlyControls(object);
					controlsnave.movementSpeed = Math.PI / 35;
					controlsnave.rollSpeed = Math.PI / 35;
					//controlsnave.autoForward = true;
					//controlsnave.dragToLook = true;
					
					scene.add(object);
					camera.position.set(80,20,0);
					camera.rotation.set(0,1.6,0);
					object.add(camera);

					object.add(particles);

					object.rotation.x = 102;
					this.nave = object;

				
				function animate() {
				
					requestAnimationFrame( animate );
					
					particles.position.set(24,1,0);
					particles.scale.set(0.0001,0.0001,0.0001);

						function acelerar(x, y){
							particles.rotation.z -= x/3;
							object.position.x -= y;
							object.position.y -= y;
							object.position.z -= y;
							if (y === 100){
								y = 100;
								$("#velocidad").html("velocidad:"+ y);

							}	
							if ( y === 250 ){
								y = 250;
								$("#velocidad").html("velocidad:"+ y);
							}						
							
						}
						function descelerar(x, y){
							particles.rotation.z -= x/2;
							object.position.x -= y
							if ( y === 15 ){
								y = 15;
								$("#velocidad").html("velocidad:"+ y);
							}
						}

						function girarderecha(x, y, z){
							object.rotation.x += z;
							object.rotation.y += y;
							camera.rotation.x += x;
						};
						function girariquierda(z, x, y){
							object.rotation.x -= z;
							object.rotation.y -= y;
							//camera.rotation.x -= x;
						};
						function nogirar(x, y , z){
							object.rotation.x -= 0;
							object.rotation.y = 0;
							camera.rotation.x = 0;

						};					

						controlsnave.moveState.right === 1 ? girarderecha(0.0, 0.04, 0.01) : nogirar();
						controlsnave.moveState.left === 1 ? girariquierda(0.01, 0.04, 0.0) : nogirar();

						controlsnave.moveState.forward === 1 ? 	acelerar(0.07, 100) : descelerar(0.01, 15) ;
						controlsnave.moveState.back === 1 ? object.rotation.z -= 0.003	: object.position.x -= 0;
						
						controlsnave.movementSpeedMultiplier === 1 ? acelerar(0.2, 250) : descelerar(0.01, 0);
						
						controlsnave.moveState.rollLeft === 1 ? object.position.z -= 50 : object.position.z -= 0;
						controlsnave.moveState.rollRight === 1 ? object.position.z += 50 : object.position.z -= 0;

					}
					animate();

				} );
				console.log("fragata cargada");
};

