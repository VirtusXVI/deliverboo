@extends('layouts.app')
@extends('admin.navlinks')

@section('content')
<div class="container">
    <h1>Riepilogo ordini</h1>
    {{$orders->links()}}
    @foreach ($orders as $order)
        <div class="card mt-3 p-3">
           <div class="orders-info flex">
                <div class="orders-info-title">
                    <div class="title"><span>Nome cliente:</span></div>
                    <div class="title"><span>Indirizzo:</span> </div>
                    <div class="title"><span>Email:</span> </div>
                    <div class="title"><span>Id ordine:</span> </div>
                    <div class="title"><span>Data e ora:</span> </div>
                    <div class="title"><span>Importo:</span> </div>
                </div>
                <div class="customers-info">
                    <div class="customer-info">
                        {{$order->customer_name}}
                    </div>
                    <div class="customer-info">
                        {{$order->customer_address}}
                    </div>
                    <div class="customer-info">
                        {{$order->customer_email}}
                    </div>
                    <div class="customer-info">
                        {{$order->id}}
                    </div>
                    <div class="customer-info">
                        {{$order->created_at}}
                    </div>
                    <div class="customer-info">
                        &euro; {{$order->total_price}}
                    </div>
                </div>
            </div>
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
                                    x {{$item->dish_quantity}}
                                </li>
                            @endif
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    @endforeach
    <div class="mt-3">
        {{$orders->links()}}
    </div>
</div>
@endsection

<style>
.plates {
    width: 200px;
}

.quantity {
    text-align: center;
}
.orders-info-title {
    width: 150px;
    font-weight: 600;
}

.orders-info-title .title, 
.customers-info .customer-info {
    border-bottom: 1px solid rgba(128, 128, 128, 0.281);
}
</style>