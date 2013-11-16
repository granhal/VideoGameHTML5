function moon(){
				var moonTexture = THREE.ImageUtils.loadTexture( "textures/planets/moon_1024.jpg" );
				var materialMoon = new THREE.MeshPhongMaterial( { color: 0xffffff, map: moonTexture } );

				this.meshMoon = new THREE.Mesh( geometry, materialMoon );
				meshMoon.position.set( radius * 5, 0, 0 );
				meshMoon.scale.set( moonScale, moonScale, moonScale );
				scene.add( meshMoon );
				//meshMoon.add(camera);
}