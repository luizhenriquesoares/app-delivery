@extends('app')

@section('content')

    <div class="container">
        <h3>Categorias</h3>

        @include('errors._check')

        {!! Form::open(['route' => 'admin.categories.store']) !!}

        @include('admin.categories.form.form')

        <div class="form-group">
            {!! Form::submit('Criar Categoria', ['class' => 'btn btn-primary']) !!}
        </div>

        {!! Form::close() !!}

    </div>

@endsection