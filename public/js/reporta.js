$(function(){
	//$('#semana').on('change', fechas);
});

var meses = ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"];
var dias = ["Domingo","Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado"];

function fechas(){
	var semana = $(this).val();
	

   var year = 2020;
  var week = 3;
  
  var sem = parseInt((semana[semana.length-2] + semana[semana.length-1]), 10);
  var año = semana[0] + semana[1] + semana[2] + semana[3];
  var añof = semana[0] + semana[1] + semana[2] + semana[3];
  // añadimos validación a la semana
  //if (week < 1 || week > 53) { alert("Error: la semana debe ser un número entre 1 y 53"); return false; }
  
  // obtenemos el primer y último día de la semana del año indicado
  var primer = new Date(año, 0, (sem - 1) * 7 + 1);
  var ultimo = new Date(añof, 0, (sem - 1) * 7 + 7);
  
  // mostramos el resultado
  document.getElementById("resultado").innerHTML = primer.getFullYear() + "<br>" +
    "El primer día de la " + sem + "<sup>a</sup> semana de " + año + " es " + primer.getDate() + " de " + meses[primer.getMonth()] + " (" + dias[primer.getDay()] + ")<br/>" +
    "El último día de la " + sem + "<sup>a</sup> semana de " + añof + " es " + ultimo.getDate() + " de " + meses[ultimo.getMonth()] + " (" + dias[ultimo.getDay()] + ")"; 
    document.getElementById("inicio").value = primer.getFullYear() + '-' + primer.getMonth() + '-' + primer.getDay();
}

