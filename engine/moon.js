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
				tuboMesh.position.set(-1000, 0, 0 );
				tuboMesh.rotation.set(0,90,0);
				scene.add( tuboMesh );

		}

		function enemigo(){

						var ProvidenceMaterial = new THREE.MeshPhongMaterial({map: THREE.ImageUtils.loadTexture('models/Providence_difusofinal.jpg') });
						loader = new THREE.JSONLoader();
						loader.load('models/providence_01.js', function (ProvidenceGeometria) {
							this.Providence = new THREE.Mesh(ProvidenceGeometria, ProvidenceMaterial);
							Providence.scale.set(15, 15, 15 );
							Providence.position.set(-1000,0,0);
							Providence.rotation.set(0,0,90);
							Providence.id = "Providence";

							/*this.controlsnave = new THREE.FlyControls(Providence);
							controlsnave.rollSpeed = 0.08;
							controlsnave.autoForward = false;
							controlsnave.dragToLook = true;

							Providence.add(camera);
							//spacialship.add(particles);

							this.nave = Providence;*/
							scene.add(Providence);
							
						});
					console.log("enemigo cargado");
		}

