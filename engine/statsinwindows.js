function statsinwindows(){
				stats = new Stats();
				stats.setMode(1); // 0: fps, 1: ms

				stats.domElement.style.position = 'absolute';
				stats.domElement.style.left = '100px';
				stats.domElement.style.top = '100px';

				container.appendChild( stats.domElement );


				stats2 = new Stats();

				stats2.setMode(0); // 0: fps, 1: ms

				stats2.domElement.style.position = 'absolute';
				stats2.domElement.style.left = '200px';
				stats2.domElement.style.top = '100px';

				container.appendChild( stats2.domElement );
}