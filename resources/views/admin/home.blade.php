@extends('layouts.app')

@section('content')
    <h1>{{$user->restaurant_name}}</h1>
    <nav>
        <ul>
            <li class="mr-3"><a href="{{route('admin.dishes.index')}}">Vai ai Piatti</a></li>
            <li class="mr-3"><a href="{{route('admin.dishes.create')}}">Vai alla Creazione</a></li>
        </ul>
    </nav>
@endsection