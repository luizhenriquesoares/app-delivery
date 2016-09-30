@extends('app')

@section('content')

    <div class="container">
        <h3>Editar Categorias {{$category->name}}</h3>

        @include('errors._check')

        {!! Form::model($category, ['route' => ['admin.categories.update', $category->id]]) !!}

        @include('admin.categories.form.form')

        <div class="form-group">
            {!! Form::submit('Editar Categoria', ['class' => 'btn btn-primary']) !!}
        </div>

        {!! Form::close() !!}

    </div>

@endsection