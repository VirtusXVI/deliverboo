@extends('layouts.app')
@extends('admin.navlinks')

@section('content')

    <div class="container">
        @if (count($dishes) > 0)
            <h1>I tuoi piatti:</h1>
            @foreach ($dishes as $dish)
                @if ($dish->is_visible == 1)
                    <div class="card mb-3">
                        <h3><a class="card-title" href="{{ route('admin.dishes.show', ['dish' => $dish->id]) }}">{{ $dish->name }}</a></h3>
                    </div>
                @endif
            @endforeach
        @else 
            <h2>Non hai Piatti nel Menu, prova a crearne uno nella sezione 'Crea un nuovo piatto'.</h2>
        @endif
    </div>
@endsection