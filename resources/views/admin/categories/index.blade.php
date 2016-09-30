@extends('app')

@section('content')

    <div class="container">
        <h3>Categorias</h3>

        <br>

        <a href="{{route('admin.categories.create')}}" class="btn btn-default">Nova Categoria</a>
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
            @foreach($categories as $c)
                <tr>
                    <td>{{$c->id}}</td>
                    <td>{{$c->name}}</td>
                    <td>
                        <a href="{{route('admin.categories.edit', $c->id)}}" class="btn btn-default btn-small">
                            Editar
                        </a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        {!! $categories->render() !!}
    </div>

@endsection