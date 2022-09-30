@extends('layouts.app')
@extends('admin.navlinks')

@section('content')

    <div class="container">
        <h1>I tuoi piatti:</h1>
        @if ($dishes)
            @foreach ($dishes as $dish)
                @if ($dish->is_visible == 1)
                    <div class="card mb-3">
                        <h3><a class="card-title" href="{{ route('admin.dishes.show', ['dish' => $dish->id]) }}">{{ $dish->name }}</a></h3>
                    </div>
                @endif
            @endforeach
        @endif
    </div>
@endsection