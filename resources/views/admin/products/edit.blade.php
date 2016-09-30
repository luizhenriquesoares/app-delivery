@extends('app')

@section('content')

    <div class="container">
        <h3>Editar Produtos {{$products->name}}</h3>

        @include('errors._check')

        {!! Form::model($products, ['route' => ['admin.products.update', $products->id]]) !!}

        @include('admin.products.form.form')

        <div class="form-group">
            {!! Form::submit('Editar Produtos', ['class' => 'btn btn-primary']) !!}
        </div>

        {!! Form::close() !!}

    </div>

@endsection