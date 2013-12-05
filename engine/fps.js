		function fps(){
				stats = new Stats();
				stats.setMode(1); // 0: fps, 1: ms

				stats.domElement.style.position = 'absolute';
				stats.domElement.style.left = '10px';
				stats.domElement.style.top = '10px';

				container.appendChild( stats.domElement );


				stats2 = new Stats();

				stats2.setMode(0); // 0: fps, 1: ms

				stats2.domElement.style.position = 'absolute';
				stats2.domElement.style.left = '90px';
				stats2.domElement.style.top = '10px';

				container.appendChild( stats2.domElement );
		}