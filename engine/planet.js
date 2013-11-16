		function planet(){
				var cloudsTexture   = THREE.ImageUtils.loadTexture( "textures/planets/earth_clouds_1024.png" );
				var planetTexture   = THREE.ImageUtils.loadTexture( "textures/planets/earth_atmos_2048.jpg" );			
				var normalTexture   = THREE.ImageUtils.loadTexture( "textures/planets/earth_normal_2048.jpg" );
				var specularTexture = THREE.ImageUtils.loadTexture( "textures/planets/earth_specular_2048.jpg" );
				var materialClouds = new THREE.MeshLambertMaterial( { color: 0xffffff, map: cloudsTexture, transparent: true } );
				var shader = THREE.ShaderLib[ "normalmap" ];
				var uniforms = THREE.UniformsUtils.clone( shader.uniforms );

				uniforms[ "tNormal" ].value = normalTexture;
				uniforms[ "uNormalScale" ].value.set( 0.85, 0.85 );

				uniforms[ "tDiffuse" ].value = planetTexture;
				uniforms[ "tSpecular" ].value = specularTexture;

				uniforms[ "enableAO" ].value = false;
				uniforms[ "enableDiffuse" ].value = true;
				uniforms[ "enableSpecular" ].value = true;

				uniforms[ "uDiffuseColor" ].value.setHex( 0xffffff );
				uniforms[ "uSpecularColor" ].value.setHex( 0x333333 );
				uniforms[ "uAmbientColor" ].value.setHex( 0x000000 );

				uniforms[ "uShininess" ].value = 15;
				var parameters = {

					fragmentShader: shader.fragmentShader,
					vertexShader: shader.vertexShader,
					uniforms: uniforms,
					lights: true,
					fog: true

				};

				var materialNormalMap = new THREE.ShaderMaterial( parameters );


				geometry = new THREE.SphereGeometry( radius*2, 35, 100 );
				geometry.computeTangents();

				meshPlanet = new THREE.Mesh( geometry, materialNormalMap );
				meshPlanet.rotation.y = 0;
				meshPlanet.rotation.z = tilt;
				scene.add( meshPlanet );

				meshClouds = new THREE.Mesh( geometry, materialClouds );
				meshClouds.scale.set( cloudsScale, cloudsScale, cloudsScale );
				meshClouds.rotation.z = tilt;
				scene.add( meshClouds );
		}