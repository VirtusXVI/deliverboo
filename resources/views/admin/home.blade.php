@extends('layouts.app')

@section('content')
    <h1>{{$user->restaurant_name}}</h1>
    {{-- QUI CI VA TANTA DI QUELLA ROBA CHE MANUEL BESTEMMIERA'
    ZITTO BADDY --}}
    <a href="{{route('admin.dishes.index')}}">Vai ai Piatti</a>
    <a href="{{route('admin.dishes.create')}}">Vai alla Creazione</a>
@endsection