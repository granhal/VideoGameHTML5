function renderer(){
				this.renderer = new THREE.WebGLRenderer( { alpha: false } );
				renderer.setSize( window.innerWidth, window.innerHeight );
				renderer.sortObjects = false;
				renderer.autoClear = false;

				container.appendChild( renderer.domElement );
}