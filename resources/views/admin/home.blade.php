@extends('layouts.app')
@extends('admin.navlinks')

@section('content')
    <div class="home container">
        <h1>{{$user->restaurant_name}}</h1>
        <div>{{$user->email}}</div>
        <div>Indirizzo: {{$user->address}}</div>
        <div>Partita IVA: {{$user->p_iva}}</div>
    </div>
    {{-- qui stampiamo le informazioni del ristorante (anche perchè non serve a un cazzo) --}}
@endsection