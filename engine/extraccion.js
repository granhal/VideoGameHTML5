function extraccion(id){

	if(id == 1){
		this.distancia = distanciaPlaneta;
	}

	if(distancia <= 10000){
		$("#extraccion").show("fold");
		$("div#sincombustibleayuda").hide();
		var extraer = 0;
		var velocidad = 200; 
		var resta = velocidad/10;
		var tiempo = velocidad*velocidad; 
		var duracion = tiempo/velocidad;

		this.extraerSumar = function(){
			extraer += 1;
			tiempo -= duracion;
			$("span#duracionExtraccion").html("<span style='color:#0CF'>"+parseInt(extraer)+"</span>%<br> <span class='icon-time'></span> Tiempo estimado: "+parseInt(tiempo/1000-resta)+" seg.");
			$("div.bar#barraextraccion").css("width", extraer);

			if(extraer == 100){
				stopExtraer();
				//aumentar nivel de minería y bajar 1 la velocidad de extracción
			}

			//la variable distanciaPlaneta no sirve porque solo usa la distancia al planeta, debe ser una variable global para que sirva para todas las cosas
			//queda esa variable provisional
			if(distanciaPlaneta >= 10000){
				stopExtraer();
				$("div#sincombustibleayuda")
					.show("fold")
					//el boton no cierra
					.html("<button id='cerrar' class='close'>&times;</button>Estas demasiado lejos para extraer mineral.");
					$("button#cerrar").click(function(){
						$("div#sincombustibleayuda").hide();
	 				});
			}
		}
						
		if(extraer >= 0 ){
			this.refrescarExtraer = setInterval(extraerSumar, velocidad);
		}

	}else{				
		$("div#sincombustibleayuda")
			.show("fold")
			//el boton no cierra
			.html("<button id='cerrar' class='close'>&times;</button>Estas demasiado lejos para extraer mineral.");
			$("button#cerrar").click(function(){
				$("div#sincombustibleayuda").hide();
	 		});
	}	

	this.stopExtraer = function(){
		$("#extraccion").hide("fold");
		$("div.bar#barraextraccion").css("width", "0");
		clearInterval(refrescarExtraer);
	}
};
