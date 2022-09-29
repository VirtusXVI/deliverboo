@extends('layouts.app')
@extends('admin.navlinks')

@section('content')
    <h1>{{$user->restaurant_name}}</h1>
    {{-- qui stampiamo le informazioni del ristorante (anche perchè non serve a un cazzo) --}}
@endsection