@extends('app')

@section('content')

    <div class="container">
        <h3>Produtos</h3>

        <br>

        <a href="{{route('admin.products.create')}}" class="btn btn-default">Novo Produto</a>
        <br><br>

        <table class="table table-bordered">
            <thead>
            <tr>
                <th>ID</th>
                <th>Produto</th>
                <th>Preço</th>
                <th>Categoria</th>
                <th>Acão</th>
                <th></th>
            </tr>
            </thead>

            <tbody>
            @foreach($products as $product)
                <tr>
                    <td>{{$product->id}}</td>
                    <td>{{$product->name}}</td>
                    <td>{{$product->price}}</td>
                    <td>{{$product->category->name}}</td>
                    <td>{{$product->name}}</td>
                    <td>
                        <a href="{{route('admin.products.edit', $product->id)}}" class="btn btn-primary btn-small">
                            Editar
                        </a>

                        <a href="{{route('admin.products.destroy', $product->id)}}" class="btn btn-danger btn-small">
                            Remover
                        </a>

                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        {!! $products->render() !!}
    </div>

@endsection