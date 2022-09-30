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
                        
                    <input class="btn btn-danger py-1 px-2" type="submit" value="Elimina Piatto" onClick="document.getElementById('id01').style.display='block'">
                    <div id="id01" class="modal">
                        <span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">&times;</span>
                        <form class="modal-content" action="{{ route('admin.dishes.destroy', $dish->id) }} " method="post">
                        @csrf
                        @method('DELETE')
                            <div class="container">
                            <h1>Elimina Piatto</h1>
                            <p>Sicuro di voler procedere?</p>
                        
                            <div class="clearfix">
                                <button type="button" class="cancelbtn" onClick="document.getElementById('id01').style.display='none'">Annulla</button>
                                <button type="button submit" class="deletebtn">Elimina</button>
                            </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection