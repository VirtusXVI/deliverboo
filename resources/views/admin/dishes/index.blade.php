@extends('layouts.app')
@extends('admin.navlinks')

@section('content')

    <div class="container">
        @if (count($dishes) > 0)
            <h1 class="mb-5">I tuoi piatti:</h1>
            <div class="row row-cols-2 row-cols-md-3 row-cols-xl-4">
                @foreach ($dishes as $dish)
                    {{-- Image --}}
                    <div class="col mb-4">
                        <div class="card">
                            @if ($dish->dish_image)
                                <img class="card-img-top" style="height: 100px; object-fit: cover;" src="{{ asset('storage/' . $dish->dish_image) }}" alt="{{ $dish->title }}">
                            @else 
                                <img class="card-img-top" style="height: 100px; object-fit: cover;" src="https://s3-eu-west-1.amazonaws.com/tpd/logos/55be6ade0000ff000581b457/0x0.png" alt="{{ $dish->title }}">
                            @endif
                            <div class="card-body">
                                <h5 class="card-title overflow-hidden" style="height: 20px;">
                                    <a class="card-title" href="{{ route('admin.dishes.show', ['dish' => $dish->id]) }}">{{$dish->name}}</a>
                                </h5>
                            </div>
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

