@extends('autenticacion')

<title>Taxad | Taxis</title>

@section('formulario')
    <form action="{{route('taxi.soatcargar', $taxi->id)}}" method="post" enctype="multipart/form-data">
    	@csrf
        <div class="form-group row">
            <label for="name" class="col-md-1 col-form-label">{{ __('SOAT') }}</label>

            <div class="col-6">
            	<input id="soat" type="file" class="" name="soat" value="{{ old('soat') }}" required autocomplete="soat" autofocus accept="application/pdf">
            </div>
        </div>
        <button class="btn btn-primary" type="submit">Agregar SOAT</button>
    </form>
@endsection