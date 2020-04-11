@extends('autenticacion')

@section('formulario')

@dump($w[0] . $w[1] . $w[2] . $w[3] . ' ' . $w[6] . $w[7])
@dump($val)

<input type="date" name="" max="{{$w}}">
<br />

<div class="form-group">
	<label for="quantity" class="col-sm-2 control-label">Quantity</label>
	<div class="col-sm-10">
		<div class="input-group">
			<input type="range" min="0" max="{{$val}}" step="1" onchange="barra()" class="input-range-bar" id="input-range-bar" value="0">
			<div class="input-group-addon">
				<input type="number" min="1" max="{{$val}}" step="1" onchange="caja()" class="input-range-box" id="input-range-box">
			</div>
		</div>
	</div>
</div>



<style type="text/css">
	input[type=range] { 
	-webkit-appearance: none;
	width: 70%;
}

input[type=range]::-webkit-slider-runnable-track {
	width: 100%;
	height: 8px;
	cursor: pointer;
	box-shadow: 1.4px 1.4px 3px rgba(0, 0, 0, 0.25), 0px 0px 1.4px rgba(13, 13, 13, 0.25);
	background: #c8c8c8;
	border-radius: 25px;
	border: 1px solid #afafaf;
}

input[type=range]::-webkit-slider-thumb {
	box-shadow: 1.4px 1.4px 3px rgba(0, 0, 0, 0.25), 0px 0px 1.4px rgba(13, 13, 13, 0.25);
	border: 0.2px solid #35a3c7;
	height: 20px;
	width: 20px;
	border-radius: 50px;
	background: #132644;
	cursor: pointer;
	-webkit-appearance: none;
	margin-top: -7px;
}

input[type=range]:focus::-webkit-slider-runnable-track {
	background: #c8c8c8;
}
</style>
@endsection
	
@section('scripts')
	<script src="../../../../js/gastos.js"></script>
@endsection