		function moon(){
				var moonTextura = THREE.ImageUtils.loadTexture( "textures/planets/moon_1024.jpg" );
				var moonMaterial = new THREE.MeshPhongMaterial( { color: 0xffffff, map: moonTextura } );

				moonGeometry = new THREE.SphereGeometry( 1737/2, 35, 100 );
				moonGeometry.computeTangents();
				this.meshMoon = new THREE.Mesh( moonGeometry, moonMaterial );
				meshMoon.position.set(-384400/3, 0, 0 );

				scene.add( meshMoon );

		}

		function tubo(){
				var tuboTextura = THREE.ImageUtils.loadTexture( "textures/planets/tubo_1024.jpg" );
				var tuboMaterial = new THREE.MeshPhongMaterial( { color: 0xffffff, map: tuboTextura } );

				tuboGeometry = new THREE.TorusGeometry(300,40,8,20);
				tuboGeometry.computeTangents();
				this.tuboMesh = new THREE.Mesh( tuboGeometry, tuboMaterial );
				tuboMesh.position.set(13000, 0, 0 );
				tuboMesh.rotation.set(0,90,0);
				scene.add( tuboMesh );

		}

		function tuboOBJ(){

				tuboTexture = new THREE.Texture();
				tuboLoadTexture = new THREE.ImageLoader();
				tuboLoadTexture.load( 'models/fragata_01.jpg', function ( image ) {
					tuboTexture.image = image;
					tuboTexture.needsUpdate = true;
				} );

				tuboLoader = new THREE.OBJLoader();
					tuboLoader.load( 'models/fragata_01.obj', function ( tubo ) {
					tubo.traverse( function ( child ) {
						if ( child instanceof THREE.Mesh ) {
							child.material.map = tuboTexture;
						}
					} );
					
					tubo.position.set(15000,0,0);
					tubo.rotation.set(0,90,0);
					tubo.scale.set(15,15,15);
					scene.add(tubo);

					/*tubo.add(particles);
				
					requestAnimationFrame( animate );
					
					particles.position.set(24,1,0);
					particles.scale.set(0.00009,0.00009,0.00009);*/
					
				});
					console.log("tubo cargado");
		}




		function particulastubo(){
			var container, stats;
			var particles, geometry, materials = [], i, h, color, sprite, size;
			

				geometry = new THREE.Geometry();
				sprite1 = THREE.ImageUtils.loadTexture( "textures/sprites/fire.png" );
				sprite2 = THREE.ImageUtils.loadTexture( "textures/sprites/fire2.png" );

				for ( i = 0; i < 15; i ++ ) {

					var vertex = new THREE.Vector3();
					vertex.x = Math.random() * 20000 - 10000;
					vertex.y = Math.random() * 20000 - 10000;
					vertex.z = Math.random() * 20000 - 10000;

					geometry.vertices.push( vertex );

				}

				
				// color, sprite, tamaño

				parameters = [ [ [1.0, 0.2, 0.5], sprite2, 2],
							   [ [0.90, 0.05, 0.5], sprite1, 8 ]
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
			


			this.renderParticulas = function renderar() {

				var time = Date.now() * 0.00005;
				for ( i = 0; i < scene.children.length; i ++ ) {
					var object = scene.children[ i ];
					if ( object instanceof THREE.ParticleSystem ) {
						object.rotation.y = time * ( i < 4 ? i + 1 : - ( i + 1 ) );
					}
				}

				for ( i = 0; i < materials.length; i ++ ) {
					color = parameters[i][0];
					h = ( 360 * ( color[0] + time ) % 360 ) / 360;
					materials[i].color.setHSL( h, color[1], color[2] );
				}


			}
		};