@section('navlinks')
    <li class="mr-4"><a href="{{route('admin.home')}}"><strong>Home</strong></a></li>
    <li class="mr-4"><a href="{{route('admin.dishes.index')}}"><strong>I tuoi Piatti</strong></a></li>
    <li class="mr-4"><a href="{{route('admin.dishes.create')}}"><strong>Crea un nuovo piatto</strong></a></li>
    <li class="mr-4"><a href="{{route('admin.orders')}}"><strong>Riepilogo ordini</strong></a></li>
    <li class="mr-4"><a href="{{route('admin.charts')}}"><strong>Statistiche</strong></a></li>
@endsection