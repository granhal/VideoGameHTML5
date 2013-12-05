		
		function jugador(){

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
					
					spacialship.position.set(700,75,150);
					spacialship.rotation.set(0,0,0);
					spacialship.scale.set(0.1,0.1,0.1);
					scene.add(spacialship);
				
					this.controlsnave = new THREE.FlyControls(spacialship);
					controlsnave.rollSpeed = 0.08;
					controlsnave.autoForward = false;
					controlsnave.dragToLook = false;

					spacialship.add(camera);
					spacialship.add(particles);
					//spacialship.add(effect.oCamera)

					this.nave = spacialship;
					
					particles.position.set(15,-1,0);
					particles.rotation.set(0,0,0);
					particles.scale.set(0.000009,0.000009,0.000009);
					
				});

			console.log("fragata cargada");
			particulasmotor();
		};


		function particulasmotor(){
			var container, stats;
			var particles, geometry, materials = [], i, h, color, sprite, size;

				geometry = new THREE.Geometry();
				sprite1 = THREE.ImageUtils.loadTexture( "textures/sprites/snowflake1.png" );
				sprite2 = THREE.ImageUtils.loadTexture( "textures/sprites/snowflake2.png" );

				for ( i = 0; i < 15; i ++ ) {
					var vertex = new THREE.Vector3();
					vertex.x = Math.random() * 20000 - 10000;
					vertex.y = Math.random() * 20000 - 10000;
					vertex.z = Math.random() * 20000 - 10000;
					geometry.vertices.push( vertex );
				}

				// color, sprite, tamaño
				parameters = [ [ [1.0, 0.2, 0.5], sprite2, 4],
							   [ [0.90, 0.05, 0.5], sprite1, 7 ]
							   ];

				for ( i = 0; i < parameters.length; i ++ ) {
					color  = parameters[i][0];
					sprite = parameters[i][1];
					size   = parameters[i][2];
					materials[i] = new THREE.ParticleSystemMaterial( { 
						size: size, 
						map: sprite, 
						blending: THREE.AdditiveBlending, 
						depthTest: false, 
						transparent : true 
					});
					materials[i].color.setHSL( color[0], color[1], color[2] );
					this.particles = new THREE.ParticleSystem( geometry, materials[i] );
				}
			
		};