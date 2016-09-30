@extends('app')

@section('content')
    <div class="container">
        <h3>Novo Pedido</h3>

        <a href="{{route('costumer.order.create')}}" class="btn btn-default">Novo Pedido</a>
        <br><br>

        <table class="table table-bordered">
            <thead>
            <tr>
                <th>ID</th>
                <th>Entregador</th>
                <th>Total</th>
            </tr>
            </thead>

            <tbody>
            @foreach($orders as $order)
            <tr>
                <td>{{$order->id}}</td>
                <td>{{$order->total}}</td>
                <td>{{$order->status}}</td>
            </tr>
            @endforeach
            </tbody>
        </table>
    {!! $orders->render() !!}
@endsection