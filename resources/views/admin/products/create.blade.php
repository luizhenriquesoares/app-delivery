@extends('app')

@section('content')

    <div class="container">
        <h3>Produtos</h3>

        @include('errors._check')

        {!! Form::open(['route' => 'admin.products.store']) !!}

        @include('admin.products.form.form')

        <div class="form-group">
            {!! Form::submit('Criar Produtos', ['class' => 'btn btn-primary']) !!}
        </div>

        {!! Form::close() !!}

    </div>

@endsection