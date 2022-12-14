@extends('layouts.app')
@extends('admin.navlinks')

@section('content')
    <div class="show container">
        <div class="card w-100">
            <div class="card-body text-center">
                {{-- Image --}}
                @if ($dish->dish_image)
                    <img class="card-img-top" style="height: 300px; object-fit: cover;" src="{{ asset('storage/' . $dish->dish_image) }}" alt="{{ $dish->title }}">
                @else 
                    <img class="card-img-top" style="height: 300px; object-fit: cover;" src="https://s3-eu-west-1.amazonaws.com/tpd/logos/55be6ade0000ff000581b457/0x0.png" alt="{{ $dish->title }}">
                @endif
                <h1 class="mb-3">{{ $dish->name }}</h1>
                <p class="mb-3">Descrizione: {{ $dish->description }}</p>
                <div class="mb-3">Ingredienti: {{ $dish->ingredients }}</div>
                <div class="mb-4">Prezzo: {{ $dish->price }}€</div>
                <div>
                    <a href="{{ route('admin.dishes.edit', ['dish'=>$dish->id]) }}" class="btn btn-primary py-1 px-2 mr-2">Modifica</a>

                    <input class="btn btn-danger py-1 px-2" type="submit" value="Elimina Piatto" onClick="document.getElementById('ms_pop-up').style.display='block'">
                </div>
            </div>
        </div>
    </div>
    <div id="ms_pop-up">
        <form action="{{ route('admin.dishes.destroy', $dish->id) }} " method="post">
        @csrf
        @method('DELETE')
            <div>
                <span onclick="document.getElementById('ms_pop-up').style.display='none'" title="Close Modal">&times;</span>
                <h2>A T T E N Z I O N E</h2>
                <p>Stai per eliminare un piatto, sicuro di voler procedere?</p>

                <div>
                    <button type="button" class="cancelbtn btn btn-primary mr-3" onClick="document.getElementById('ms_pop-up').style.display='none'">Annulla</button>
                    <button type="button submit" class="deletebtn btn btn-danger">Elimina</button>
                </div>
            </div>
        </form>
    </div>
@endsection