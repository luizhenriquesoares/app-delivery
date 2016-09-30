@extends('app')

@section('content')

    <div class="container">
        <h3>Editando Cliente {{$clients->user->name}}</h3>

        @include('errors._check')

        {!! Form::model($clients, ['route' => ['admin.clients.update', $clients->id]]) !!}

        @include('admin.clients.form.form')

        <div class="form-group">
            {!! Form::submit('Editar Cliente', ['class' => 'btn btn-primary']) !!}
        </div>

        {!! Form::close() !!}

    </div>

@endsection