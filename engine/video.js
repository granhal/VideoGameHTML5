				function video(){
				
				video = document.getElementById( 'video' );

				texturev = new THREE.Texture( video );
				texturev.minFilter = THREE.LinearFilter;
				texturev.magFilter = THREE.LinearFilter;
				texturev.format = THREE.RGBFormat;
				texturev.generateMipmaps = false;

				//texturev.repeat.set( 4, 4 ); 

				materialv = new THREE.MeshLambertMaterial({  map : texturev });

				planev = new THREE.Mesh(new THREE.PlaneGeometry(200, 150), materialv);
				planev.side = THREE.DoubleSide;
				planev.position.x = 100;
				planev.rotation.y = 1;

				//planev.rotation.z = Math.PI / 2;

				scene.add(planev);
				}