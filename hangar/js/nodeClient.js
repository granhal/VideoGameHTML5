var socket = io.connect( 'http://192.168.1.105:3000' );

$( "#messageForm" ).submit( function() {
	var nameVal = $( "#nameInput" ).val();
	var msg = $( "#messageInput" ).val();
	
	socket.emit( 'message', { name: nameVal, message: msg } );
	
	// Ajax call for saving datas
	$.ajax({
		url: "./ajax/insertNewMessage.php",
		type: "POST",
		data: { name: nameVal, message: msg },
		success: function(data) {
			
		}
	});
	
	return false;
});

socket.on( 'message', function( data ) {
	if (data.message != ''){
	var actualContent = $( "#messages" ).html();
	var date = new Date();
	var newMsgContent = '<span style="color:#ccc">'+ date.getDate() +'/'+ date.getMonth() +'/'+ date.getFullYear() +' '+ date.getHours() +':'+ date.getMinutes() + ':' + date.getSeconds() +'</span><span style="color:#0CF"> '+ data.name + '</span> : ' + data.message + '<br>';
	var content = newMsgContent + actualContent;


	$( "#messages" ).html( content );
	//$("#messageInput").val('');
	//$("#chat").hide();
	}

});