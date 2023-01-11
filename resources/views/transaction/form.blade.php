@extends('template.template')

@section('container')
    <h2>Nueva Venta</h2>
    <br>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('products.transactions.store', $product->id ) }}">
        @csrf
        <div class="mb-3">
            <label for="nombre" class="form-label">Id Producto</label>
            <input disabled type="text" class="form-control" id="id" name="id" value="@if(isset($product)){{ $product->id }}@endif">
        </div>
        <div class="mb-3">
            <label for="nombre" class="form-label">Producto</label>
            <input disabled type="text" class="form-control" id="nombre" name="nombre" value="@if(isset($product)){{ $product->nombre }}@endif">
        </div>
        <div class="mb-3">
            <label for="cantidad" class="form-label">Cantidad</label>
            <input type="text" class="form-control" id="cantidad" name="cantidad" value="{{  old('cantidad') }}">
        </div>
        <button type="submit" class="btn btn-primary">Vender</button>
    </form>
@endsection
