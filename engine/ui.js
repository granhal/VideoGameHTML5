$(function() {
		
			$("a#ayuda").tooltip();

		    $("div#introducirCoordenadas").hide().draggable();
		 	$("div#pilotoAutomatico").hide().draggable();
		 	$("div#sincombustibleayuda").hide().draggable();
		 	$("div#radar").draggable();
			$("div#controles").draggable();
			$("div#creditos").draggable();

			$("input[name=solonum]").keydown(function(event) {
			   if(event.shiftKey){
			        event.preventDefault();
			   }
			 
			   if (event.keyCode == 46 || event.keyCode == 8 || event.keyCode == 109 || event.keyCode == 189){
			   } else {
			        if (event.keyCode < 95) {
			          if (event.keyCode < 48 || event.keyCode > 57) {
			                event.preventDefault();
			          }
			        } else {
			              if (event.keyCode < 96 || event.keyCode > 105) {
			                  event.preventDefault();
			              }
			        }
			      }
			   });


		    $("button#coordenadas").click(function() {
		      $("div#introducirCoordenadas").show( "fold" );
		      $("#irx").focus();
		    });

		    $("input[name=solonum]").click(function(){
		    	$(this).focus();
		    });
		    
		    $("button#cancelarpilotoautomatico").click(function(){
		    	if(typeof pilotoautomatico == 'object') {
					pilotoautomatico.stop();
					clearInterval(refrescarTiempoViaje);
					$("span#duracionDelViaje").html("<center>Piloto automático desactivado.</center>");
					$("span#consumoViaje").html("");
				}
		    });
		    $("button#cancelarExtraccion").click(function(){
		    	if(typeof extraerSumar == 'function'){
					stopExtraer();
				}
		    });
		    $("button#cerrarLejos").click(function(){
		    	$("#extraccion").hide();
		    });

		    $("#extraccion").hide();
			$("a.extraer").click(function(){
				if(typeof pilotoautomatico == 'object') {
					pilotoautomatico.stop();
					clearInterval(refrescarTiempoViaje);
				}
				if(typeof extraerSumar == 'function'){
					stopExtraer();
				}
  				var id = $( this ).attr("id");
  				extraccion(id);
  				
			});


			$("a.acercarse").click(function(){
				if(typeof pilotoautomatico == 'object') {
					pilotoautomatico.stop();
					clearInterval(refrescarTiempoViaje);
				}

  				var id = $( this ).attr("id");
  				acercarse(id);
  				
			});

			$("button#iracoordenadas").click(function(){
				if(typeof pilotoautomatico == 'object') {
					pilotoautomatico.stop();
					clearInterval(refrescarTiempoViaje);
				}
				var irx = $("input#irx").val();
				var iry = $("input#iry").val();
				var irz = $("input#irz").val();
				//console.log(irx+" "+iry+" "+irz);
  				acercarse(0,irx,iry,irz);
  				
			});

 			
		   	$("button#cerrarIntroducirCoordenadas").click(function(){
				$("div#introducirCoordenadas").hide();
			});

			$("button#verSalirUniverso").click(function(){
				var pagina = 'http://cantely.com/demo/lab3dviewver/';
				document.location.href=pagina;
			});

			$("button#verControles").click(function(){
				$( "div#controles" ).toggle("fold");
			});

			$("button#verCreditos").click(function(){
				$("div#creditos").toggle("fold");
			});	

			$("button#verRadar").click(function(){
				$("div#radar").toggle("fold");
			});	

			$("button#cerrarControles").click(function(){
				$("div#controles").hide();
			});

			$("button#cerrarCreditos").click(function(){
				$("div#creditos").hide();
			});

			$("button#cerrarRadar").click(function(){
				$("div#radar").hide();
			});

			$("button#cerrarMenuInferior").click(function(){
				$("div#menuInferior").hide();
			});
 			
});