@extends('app')

@section('content')

    <div class="container">
        <h3>Cupoms</h3>

        @include('errors._check')

        {!! Form::open(['route' => 'admin.cupoms.store']) !!}

        @include('admin.cupoms.form.form')

        <div class="form-group">
            {!! Form::submit('Criar Cupoms', ['class' => 'btn btn-primary']) !!}
        </div>

        {!! Form::close() !!}

    </div>

@endsection