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