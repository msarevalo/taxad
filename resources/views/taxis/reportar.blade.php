@extends('autenticacion')

@section('formulario')

@php($semana = date('W'))
@php($semana = $semana-1)
@php($año = date('Y'))

@if($semana<=9)
	@php($maximo= $año . '-W0' . $semana)
@else
	@php($maximo=$año . '-W' . $semana)
@endif
@php($dia=date("Y-m-d"))
<form action="{{ route('taxi.reportar', $taxi->id) }}" method="post">
            @csrf
	<div class="form-group row">
	    <label for="placa" class="col-md-4 col-form-label text-md-right">{{ __('Placa') }}</label>
	    <div class="col-md-3">
	        <input id="placa" type="text" class="form-control @error('placa') is-invalid @enderror" name="placa" value="{{$taxi->placa}}" disabled>

	        @error('document')
	            <span class="invalid-feedback" role="alert">
	                <strong>{{ $message }}</strong>
	            </span>
	        @enderror
	    </div>
	</div>

	<div class="form-group row">
	    <label for="fecha" class="col-md-4 col-form-label text-md-right">{{ __('Fecha Actual') }}</label>
	    <div class="col-md-3">
	        <input id="fecha" type="date" class="form-control @error('fecha') is-invalid @enderror" name="fecha" value="{{$dia}}" disabled>

	        @error('document')
	            <span class="invalid-feedback" role="alert">
	                <strong>{{ $message }}</strong>
	            </span>
	        @enderror
	    </div>
	</div>

	<div class="form-group row">
	    <label for="semana" class="col-md-4 col-form-label text-md-right">{{ __('Semana') }}</label>

	    <div class="col-md-6">
	        <input id="semana" type="week" class="form-control @error('semana') is-invalid @enderror" name="semana" value="{{ old('semana') }}" max="{{$maximo}}" required autocomplete="semana" autofocus>

	        @error('semana')
	            <span class="invalid-feedback" role="alert">
	                <strong>{{ $message }}</strong>
	            </span>
	        @enderror
	    </div>
	</div>

	<table class="table col-16">
	        <tbody>
	        	<tr>
	        		<th>
		        		<table>
		        			<thead><tr><td colspan="3" style="text-align: center;">Domingo</td></tr></thead>
							<tr>
								<th>
									<div class="">
		    							<label for="producidoD" class="col-md-4 col-form-label text-md-right">{{ __('Producido') }}</label>
		    					</th>
		    					<th>
		    						<div class="col-md-12">
		        						<input id="producidoD" type="number" class="form-control @error('producidoD') is-invalid @enderror" name="producidoD" value="0" required autocomplete="producidoD" autofocus disabled>

		        					@error('producidoD')
		            					<span class="invalid-feedback" role="alert">
		                					<strong>{{ $message }}</strong>
		            					</span>
		        					@enderror
		    						</div>
									
								</th>
								<th>
									<div class="col-md-6">
		        						<input id="ppD" type="radio" checked name="ppD" value="{{ old('ppD') }}" autocomplete="pp" autofocus title="Pico y Placa">
		    						</div>
		    						</div>
								</th>
							</tr>
							<tr>
								<th>
									<div class="form-group row">
		    							<label for="gastosD" class="col-md-4 col-form-label text-md-right">{{ __('Gastos') }}</label>
		    					</th>
		    					<th colspan="2">
		    						<div class="col-md-12">
		        						<input id="gastosD" type="number" class="form-control @error('gastosD') is-invalid @enderror" name="gastosD" value="0" required autocomplete="gastosD" autofocus>

		        						@error('gastos')
		            						<span class="invalid-feedback" role="alert">
		                						<strong>{{ $message }}</strong>
		            						</span>
		        						@enderror
		    						</div>
									</div>
								</th>
							</tr>
							<tr>
								<th>
									<div class="form-group row">
		    							<label for="otrosD" class="col-md-4 col-form-label text-md-right">{{ __('Otros') }}</label>
		    					</th>
		    					<th colspan="2">
		    						<div class="col-md-12">
		        						<input id="otrosD" type="number" class="form-control @error('otrosD') is-invalid @enderror" name="otrosD" value="0" required autocomplete="otrosD" autofocus>

		        						@error('otros')
		            						<span class="invalid-feedback" role="alert">
		                						<strong>{{ $message }}</strong>
		            						</span>
		        						@enderror
		    						</div>
									</div>
								</th>
							</tr>
							<tr>
								<th>
									<div class="form-group row">
	    								<label for="totalD" class="col-md-4 col-form-label text-md-right">{{ __('Total') }}</label>
	    						</th>
	    						<th colspan="2">
	    							<div class="col-md-12">
	        							<input id="totalD" type="number" class="form-control @error('totalD') is-invalid @enderror" name="total" value="0" autocomplete="totalD" autofocus disabled>

	        							@error('totalD')
	            							<span class="invalid-feedback" role="alert">
	                							<strong>{{ $message }}</strong>
	            							</span>
	        							@enderror
	    							</div>
									</div>
								</th>
							</tr>
						</table>
					</th>
					<th>
						<table>
							<thead><tr><td colspan="3" style="text-align: center;">Lunes</td></tr></thead>
							<tr>
								<th>
									<div class="form-group row">
		    							<label for="producidoL" class="col-md-4 col-form-label text-md-right">{{ __('Producido') }}</label>
		    					</th>
		    					<th>
		    						<div class="col-md-12">
		        						<input id="producidoL" type="number" class="form-control @error('producidoL') is-invalid @enderror" name="producidoL" value="0" required autocomplete="producidoL" autofocus>

		        					@error('producidoL')
		            					<span class="invalid-feedback" role="alert">
		                					<strong>{{ $message }}</strong>
		            					</span>
		        					@enderror
		    						</div>
									</div>
								</th>
								<th>
									<div class="col-md-6">
		        						<input id="ppL" type="radio" name="ppL" value="{{ old('ppL') }}" autocomplete="ppL" autofocus title="Pico y Placa">
		    						</div>
		    						</div>
								</th>
							</tr>
							<tr>
								<th>
									<div class="form-group row">
		    							<label for="gastosL" class="col-md-4 col-form-label text-md-right">{{ __('Gastos') }}</label>
		    					</th>
		    					<th colspan="2">
		    						<div class="col-md-12">
		        						<input id="gastosL" type="number" class="form-control @error('gastosL') is-invalid @enderror" name="gastosL" value="0" required autocomplete="gastosL" autofocus>

		        						@error('gastosL')
		            						<span class="invalid-feedback" role="alert">
		                						<strong>{{ $message }}</strong>
		            						</span>
		        						@enderror
		    						</div>
									</div>
								</th>
							</tr>
							<tr>
								<th>
									<div class="form-group row">
		    							<label for="otrosL" class="col-md-4 col-form-label text-md-right">{{ __('Otros') }}</label>
		    					</th>
		    					<th colspan="2">
		    						<div class="col-md-12">
		        						<input id="otrosL" type="number" class="form-control @error('otrosL') is-invalid @enderror" name="otrosL" value="0" required autocomplete="otrosL" autofocus>

		        						@error('otrosL')
		            						<span class="invalid-feedback" role="alert">
		                						<strong>{{ $message }}</strong>
		            						</span>
		        						@enderror
		    						</div>
									</div>
								</th>
							</tr>
							<tr>
								<th>
									<div class="form-group row">
	    								<label for="totalL" class="col-md-4 col-form-label text-md-right">{{ __('Total') }}</label>
	    						</th>
	    						<th colspan="2">
	    							<div class="col-md-12">
	        							<input id="totalL" type="number" class="form-control @error('totalL') is-invalid @enderror" name="totalL" value="0" autocomplete="totalL" autofocus disabled>

	        							@error('totalL')
	            							<span class="invalid-feedback" role="alert">
	                							<strong>{{ $message }}</strong>
	            							</span>
	        							@enderror
	    							</div>
									</div>
								</th>
							</tr>
						</table>
					</th>
				</tr>
				<tr>
	        		<th>
		        		<table>
							<thead><tr><td colspan="3" style="text-align: center;">Martes</td></tr></thead>
							<tr>
								<th>
									<div class="form-group row">
		    							<label for="producidoM" class="col-md-4 col-form-label text-md-right">{{ __('Producido') }}</label>
		    					</th>
		    					<th>
		    						<div class="col-md-12">
		        						<input id="producidoM" type="number" class="form-control @error('producidoM') is-invalid @enderror" name="producidoM" value="0" required autocomplete="producidoM" autofocus>

		        					@error('producidoM')
		            					<span class="invalid-feedback" role="alert">
		                					<strong>{{ $message }}</strong>
		            					</span>
		        					@enderror
		    						</div>
									</div>
								</th>
								<th>
									<div class="col-md-6">
		        						<input id="ppM" type="radio" name="ppM" value="{{ old('ppM') }}" autocomplete="ppM" autofocus title="Pico y Placa">
		    						</div>
		    						</div>
								</th>
							</tr>
							<tr>
								<th>
									<div class="form-group row">
		    							<label for="gastosM" class="col-md-4 col-form-label text-md-right">{{ __('Gastos') }}</label>
		    					</th>
		    					<th colspan="2">
		    						<div class="col-md-12">
		        						<input id="gastosM" type="number" class="form-control @error('gastosM') is-invalid @enderror" name="gastosM" value="0" required autocomplete="gastosM" autofocus>

		        						@error('gastosM')
		            						<span class="invalid-feedback" role="alert">
		                						<strong>{{ $message }}</strong>
		            						</span>
		        						@enderror
		    						</div>
									</div>
								</th>
							</tr>
							<tr>
								<th>
									<div class="form-group row">
		    							<label for="otrosM" class="col-md-4 col-form-label text-md-right">{{ __('Otros') }}</label>
		    					</th>
		    					<th colspan="2">
		    						<div class="col-md-12">
		        						<input id="otrosM" type="number" class="form-control @error('otrosM') is-invalid @enderror" name="otrosM" value="0" required autocomplete="otrosM" autofocus>

		        						@error('otrosM')
		            						<span class="invalid-feedback" role="alert">
		                						<strong>{{ $message }}</strong>
		            						</span>
		        						@enderror
		    						</div>
									</div>
								</th>
							</tr>
							<tr>
								<th>
									<div class="form-group row">
	    								<label for="totalM" class="col-md-4 col-form-label text-md-right">{{ __('Total') }}</label>
	    						</th>
	    						<th colspan="2">
	    							<div class="col-md-12">
	        							<input id="totalM" type="number" class="form-control @error('totalM') is-invalid @enderror" name="totalM" value="0" autocomplete="totalM" autofocus disabled>

	        							@error('totalM')
	            							<span class="invalid-feedback" role="alert">
	                							<strong>{{ $message }}</strong>
	            							</span>
	        							@enderror
	    							</div>
									</div>
								</th>
							</tr>
						</table>
					</th>
					<th>
						<table>
							<thead><tr><td colspan="3" style="text-align: center;">Miercoles</td></tr></thead>
							<tr>
								<th>
									<div class="form-group row">
		    							<label for="producidoMi" class="col-md-4 col-form-label text-md-right">{{ __('Producido') }}</label>
		    					</th>
		    					<th>
		    						<div class="col-md-12">
		        						<input id="producidoMi" type="number" class="form-control @error('producidoMi') is-invalid @enderror" name="producidoMi" value="0" required autocomplete="producidoMi" autofocus>

		        					@error('producidoMi')
		            					<span class="invalid-feedback" role="alert">
		                					<strong>{{ $message }}</strong>
		            					</span>
		        					@enderror
		    						</div>
									</div>
								</th>
								<th>
									<div class="col-md-6">
		        						<input id="ppMi" type="radio" name="ppMi" value="{{ old('ppMi') }}" autocomplete="ppMi" autofocus title="Pico y Placa">
		    						</div>
		    						</div>
								</th>
							</tr>
							<tr>
								<th>
									<div class="form-group row">
		    							<label for="gastosMi" class="col-md-4 col-form-label text-md-right">{{ __('Gastos') }}</label>
		    					</th>
		    					<th colspan="2">
		    						<div class="col-md-12">
		        						<input id="gastosMi" type="number" class="form-control @error('gastosMi') is-invalid @enderror" name="gastosMi" value="0" required autocomplete="gastosMi" autofocus>

		        						@error('gastosMi')
		            						<span class="invalid-feedback" role="alert">
		                						<strong>{{ $message }}</strong>
		            						</span>
		        						@enderror
		    						</div>
									</div>
								</th>
							</tr>
							<tr>
								<th>
									<div class="form-group row">
		    							<label for="otrosMi" class="col-md-4 col-form-label text-md-right">{{ __('Otros') }}</label>
		    					</th>
		    					<th colspan="2">
		    						<div class="col-md-12">
		        						<input id="otrosMi" type="number" class="form-control @error('otrosMi') is-invalid @enderror" name="otrosMi" value="0" required autocomplete="otrosMi" autofocus>

		        						@error('otrosMi')
		            						<span class="invalid-feedback" role="alert">
		                						<strong>{{ $message }}</strong>
		            						</span>
		        						@enderror
		    						</div>
									</div>
								</th>
							</tr>
							<tr>
								<th>
									<div class="form-group row">
	    								<label for="totalMiMi" class="col-md-4 col-form-label text-md-right">{{ __('Total') }}</label>
	    						</th>
	    						<th colspan="2">
	    							<div class="col-md-12">
	        							<input id="totalMi" type="number" class="form-control @error('totalMi') is-invalid @enderror" name="totalMi" value="0" autocomplete="totalMi" autofocus disabled>

	        							@error('totalMi')
	            							<span class="invalid-feedback" role="alert">
	                							<strong>{{ $message }}</strong>
	            							</span>
	        							@enderror
	    							</div>
									</div>
								</th>
							</tr>
						</table>
					</th>
				</tr>
				<tr>
	        		<th>
		        		<table>
							<thead><tr><td colspan="3" style="text-align: center;">Jueves</td></tr></thead>
							<tr>
								<th>
									<div class="form-group row">
		    							<label for="producidoJ" class="col-md-4 col-form-label text-md-right">{{ __('Producido') }}</label>
		    					</th>
		    					<th>
		    						<div class="col-md-12">
		        						<input id="producidoJ" type="number" class="form-control @error('producidoJ') is-invalid @enderror" name="producidoJ" value="0" required autocomplete="producidoJ" autofocus>

		        					@error('producidoJ')
		            					<span class="invalid-feedback" role="alert">
		                					<strong>{{ $message }}</strong>
		            					</span>
		        					@enderror
		    						</div>
									</div>
								</th>
								<th>
									<div class="col-md-6">
		        						<input id="ppJ" type="radio" name="ppJ" value="{{ old('ppJ') }}" autocomplete="ppJ" autofocus title="Pico y Placa">
		    						</div>
		    						</div>
								</th>
							</tr>
							<tr>
								<th>
									<div class="form-group row">
		    							<label for="gastosJ" class="col-md-4 col-form-label text-md-right">{{ __('Gastos') }}</label>
		    					</th>
		    					<th colspan="2">
		    						<div class="col-md-12">
		        						<input id="gastosJ" type="number" class="form-control @error('gastosJ') is-invalid @enderror" name="gastosJ" value="0" required autocomplete="gastosJ" autofocus>

		        						@error('gastosJ')
		            						<span class="invalid-feedback" role="alert">
		                						<strong>{{ $message }}</strong>
		            						</span>
		        						@enderror
		    						</div>
									</div>
								</th>
							</tr>
							<tr>
								<th>
									<div class="form-group row">
		    							<label for="otrosJ" class="col-md-4 col-form-label text-md-right">{{ __('Otros') }}</label>
		    					</th>
		    					<th colspan="2">
		    						<div class="col-md-12">
		        						<input id="otrosJ" type="number" class="form-control @error('otrosJ') is-invalid @enderror" name="otrosJ" value="0" required autocomplete="otrosJ" autofocus>

		        						@error('otrosJ')
		            						<span class="invalid-feedback" role="alert">
		                						<strong>{{ $message }}</strong>
		            						</span>
		        						@enderror
		    						</div>
									</div>
								</th>
							</tr>
							<tr>
								<th>
									<div class="form-group row">
	    								<label for="totalJ" class="col-md-4 col-form-label text-md-right">{{ __('Total') }}</label>
	    						</th>
	    						<th colspan="2">
	    							<div class="col-md-12">
	        							<input id="totalJ" type="number" class="form-control @error('totalJ') is-invalid @enderror" name="totalJ" value="0" autocomplete="totalJ" autofocus disabled>

	        							@error('totalJ')
	            							<span class="invalid-feedback" role="alert">
	                							<strong>{{ $message }}</strong>
	            							</span>
	        							@enderror
	    							</div>
									</div>
								</th>
							</tr>
						</table>
					</th>
					<th>
						<table>
							<thead><tr><td colspan="3" style="text-align: center;">Viernes</td></tr></thead>
							<tr>
								<th>
									<div class="form-group row">
		    							<label for="producidoV" class="col-md-4 col-form-label text-md-right">{{ __('Producido') }}</label>
		    					</th>
		    					<th>
		    						<div class="col-md-12">
		        						<input id="producidoV" type="number" class="form-control @error('producidoV') is-invalid @enderror" name="producidoV" value="0" required autocomplete="producidoV" autofocus>

		        					@error('producidoV')
		            					<span class="invalid-feedback" role="alert">
		                					<strong>{{ $message }}</strong>
		            					</span>
		        					@enderror
		    						</div>
									</div>
								</th>
								<th>
									<div class="col-md-6">
		        						<input id="ppV" type="radio" name="ppV" value="{{ old('ppV') }}" autocomplete="ppV" autofocus title="Pico y Placa">
		    						</div>
		    						</div>
								</th>
							</tr>
							<tr>
								<th>
									<div class="form-group row">
		    							<label for="gastosV" class="col-md-4 col-form-label text-md-right">{{ __('Gastos') }}</label>
		    					</th>
		    					<th colspan="2">
		    						<div class="col-md-12">
		        						<input id="gastosV" type="number" class="form-control @error('gastosV') is-invalid @enderror" name="gastosV" value="0" required autocomplete="gastosV" autofocus>

		        						@error('gastosV')
		            						<span class="invalid-feedback" role="alert">
		                						<strong>{{ $message }}</strong>
		            						</span>
		        						@enderror
		    						</div>
									</div>
								</th>
							</tr>
							<tr>
								<th>
									<div class="form-group row">
		    							<label for="otrosV" class="col-md-4 col-form-label text-md-right">{{ __('Otros') }}</label>
		    					</th>
		    					<th colspan="2">
		    						<div class="col-md-12">
		        						<input id="otrosV" type="number" class="form-control @error('otrosV') is-invalid @enderror" name="otrosV" value="0" required autocomplete="otrosV" autofocus>

		        						@error('otrosV')
		            						<span class="invalid-feedback" role="alert">
		                						<strong>{{ $message }}</strong>
		            						</span>
		        						@enderror
		    						</div>
									</div>
								</th>
							</tr>
							<tr>
								<th>
									<div class="form-group row">
	    								<label for="totalV" class="col-md-4 col-form-label text-md-right">{{ __('Total') }}</label>
	    						</th>
	    						<th colspan="2">
	    							<div class="col-md-12">
	        							<input id="totalV" type="number" class="form-control @error('totalV') is-invalid @enderror" name="totalV" value="0" autocomplete="totalV" autofocus disabled>

	        							@error('totalV')
	            							<span class="invalid-feedback" role="alert">
	                							<strong>{{ $message }}</strong>
	            							</span>
	        							@enderror
	    							</div>
									</div>
								</th>
							</tr>
						</table>
					</th>
				</tr>
				<tr>
	        		<th>
		        		<table>
							<thead><tr><td colspan="3" style="text-align: center;">Sabado</td></tr></thead>
							<tr>
								<th>
									<div class="form-group row">
		    							<label for="producidoS" class="col-md-4 col-form-label text-md-right">{{ __('Producido') }}</label>
		    					</th>
		    					<th>
		    						<div class="col-md-12">
		        						<input id="producidoS" type="number" class="form-control @error('producidoS') is-invalid @enderror" name="producidoS" value="0" required autocomplete="producidoS" autofocus>

		        					@error('producidoS')
		            					<span class="invalid-feedback" role="alert">
		                					<strong>{{ $message }}</strong>
		            					</span>
		        					@enderror
		    						</div>
									</div>
								</th>
								<th>
									<div class="col-md-6">
		        						<input id="ppS" type="radio" name="ppS" value="{{ old('ppS') }}" autocomplete="ppS" autofocus title="Pico y Placa">
		    						</div>
		    						</div>
								</th>
							</tr>
							<tr>
								<th>
									<div class="form-group row">
		    							<label for="gastosS" class="col-md-4 col-form-label text-md-right">{{ __('Gastos') }}</label>
		    					</th>
		    					<th colspan="2">
		    						<div class="col-md-12">
		        						<input id="gastosS" type="number" class="form-control @error('gastosS') is-invalid @enderror" name="gastosS" value="0" required autocomplete="gastosS" autofocus>

		        						@error('gastos')
		            						<span class="invalid-feedback" role="alert">
		                						<strong>{{ $message }}</strong>
		            						</span>
		        						@enderror
		    						</div>
									</div>
								</th>
							</tr>
							<tr>
								<th>
									<div class="form-group row">
		    							<label for="otrosS" class="col-md-4 col-form-label text-md-right">{{ __('Otros') }}</label>
		    					</th>
		    					<th colspan="2">
		    						<div class="col-md-12">
		        						<input id="otrosS" type="number" class="form-control @error('otrosS') is-invalid @enderror" name="otrosS" value="0" required autocomplete="otrosS" autofocus>

		        						@error('otrosS')
		            						<span class="invalid-feedback" role="alert">
		                						<strong>{{ $message }}</strong>
		            						</span>
		        						@enderror
		    						</div>
									</div>
								</th>
							</tr>
							<tr>
								<th>
									<div class="form-group row">
	    								<label for="totalS" class="col-md-4 col-form-label text-md-right">{{ __('Total') }}</label>
	    						</th>
	    						<th colspan="2">
	    							<div class="col-md-12">
	        							<input id="totalS" type="number" class="form-control @error('totalS') is-invalid @enderror" name="totalS" value="0" autocomplete="totalS" autofocus disabled>

	        							@error('totalS')
	            							<span class="invalid-feedback" role="alert">
	                							<strong>{{ $message }}</strong>
	            							</span>
	        							@enderror
	    							</div>
									</div>
								</th>
							</tr>
						</table>
					</th>
					<th>
						<table>
							<thead><tr><td colspan="3" style="text-align: center;">TOTAL SEMANA</td></tr></thead>
							<tbody>
								<tr>
									<th>
										<div class="">
		    								<label for="producidoSem" class="col-md-4 col-form-label text-md-right">{{ __('Producidos') }}</label>
		    						</th>
		    						<th>
		    							<div class="col-md-12">
		        							<input id="producidoSem" type="number" class="form-control @error('producidoSem') is-invalid @enderror" name="producidoSem" value="0" required autocomplete="producidoSem" autofocus disabled>

		        						@error('producidoSem')
		            						<span class="invalid-feedback" role="alert">
		                						<strong>{{ $message }}</strong>
		            						</span>
		        						@enderror
		    							</div>
									
									</th>
								</tr>

								<tr>
									<th>
										<div class="">
		    								<label for="gastosSem" class="col-md-4 col-form-label text-md-right">{{ __('Gastos') }}</label>
		    						</th>
		    						<th>
		    							<div class="col-md-12">
		        							<input id="gastosSem" type="number" class="form-control @error('gastosSem') is-invalid @enderror" name="gastosSem" value="0" required autocomplete="gastosSem" autofocus disabled>

		        						@error('gastosSem')
		            						<span class="invalid-feedback" role="alert">
		                						<strong>{{ $message }}</strong>
		            						</span>
		        						@enderror
		    							</div>
									
									</th>
								</tr>
							</tbody>
						</table>
						<table>
							<thead><tr><td colspan="3" style="text-align: center;">TOTAL A PAGAR</td></tr></thead>.
							<tbody>
								<tr>
									<th>
										<div class="">
		    								<label for="pagar" class="col-md-4 col-form-label text-md-right">{{ __('Pago') }}</label>
		    						</th>
		    						<th>
		    							<div class="col-md-12">
		        							<input id="pagar" type="number" class="form-control @error('pagar') is-invalid @enderror" name="pagar" value="0" required autocomplete="pagar" autofocus disabled>

		        						@error('pagar')
		            						<span class="invalid-feedback" role="alert">
		                						<strong>{{ $message }}</strong>
		            						</span>
		        						@enderror
		    							</div>
									
									</th>
								</tr>
							</tbody>
						</table>
						<div class="form-group row mb-0">
	                		<div class="col-md-6 offset-md-4">
	                    		<button type="submit" class="btn btn-primary">
	                        		{{ __('Registrar') }}
	                    		</button>
	                		</div>
	            		</div>
					</th>
				</tr>
	        </tbody>
	</table>
</form>
	<!--<input type="date" name="inicio" id="inicio" value="">
	<input type="date" name="fin" id="fin">-->


	<div id="resultado"></div>
@endsection

@section('scripts')
	<script src="/js/reporta.js"></script>
@endsection