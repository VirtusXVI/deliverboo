@extends('layouts.app')

@section('content')
    <div class="container">
        
        @foreach ($dishes as $dish)
            <div>
                <a href="{{ route('admin.dishes.show', ['dish' => $dish->id]) }}">{{ $dish->name }}</a>
            </div>
        @endforeach

    </div>
@endsection