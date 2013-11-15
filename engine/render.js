function render() {

				// rotate the planet and clouds

				var delta = clock.getDelta();

				meshPlanet.rotation.y += rotationSpeed * delta;
				meshClouds.rotation.y += 5 * rotationSpeed * delta;

				// slow down as we approach the surface

				dPlanet = camera.position.length();


				//dProvidenceVec.subVectors( camera.position, meshProvidence.position );
				//dProvidence = dProvidenceVec.length();

				dMoonVec.subVectors( camera.position, meshMoon.position );
				dMoon = dMoonVec.length();

				if ( dMoon < dPlanet ) {

					d = ( dMoon - radius * moonScale * 1.01 );

				} else {

					d = ( dPlanet - radius * 1.01 );

				}

				//controlsnave.movementSpeed = 0.02 * d;
				//controlsnave.update( delta );

				renderer.clear();
				composer.render( delta );
}