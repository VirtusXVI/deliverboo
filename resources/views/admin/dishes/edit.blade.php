@extends('layouts.app')
@extends('admin.navlinks')

@section('content')
    <div class="container">
        <div class="mb-3"><strong>I campi contrassegnati con * sono obbligatori.</strong></div>
        <form method="POST" action="{{ route('admin.dishes.update', ['dish'=>$dish->id]) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="mb-3">
                <label for="name" class="form-label">Nome*</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="Nome" value="{{old('name', $dish->name)}}" required>
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Descrizione</label>
                <textarea class="form-control" id="description" name="description" placeholder="Descrizione">{{old('description', $dish->description)}}</textarea>
            </div>

            <div class="mb-3">
                <label for="ingredients" class="form-label">Ingredienti*</label>
                <input type="text" class="form-control" id="ingredients" name="ingredients" placeholder="Ingredienti" value="{{old('ingredients', $dish->ingredients)}}" required>
            </div>

            <div class="mb-3">
                <label for="price" class="form-label">Prezzo*</label>
                <input type="number" step="any" class="form-control" id="price" name="price" placeholder="Prezzo" value="{{old('price', $dish->price)}}" required minlength="1" min="0.01" max="99.99" oninvalid="this.setCustomValidity('inserire una cifra maggiore di 0 e minore di 100')" onchange="this.setCustomValidity('')">
            </div>

            <div>
                <input type="checkbox" name="is_visible" {{ $dish->is_visible ? '' : 'checked' }}> Non disponibile
            </div>

            <div class="mb-3">
                <label for="dish_image" class="form-label">Immagine</label>
                <input class="form-control" type="file" id="dish_image" name="dish_image">
            </div>
            <button type="submit" class="btn btn-primary mb-3">Submit</button>
        </form>
    </div>
@endsection