		var combustible = 100;
			var gastarcombustible = function(){
					var maxcombustible = 99;
					var mincombusitlbe = 0;

					if(velocidadReal > 10){
							combustible -= velocidadReal/50;
					}else{
						if(combustible <= maxcombustible){
							combustible += 1.9;
						}
					}
					if(combustible <= 0){
						combustible = mincombusitlbe;
						controlsnave.moveState.right = 0;
						controlsnave.moveState.left = 0;
						$( "div#sincombustible" ).show();
					}else{
						$( "div#sincombustible" ).hide();
					}
			}