function crearProvidence(){
		var providenceMaterial = new THREE.MeshPhongMaterial({map: THREE.ImageUtils.loadTexture('json/Providence_difusofinal.jpg') });
		loader = new THREE.JSONLoader();
		loader.load('json/nave.json', function (providenceGeometria) {

			meshProvidence = new THREE.Mesh(providenceGeometria, providenceMaterial);		
			meshProvidence.position.set( radius * 15, 0, 0 );
			meshProvidence.scale.set = (providenceScale, providenceScale,providenceScale);
			scene.add(meshProvidence);

		});
		
}