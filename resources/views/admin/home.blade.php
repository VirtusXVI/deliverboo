@extends('layouts.app')
@extends('admin.navlinks')

@section('content')
    <div class="container">
        <h1>{{$user->restaurant_name}}</h1>
    </div>
    {{-- qui stampiamo le informazioni del ristorante (anche perchè non serve a un cazzo) --}}
@endsection