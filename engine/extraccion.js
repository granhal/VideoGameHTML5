function extraccion(id){

	if(id == 1){
		var distancia = distanciaPlaneta;
	}

if(distancia <= 10000){
	$("#extraccion").show("fold");
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
			clearInterval(refrescarExtraer);
			$("#extraccion").hide("fold");
			$("div.bar#barraextraccion").css("width", "0");
		}
	}
							
	if(extraer >= 0 ){
		this.refrescarExtraer = setInterval(extraerSumar, velocidad);
	}
}else{
	console.log("lejos");
							$("div#sincombustibleayuda")
								.show("fold")
								.html("<button id='cerrarCombustible' class='close'>&times;</button>Estas demasiado lejos para extraer mineral.");
}	
	this.stopExtraer = function(){
		$("#extraccion").hide("fold");
		clearInterval(refrescarExtraer);
	}
};
