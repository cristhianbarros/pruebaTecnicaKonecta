@extends('template.template')
@section('container')
<h2>Listado Productos</h2>
<br>
@if (session('status') || session('error'))
<div
    class="alert alert-@if(session()->has('status')){{ 'success' }}@elseif(session()->has('error')){{ 'danger' }}@endif">
    {{ session('status') }}
    {{ session('error') }}
</div>
@endif
<table class="table">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Nombre</th>
            <th scope="col">Categoria</th>
            <th scope="col">Precio</th>
            <th scope="col">Stock</th>
            <th scope="col">Opciones</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($products as $product)
        <tr>
            <th scope="row">{{ $product->id }}</th>
            <td>{{ $product->nombre }}</td>
            <td>{{ $product->categoria }}</td>
            <td>{{ $product->precio }}</td>
            <td>{{ $product->stock }}</td>
            <td>
                <div class="btn-group" role="group">
                    <a href="{{ route('products.edit', $product->id) }}" class="btn btn-success">Editar</a>

                    <a aria-disabled="true" data-bs-toggle="tooltip" data-bs-placement="top"
                        data-bs-title="@if($product->stock == 0){{ 'No es posible realizar la venta porque el producto tiene Stock en 0.' }}@endif"
                        href="{{ route('products.transactions.create', $product->id) }}"
                        class="btn btn-success @if($product->stock == 0){{ 'disabled' }}@endif">Vender</a>
                    <form action="{{ route('products.destroy', $product->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-primary">
                            Borrar
                        </button>
                    </form>
                </div>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="6" class="text-center">No existen productos en la base de datos.</td>
        </tr>
        @endforelse

    </tbody>
</table>
{{ $products->links() }}
@endsection
