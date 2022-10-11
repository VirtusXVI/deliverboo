@extends('layouts.app')
@extends('admin.navlinks')

@section('content')
<div class="container">
    <h1>Riepilogo ordini</h1>
    @foreach ($orders as $order)
        <div class="card mt-3 p-3">
            <h4>Nome cliente: {{$order->customer_name}}</h4>
            <div>Indirizzo: {{$order->customer_address}}</div>
            <div>Email: {{$order->customer_email}}</div>
            <div>Id ordine: {{$order->id}}</div>
            <div>Data e ora: {{$order->created_at}}</div>
            <div>Importo: &euro; {{$order->total_price}}</div>
            <div class="order-info flex">
                <div class="plates">
                    <h5 class="mt-2">Piatto: </h5>
                   <ul>
                        @foreach ($order['dish'] as $dish)
                            <li>
                                {{$dish->name}}
                            </li>
                        @endforeach
                   </ul>
                </div>
                <div class="quantity">
                    <h5 class="mt-2">Quantità:</h5>
                    <ul>
                        @foreach ($dishQuantity as $item)
                            @if ($order->id == $item->order_id) 
                                <li>
                                    {{$item->dish_quantity}}
                                </li>
                            @endif
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    @endforeach
</div>
@endsection

<style>
.plates {
    width: 200px;
}

.quantity {
    text-align: center;
}
</style>