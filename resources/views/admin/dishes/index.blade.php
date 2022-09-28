@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>I tuoi piatti:</h1>
        @foreach ($dishes as $dish)
            <div class="card mb-3">
                <h3><a class="card-title" href="{{ route('admin.dishes.show', ['dish' => $dish->id]) }}">{{ $dish->name }}</a></h3>
            </div>
        @endforeach
    </div>
@endsection