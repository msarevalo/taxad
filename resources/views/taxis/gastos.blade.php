@extends('autenticacion')

@section('formulario')

@dump($w[0] . $w[1] . $w[2] . $w[3] . ' ' . $w[6] . $w[7])

<input type="date" name="" max="{{$w}}">

@endsection