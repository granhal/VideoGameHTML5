			function luces(){
				dirLight = new THREE.DirectionalLight( 0xc2c2c2 );
				dirLight.position.set( 2000, 1000, 1 ).normalize();
				scene.add( dirLight );

				ambientLight = new THREE.AmbientLight( 0x4f3f1f );
				scene.add( ambientLight );
			}