var d = 1;
var l = 0;
var m = 0;
var mi = 0;
var j = 0;
var v = 0;
var s = 0;
$(document).ready(function(){
    $('#ppD').click(function(){
    	if (d == 0) {
            $('#producidoD').prop('disabled', true);
            $('#producidoD').prop('value', '0');
            sumaD();
            $('#producidoL').prop('disabled', false);
            $('#producidoM').prop('disabled', false);
            $('#producidoMi').prop('disabled', false);
            $('#producidoJ').prop('disabled', false);
            $('#producidoV').prop('disabled', false);
			$('#producidoS').prop('disabled', false);
            $('#ppL').prop('checked', false);
            $('#ppM').prop('checked', false);
            $('#ppMi').prop('checked', false);
            $('#ppJ').prop('checked', false);
            $('#ppV').prop('checked', false);
            $('#ppS').prop('checked', false);
            d++;
            l=0;
            m=0;
            mi=0;
            j=0;
            v=0;
            s=0;
        }else{
        	if (d == 1) {
        		$('#producidoD').prop('disabled', true);
        	}else{
        		$('#producidoD').prop('disabled', false);
        		sumaD();
        		d--;
        	}
        }
    });

    $('#ppL').click(function(){
    	if (l == 0) {
            $('#producidoD').prop('disabled', false);
            $('#producidoL').prop('disabled', true);
            $('#producidoL').prop('value', '0');
            sumaL();
            $('#producidoM').prop('disabled', false);
            $('#producidoMi').prop('disabled', false);
            $('#producidoJ').prop('disabled', false);
            $('#producidoV').prop('disabled', false);
			$('#producidoS').prop('disabled', false);
            $('#ppD').prop('checked', false);
            $('#ppM').prop('checked', false);
            $('#ppMi').prop('checked', false);
            $('#ppJ').prop('checked', false);
            $('#ppV').prop('checked', false);
            $('#ppS').prop('checked', false);
            d=0;
            l++;
            m=0;
            mi=0;
            j=0;
            v=0;
            s=0;
        }else{
        	if (l == 1) {
        		$('#producidoL').prop('disabled', true);
        	}else{
        		$('#producidoL').prop('disabled', false);
        		sumaL();
        		l--;
        	}
        }
    });

    $('#ppM').click(function(){
    	if (m == 0) {
            $('#producidoD').prop('disabled', false);
            $('#producidoL').prop('disabled', false);
            $('#producidoM').prop('disabled', true);
            $('#producidoM').prop('value', '0');
            sumaM();
            $('#producidoMi').prop('disabled', false);
            $('#producidoJ').prop('disabled', false);
            $('#producidoV').prop('disabled', false);
			$('#producidoS').prop('disabled', false);
            $('#ppD').prop('checked', false);
            $('#ppL').prop('checked', false);
            $('#ppMi').prop('checked', false);
            $('#ppJ').prop('checked', false);
            $('#ppV').prop('checked', false);
            $('#ppS').prop('checked', false);
            d=0;
            l=0;
            m++;
            mi=0;
            j=0;
            v=0;
            s=0;
        }else{
        	if (m == 1) {
        		$('#producidoM').prop('disabled', true);
        	}else{
        		$('#producidoM').prop('disabled', false);
        		sumaM();
        		m--;
        	}
        }
    });

    $('#ppMi').click(function(){
    	if (mi == 0) {
            $('#producidoD').prop('disabled', false);
            $('#producidoL').prop('disabled', false);
            $('#producidoM').prop('disabled', false);
            $('#producidoMi').prop('disabled', true);
            $('#producidoMi').prop('value', '0');
            sumaMi();
            $('#producidoJ').prop('disabled', false);
            $('#producidoV').prop('disabled', false);
			$('#producidoS').prop('disabled', false);
            $('#ppD').prop('checked', false);
            $('#ppL').prop('checked', false);
            $('#ppM').prop('checked', false);
            $('#ppJ').prop('checked', false);
            $('#ppV').prop('checked', false);
            $('#ppS').prop('checked', false);
            d=0;
            l=0;
            m=0;
            mi++;
            j=0;
            v=0;
            s=0;
        }else{
        	if (mi == 1) {
        		$('#producidoMi').prop('disabled', true);
        	}else{
        		$('#producidoMi').prop('disabled', false);
        		sumaMi();
        		mi--;
        	}
        }
    });

    $('#ppJ').click(function(){
    	if (j == 0) {
            $('#producidoD').prop('disabled', false);
            $('#producidoL').prop('disabled', false);
            $('#producidoM').prop('disabled', false);
            $('#producidoMi').prop('disabled', false);
            $('#producidoJ').prop('disabled', true);
            $('#producidoJ').prop('value', '0');
            sumaJ();
            $('#producidoV').prop('disabled', false);
			$('#producidoS').prop('disabled', false);
            $('#ppD').prop('checked', false);
            $('#ppL').prop('checked', false);
            $('#ppM').prop('checked', false);
            $('#ppMi').prop('checked', false);
            $('#ppV').prop('checked', false);
            $('#ppS').prop('checked', false);
            d=0;
            l=0;
            m=0;
            mi=0;
            j++;
            v=0;
            s=0;
        }else{
        	if (j == 1) {
        		$('#producidoJ').prop('disabled', true);
        	}else{
        		$('#producidoJ').prop('disabled', false);
        		sumaJ();
        		j--;
        	}
        }
    });

    $('#ppV').click(function(){
    	if (v == 0) {
            $('#producidoD').prop('disabled', false);
            $('#producidoL').prop('disabled', false);
            $('#producidoM').prop('disabled', false);
            $('#producidoMi').prop('disabled', false);
            $('#producidoJ').prop('disabled', false);
            $('#producidoV').prop('disabled', true);
            $('#producidoV').prop('value', '0');
            sumaV();
			$('#producidoS').prop('disabled', false);
            $('#ppD').prop('checked', false);
            $('#ppL').prop('checked', false);
            $('#ppM').prop('checked', false);
            $('#ppMi').prop('checked', false);
            $('#ppJ').prop('checked', false);
            $('#ppS').prop('checked', false);
            d=0;
            l=0;
            m=0;
            mi=0;
            j=0;
            v++;
            s=0;
        }else{
        	if (v == 1) {
        		$('#producidoV').prop('disabled', true);
        	}else{
        		$('#producidoV').prop('disabled', false);
        		sumaV();
        		v--;
        	}
        }
    });

    $('#ppS').click(function(){
    	if (s == 0) {
            $('#producidoD').prop('disabled', false);
            $('#producidoL').prop('disabled', false);
            $('#producidoM').prop('disabled', false);
            $('#producidoMi').prop('disabled', false);
            $('#producidoJ').prop('disabled', false);
            $('#producidoV').prop('disabled', false);
			$('#producidoS').prop('disabled', true);
			$('#producidoS').prop('value', '0');
			sumaS();
            $('#ppD').prop('checked', false);
            $('#ppL').prop('checked', false);
            $('#ppM').prop('checked', false);
            $('#ppMi').prop('checked', false);
            $('#ppJ').prop('checked', false);
            $('#ppV').prop('checked', false);
            d=0;
            l=0;
            m=0;
            mi=0;
            j=0;
            v=0;
            s++;
        }else{
        	if (s == 1) {
        		$('#producidoS').prop('disabled', true);
        	}else{
        		$('#producidoS').prop('disabled', false);
        		sumaS();
        		s--;
        	}
        }
    });
});

//domingo

$(function(){
	$('#producidoD').on('change', sumaD);
	$('#gastosD').on('change', sumaD);
	$('#otrosD').on('change', sumaD);
});

//lunes

$(function(){
	$('#producidoL').on('change', sumaL);
	$('#gastosL').on('change', sumaL);
	$('#otrosL').on('change', sumaL);
});

//martes

$(function(){
	$('#producidoM').on('change', sumaM);
	$('#gastosM').on('change', sumaM);
	$('#otrosM').on('change', sumaM);
});

//miercoles

