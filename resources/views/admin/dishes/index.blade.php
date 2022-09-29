@extends('layouts.app')
@extends('admin.navlinks')

@section('content')

    <div class="container">
        <h1>I tuoi piatti:</h1>
        @if ($deleted === 'yes')
            <div class="alert alert-success" role="alert">
                Piatto eliminato con successo
            </div>
        @endif
        @if ($dishes)
            @foreach ($dishes as $dish)
                <div class="card mb-3">
                    <h3><a class="card-title" href="{{ route('admin.dishes.show', ['dish' => $dish->id]) }}">{{ $dish->name }}</a></h3>
                </div>
            @endforeach
        @endif
    </div>
@endsection