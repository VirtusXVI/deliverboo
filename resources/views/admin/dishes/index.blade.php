@extends('layouts.app')
@extends('admin.navlinks')

@section('content')

    <div class="container">
        @if (count($dishes) > 0)
            <h1 class="mb-5">I tuoi piatti:</h1>
            <div class="row row-cols-3">
                @foreach ($dishes as $dish)
                    {{-- Image --}}
                    <div class="col mb-4">
                        <div class="card text-center p-3">
                            @if ($dish->dish_image)
                                <img src="{{ asset('storage/' . $dish->dish_image) }}" alt="{{ $dish->title }}">
                            @endif
                            <h3><a class="card-title" href="{{ route('admin.dishes.show', ['dish' => $dish->id]) }}">{{ $dish->name }}</a></h3>
                        </div>
                    </div>
            @endforeach
            </div>
        @else 
            <h2>Non hai Piatti nel Menu, prova a crearne uno nella sezione 'Crea un nuovo piatto'.</h2>
        @endif
        {{$dishes->links()}}
    </div>
@endsection