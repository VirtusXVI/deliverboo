@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <div class="mb-3"><strong>I campi contrassegnati con * sono obbligatori.</strong></div>
                    <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data" onsubmit="return handleData()"
                        oninput='password_confirmation.setCustomValidity(password_confirmation.value != password.value ? "Le Password non corrispondono" : "")'>
                        @csrf

                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <div class="form-group row">
                            <label for="restaurant_name" class="col-md-4 col-form-label text-md-right">{{ __('Restaurant Name*') }}</label>

                            <div class="col-md-6">
                                <input id="restaurant_name" type="text" class="form-control @error('restaurant_name') is-invalid @enderror" name="restaurant_name" value="{{ old('restaurant_name') }}" required autocomplete="restaurant_name" autofocus>

                                @error('restaurant_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password*') }}</label>

                            <div class="col-md-6">
                                <input id="password" 
                                    type="password" 
                                    class="form-control @error('password') is-invalid @enderror" 
                                    name="password" 
                                    required autocomplete="new-password" 
                                    minlength="8">

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password*') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" 
                                    type="password" 
                                    class="form-control" 
                                    name="password_confirmation" 
                                    required autocomplete="new-password" 
                                    minlength="8">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address*') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="address" class="col-md-4 col-form-label text-md-right">{{ __('Indirizzo*') }}</label>

                            <div class="col-md-6">
                                <input id="address" type="text" class="form-control @error('address') is-invalid @enderror" name="address" value="{{ old('address') }}" required autocomplete="address" autofocus>

                                @error('address')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="p_iva" class="col-md-4 col-form-label text-md-right">{{ __('Partita Iva*') }}</label>

                            <div class="col-md-6">
                                <input id="p_iva" 
                                    pattern="[0-9]+" 
                                    type="text" 
                                    minlength="11" maxlength="11" 
                                    class="form-control @error('p_iva') is-invalid @enderror" 
                                    oninvalid="this.setCustomValidity('11 cifre (solo numeri)')"
                                    onchange="this.setCustomValidity('')"
                                    name="p_iva" 
                                    value="{{ old('p_iva') }}" 
                                    required autocomplete="p_iva" autofocus>

                                    @error('p_iva')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="restaurant_image" class="form-label">Immagine</label>
                            <input class="form-control" type="file" id="restaurant_image" name="restaurant_image">
                        </div>

                        <div class="form-check mb-3">
                            @foreach ($categories as $category)
                                <input class="form-check-input" type="checkbox" value="{{$category->id}}" id="category-{{$category->id}}" name="categories[]">
                                <label class="form-check-label" for="category-{{$category->id}}">
                                    {{$category->name}}
                                </label>
                                <br>
                            @endforeach
                            <span style="color:red" id="category-error"></span>
                            @error('categories')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        function handleData() {
            let form_data = new FormData(document.querySelector("form"));
            let categoryError = document.getElementById('category-error');

            if(!form_data.has("categories[]")) {
                categoryError.innerHTML = 'Seleziona almeno una categoria';
                return false;
            } else {
                return true;
            }
        }
    </script>
</div>
@endsection
