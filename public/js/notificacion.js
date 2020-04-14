function notificaciones(id){	

	//var usuario = $(this).val();
	//ajax
	$.get('/api/notificaciones/'+id+'/alertas', function(data) {
		var largo= data.length;
		//console.log(html_select);
		if (largo!=0) {
			$('#not').html(largo);
		}
	});
	//alert(id);
}