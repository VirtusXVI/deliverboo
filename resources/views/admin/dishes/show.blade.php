@extends('layouts.app')
@extends('admin.navlinks')

@section('content')
    <div class="container">
        <div class="card" style="width: 18rem;">
            {{-- <img src="..." class="card-img-top" alt="..."> --}}
            <div class="card-body">
                <h5 class="card-title">{{ $dish->name }}</h5>
                <p class="card-text">{{ $dish->description }}</p>
                <p class="card-text">{{ $dish->ingredients }}</p>
                <p class="card-title">{{ $dish->price }}</p>
                <div class="d-flex">
                    <a href="{{ route('admin.dishes.edit', ['dish'=>$dish->id]) }}" class="btn btn-primary py-1 px-2 mr-2">Modifica</a>
                    <form action="{{ route('admin.dishes.destroy', $dish->id) }}" method="post">
                        @csrf
                        @method('DELETE')
            
                        <input class="btn btn-danger py-1 px-2" type="submit" value="Elimina Piatto" onClick="return confirm('Sicuro di voler concellare il piatto?')">
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection