@extends('app')

@section('content')

    <div class="container">
        <h3>Clientes</h3>

        <br>

        <a href="{{route('admin.clients.create')}}" class="btn btn-default">Novo cliente</a>
        <br><br>

        <table class="table table-bordered">
            <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Ação</th>
            </tr>
            </thead>

            <tbody>
            @foreach($clients as $c)
                <tr>
                    <td>{{$c->id}}</td>
                    <td>{{$c->user->name}}</td>
                    <td>
                        <a href="{{route('admin.clients.edit', $c->id)}}" class="btn btn-default btn-small">
                            Editar
                        </a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        {!! $clients->render() !!}
    </div>

@endsection