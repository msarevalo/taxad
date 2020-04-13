function barra(id){
	var valor = parseInt($('#' + id).val());
	var numero = id.split('-');
	
	document.getElementById("input-range-box-" + numero[3]).value=valor;
}

function caja(id){
	var valor = parseInt($('#' + id).val());
	var numero = id.split('-');
	
	document.getElementById("input-range-bar-" + numero[3]).value=valor;
}


function ingresado(cantidad, valor){
	var suma = 0;
	var contador = 0;
	for(var i=1; i<=cantidad;i++){
		var val = parseInt($('#input-range-box-' + i).val());
		if(val!==0){
			contador++;
		}
		suma += val;
	}
	var html = "";
	if (suma>valor) {
		html = "<p style='color: red'>" + suma + "</p>";
		document.getElementById('enviar').disabled=true;
	}else{
		if (suma<valor) {
			html = "<p style='color: blue'>" + suma + "</p>";
			document.getElementById('enviar').disabled=true;
		}else{
			html = "<p style='color: green'>" + suma + "</p>";
			if (contador==cantidad) {
				$('#enviar').removeAttr("disabled");
			}			
		}
	}
	$('#ingreso').html(html);
}

function ciclo(valor){
	var ingre = '<p>0</p>';
	$('#ingreso').html(ingre);
	document.getElementById('enviar').disabled=true;
	var cantidad = $("#cantidad").val();
	var html = "";
	for(var i=1; i<=cantidad;i++){
		html += 
			'<div id"gasto' + i + '" name="gasto' + i + '">' +
				'<div class="form-group row">' +
    				'<label for="fecha" class="col-md-4 col-form-label text-md-right">Fecha</label>' +
					'<div class="col-md-6">' + 
        				'<input id="fecha' + i + '" type="date" class="form-control" name="fecha' + i + '" required autofocus>' +
    				'</div>' +
				'</div>' +
				'<div class="form-group row">' +
					'<label for="categoria-'+i+'" class="col-md-4 col-form-label text-md-right">Valor del gasto</label>' +
					'<div class="col-md-6" style="display: inline-block; width: 100%">' +
						'<div class="input-group">' +
							'<input type="range" min="1" max="'+ valor +'" step="1" onchange="barra(this.id), ingresado('+cantidad+', '+valor+')" class="input-range-bar" id="input-range-bar-'+ i +'" value="0">' +
							'<div class="input-group-addon">' + 
								'<input type="number" min="1" max="'+ valor +'" step="1" onchange="caja(this.id), ingresado('+cantidad+', '+valor+')" class="input-range-box" id="input-range-box-'+ i +'" value="0">' +
							'</div>' +
						'</div>' +
					'</div>' +
				'</div>' +
				'<div class="form-group row">' +
					'<label for="categoria-'+i+'" class="col-md-4 col-form-label text-md-right">Categoria Gasto</label>' +
					'<div class="col-md-6" style="display: inline-block; width: 100%">' +
	    				'<select class="form-control mb-2 buscador" name="categoria-'+i+'" id="categoria-'+i+'" required style="text-transform: capitalize" onchange="selectDescripcion(this.value, '+i+')">' +
							'<option selected value="" disabled>Seleccione una categoria</option>';
							html += selectCategoria('categoria-'+i);
						html += '</select>' +
					'</div>' +
				'</div>' +
				'<div class="form-group row">' +
					'<label for="descripcion-'+i+'" class="col-md-4 col-form-label text-md-right">Descripcion Gasto</label>' +
					'<div class="col-md-6" style="display: inline-block; width: 100%">' +
	    				'<select class="form-control mb-2 buscador" name="descripcion-'+i+'" id="descripcion-'+i+'" required style="text-transform: capitalize">' +
							'<option selected value="" disabled>Seleccione una descripcion</option>' +
						'</select>' +
					'</div>' +
				'</div>' +
				'<div id="otro-'+i+'"></div>' +
				'<div class="form-group row">' +
    				'<label for="factura-' +i+ '" class="col-md-4 col-form-label text-md-right">Factura</label>' +
					'<div class="col-md-6">' +
						'<input id="factura-' +i+ '" type="file" class="" name="factura-'+i+'" required autofocus accept="application/pdf">' +
    				'</div>' +
				'</div>' +
			'</div><hr>';
	}
	$('#respuesta').html(html);
}


function selectCategoria(id){
	var html_select='';
	//ajax
	$.get('/api/categoria', function(data) {
		var html_select='<option selected value="" disabled>Seleccione una categoria</option>';
		for (var i=0; i<data.length; i++)
			html_select += '<option value="'+data[i].id+'">'+data[i].categoria+'</option>';
		//console.log(html_select);
		//return html_select;
		$(document).ready(function(){
			$('.buscador').select2();
		});
		$('#'+id).html(html_select);
	});
}

function selectDescripcion(id, conteo){
	var html_select='';
	//ajax
	$.get('/api/categoria/'+id+'/descripciones', function(data) {
		var html_select='<option selected value="" disabled>Seleccione una descripcion</option>';
		for (var i=0; i<data.length; i++){
			if (id==32) {
				html_select += '<option value="'+data[i].id+'" selected>'+data[i].descripcion+'</option>';
			}else{
				html_select += '<option value="'+data[i].id+'">'+data[i].descripcion+'</option>';
			}
		}
		//console.log(html_select);
		//return html_select;
		$(document).ready(function(){
			$('.buscador').select2();
		});
		$('#descripcion-'+conteo).html(html_select);
		if (id==32) {
			var otro = 
			'<div class="form-group row">' +
    			'<label for="otros-'+conteo+'" class="col-md-4 col-form-label text-md-right">Otro</label>' +
    			'<div class="col-md-6">' +
        			'<input id="otros-'+conteo+'" placeholder="Escriba la descripcion del gasto" type="text" class="form-control" name="otros-'+conteo+'" required autofocus>' +
				'</div>' +
			'</div>';
			$('#otro-'+conteo).html(otro);
		}else{
			var otro = "<div></div>"
			$('#otro-'+conteo).html(otro);
		}
	});
}

