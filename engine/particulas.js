
function particulas(){
			var container, stats;
			var particles, geometry, materials = [], i, h, color, sprite, size;
			animateParticulas();

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

					
					//scene.add( particles );

				}
			
			function animateParticulas() {

				requestAnimationFrame( animateParticulas );
				renderar();

			}

			//var renderer = new THREE.WebGLRenderer( { clearAlpha: 1 } );
			function renderar() {

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

				//renderer.renderar( scene, camera );

			}
};