$(function(){
	$('#producidoMi').on('change', sumaMi);
	$('#gastosMi').on('change', sumaMi);
	$('#otrosMi').on('change', sumaMi);
});

//jueves

$(function(){
	$('#producidoJ').on('change', sumaJ);
	$('#gastosJ').on('change', sumaJ);
	$('#otrosJ').on('change', sumaJ);
});

//viernes

$(function(){
	$('#producidoV').on('change', sumaV);
	$('#gastosV').on('change', sumaV);
	$('#otrosV').on('change', sumaV);
});

//sabado

$(function(){
	$('#producidoS').on('change', sumaS);
	$('#gastosS').on('change', sumaS);
	$('#otrosS').on('change', sumaS);
});

function sumaD(){
	var pro = parseInt($('#producidoD').val());
	var gas = parseInt($('#gastosD').val());
	var otro = parseInt($('#otrosD').val());
	var total = parseInt($('#totalD').val());

	total = (pro) - (gas + otro) ;

	document.getElementById("totalD").value = total;

	semanaProd();
	semanaGas();
}

function sumaL(){
	var pro = parseInt($('#producidoL').val());
	var gas = parseInt($('#gastosL').val());
	var otro = parseInt($('#otrosL').val());
	var total = parseInt($('#totalL').val());

	total = (pro) - (gas + otro) ;

	document.getElementById("totalL").value = total;

	semanaProd();
	semanaGas();
}

function sumaM(){
	var pro = parseInt($('#producidoM').val());
	var gas = parseInt($('#gastosM').val());
	var otro = parseInt($('#otrosM').val());
	var total = parseInt($('#totalM').val());

	total = (pro) - (gas + otro) ;

	document.getElementById("totalM").value = total;

	semanaProd();
	semanaGas();
}

function sumaMi(){
	var pro = parseInt($('#producidoMi').val());
	var gas = parseInt($('#gastosMi').val());
	var otro = parseInt($('#otrosMi').val());
	var total = parseInt($('#totalMi').val());

	total = (pro) - (gas + otro) ;

	document.getElementById("totalMi").value = total;

	semanaProd();
	semanaGas();
}

function sumaJ(){
	var pro = parseInt($('#producidoJ').val());
	var gas = parseInt($('#gastosJ').val());
	var otro = parseInt($('#otrosJ').val());
	var total = parseInt($('#totalJ').val());

	total = (pro) - (gas + otro) ;

	document.getElementById("totalJ").value = total;

	semanaProd();
	semanaGas();
}

function sumaV(){
	var pro = parseInt($('#producidoV').val());
	var gas = parseInt($('#gastosV').val());
	var otro = parseInt($('#otrosV').val());
	var total = parseInt($('#totalV').val());

	total = (pro) - (gas + otro) ;

	document.getElementById("totalV").value = total;

	semanaProd();
	semanaGas();
}

function sumaS(){
	var pro = parseInt($('#producidoS').val());
	var gas = parseInt($('#gastosS').val());
	var otro = parseInt($('#otrosS').val());
	var total = parseInt($('#totalS').val());

	total = (pro) - (gas + otro) ;

	document.getElementById("totalS").value = total;

	semanaProd();
	semanaGas();
}

function semanaProd(){
	var prod = parseInt($('#producidoD').val());
	var prol = parseInt($('#producidoL').val());
	var prom = parseInt($('#producidoM').val());
	var promi = parseInt($('#producidoMi').val());
	var proj = parseInt($('#producidoJ').val());
	var prov = parseInt($('#producidoV').val());
	var pros = parseInt($('#producidoS').val());
	
	var total = prod + prol + prom + promi + proj + prov + pros;

	document.getElementById("producidoSem").value = total;
	pago();

}

function semanaGas(){
	var gasd = parseInt($('#gastosD').val());
	var otrod = parseInt($('#otrosD').val());
	var gasl = parseInt($('#gastosL').val());
	var otrol = parseInt($('#otrosL').val());
	var gasm = parseInt($('#gastosM').val());
	var otrom = parseInt($('#otrosM').val());
	var gasmi = parseInt($('#gastosMi').val());
	var otromi = parseInt($('#otrosMi').val());
	var gasj = parseInt($('#gastosJ').val());
	var otroj = parseInt($('#otrosJ').val());
	var gasv = parseInt($('#gastosV').val());
	var otrov = parseInt($('#otrosV').val());
	var gass = parseInt($('#gastosS').val());
	var otros = parseInt($('#otrosS').val());
	
	var total = gasd + otrod+ gasl + otrol + gasm + otrom + gasmi + otromi + gasj + 
	otroj + gasv + otrov + gass + otros;

	document.getElementById("gastosSem").value = total;
	pago();

}

function pago(){
	var producidos = parseInt($('#producidoSem').val());
	var gastos = parseInt($('#gastosSem').val());

	var total = producidos - gastos;

	document.getElementById("pagar").value = total;
}