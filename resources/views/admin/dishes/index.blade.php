@extends('layouts.app')
@extends('admin.navlinks')

@section('content')

    <div class="container">
        @if (count($dishes) > 0)
            <h1 class="mb-5">I tuoi piatti:</h1>
            <div class="row row-cols-3">
                @foreach ($dishes as $dish)
                @if ($dish->is_visible == 1)
                    <div class="col mb-4">
                        <div class="card text-center p-3">
                            <h3><a class="card-title" href="{{ route('admin.dishes.show', ['dish' => $dish->id]) }}">{{ $dish->name }}</a></h3>
                        </div>
                    </div>
                @endif
            @endforeach
            </div>
        @else 
            <h2>Non hai Piatti nel Menu, prova a crearne uno nella sezione 'Crea un nuovo piatto'.</h2>
        @endif
        {{$dishes->links()}}
    </div>
@endsection