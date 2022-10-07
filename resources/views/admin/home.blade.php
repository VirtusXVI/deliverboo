@extends('layouts.app')
@extends('admin.navlinks')

@section('content')
    <div class="card w-50 mx-auto mt-5">
        @if ($user->restaurant_image)
            <img class="card-img-top" style="height: 200px; object-fit: cover;" src="{{asset('storage/' . $user->restaurant_image)}}" alt="{{$user->restaurant_name}}">
        @else 
            <img class="card-img-top" style="height: 200px; object-fit: cover;" src="https://media-cdn.tripadvisor.com/media/photo-s/1a/b8/46/6d/london-stock.jpg" alt="{{ $user->restaurant_name }}">
        @endif
        
        <div class="card-body">
            <h2 class="card-title">{{$user->restaurant_name}}</h2>
        </div>
        <ul class="list-group list-group-flush">
            <li class="list-group-item"><strong>Email:</strong> {{$user->email}}</li>
            <li class="list-group-item"><strong>Indirizzo:</strong> {{$user->address}}</li>
            <li class="list-group-item"><strong>Partita IVA:</strong> {{$user->p_iva}}</li>
        </ul>
    </div>
@endsection