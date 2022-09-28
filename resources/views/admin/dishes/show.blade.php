@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card" style="width: 18rem;">
            {{-- <img src="..." class="card-img-top" alt="..."> --}}
            <div class="card-body">
                <h5 class="card-title">{{ $dish->name }}</h5>
                <p class="card-text">{{ $dish->description }}</p>
                <p class="card-text">{{ $dish->ingredients }}</p>
                <p class="card-title">{{ $dish->price }}</p>
                <a href="#" class="btn btn-primary">Modifica</a>
            </div>
        </div>
    </div>
@endsection