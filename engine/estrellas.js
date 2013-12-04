		function estrellas(){

				var i, r = 7371, starsGeometry = [ new THREE.Geometry(), new THREE.Geometry() ];

				for ( i = 0; i < 350; i ++ ) {

					var vertex = new THREE.Vector3();
					vertex.x = Math.random() * 2 - 1;
					vertex.y = Math.random() * 2 - 1;
					vertex.z = Math.random() * 2 - 1;
					vertex.multiplyScalar( r );

					starsGeometry[ 0 ].vertices.push( vertex );

				}

				for ( i = 0; i < 1500; i ++ ) {

					var vertex = new THREE.Vector3();
					vertex.x = Math.random() * 2 - 1;
					vertex.y = Math.random() * 2 - 1;
					vertex.z = Math.random() * 2 - 1;
					vertex.multiplyScalar( r );

					starsGeometry[ 1 ].vertices.push( vertex );

				}

				var starsMaterials = [
					new THREE.ParticleSystemMaterial( { color: 0x97c5ca, size: 0.9, sizeAttenuation: true } ),
					new THREE.ParticleSystemMaterial( { color: 0x8474b4, size: 1, sizeAttenuation: true } ),
					new THREE.ParticleSystemMaterial( { color: 0x634b4b, size: 1.8, sizeAttenuation: true } ),
					new THREE.ParticleSystemMaterial( { color: 0x947c4e, size: 1.5, sizeAttenuation: true } ),
					new THREE.ParticleSystemMaterial( { color: 0x4f5b2a, size: 2, sizeAttenuation: true } ),
					new THREE.ParticleSystemMaterial( { color: 0x6c6607, size: 1, sizeAttenuation: true } )
				];

				for ( i = 10; i < 40; i ++ ) {

					this.stars = new THREE.ParticleSystem( starsGeometry[ i % 2 ], starsMaterials[ i % 6 ] );

					stars.rotation.x = Math.random() * 15;
					stars.rotation.y = Math.random() * 10;
					stars.rotation.z = Math.random() * 5;

					s = i * 6;
					stars.scale.set( s, s, s );

					stars.matrixAutoUpdate = true;
					stars.updateMatrix();

					scene.add( stars );

				}
		}