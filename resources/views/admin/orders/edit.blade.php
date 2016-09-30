@extends('app')

@section('content')

    <div class="container">
        <h2>Pedido #{{ $orders->id }} - {{$orders->total}}</h2>
        <h3>Cliente: {{$orders->client->user->name}}</h3>
        <h4>Data: {{$orders->created_at}}</h4>

        <p>Entregar em:</b> <br>
            {{$orders->client->address}} - {{$orders->client->city}} - {{$orders->client->state}}
        </p>

        {!! Form::model($orders, ['route' => ['admin.orders.update', $orders->id]]) !!}

        <div class="form-group">
            {!! Form::label('Status', 'Status') !!}
            {!! Form::select('status', $list_status ,   null, ['class' => 'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('Entregador', 'Entregador') !!}
            {!! Form::select('user_deliveryman_id', $deliveryman ,   null, ['class' => 'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::submit('Salvar', ['class' => 'btn btn-primary']) !!}
        </div>

        {!! Form::close() !!}
    </div>


@endsection()