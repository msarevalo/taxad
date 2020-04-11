function barra(){
	var valor = parseInt($('#input-range-bar').val());
	document.getElementById("input-range-box").value=valor;
}

function caja(){
	var valor = parseInt($('#input-range-box').val());
	document.getElementById("input-range-bar").value=valor;
}
