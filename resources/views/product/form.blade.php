@extends('template.template')

@section('container')
    <h2>@if(isset($product)){{ 'Editar'}}@else{{ 'Nuevo' }}@endif Producto</h2>
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

    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <form method="POST" action="@if(!isset($product)){{ route('products.store') }}@else{{ route('products.update', $product->id ) }}@endif">
        @csrf
        @if(isset($product))
            @method('PUT')
        @endif
        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre</label>
            <input type="text" class="form-control" id="nombre" name="nombre" value="@if(isset($product)){{ $product->nombre }}@else{{ old('nombre') }}@endif">
        </div>
        <div class="mb-3">
            <label for="referencia" class="form-label">Referencia</label>
            <input type="text" class="form-control" id="referencia" name="referencia" value="@if(isset($product)){{ $product->referencia }}@else{{ old('referencia') }}@endif">
        </div>
        <div class="mb-3">
            <label for="precio" class="form-label">Precio</label>
            <input type="text" class="form-control" id="precio" name="precio" value="@if(isset($product)){{ $product->precio }}@else{{ old('precio') }}@endif">
        </div>
        <div class="mb-3">
            <label for="peso" class="form-label">Peso</label>
            <input type="text" class="form-control" id="peso" name="peso" value="@if(isset($product)){{ $product->peso }}@else{{ old('peso') }}@endif">
        </div>
        <div class="mb-3">
            <label for="categoria" class="form-label">Categoria</label>
            <input type="text" class="form-control" id="categoria" name="categoria" value="@if(isset($product)){{ $product->categoria }}@else{{ old('categoria') }}@endif">
        </div>
        <div class="mb-3">
            <label for="stock" class="form-label">Stock</label>
            <input type="text" class="form-control" id="stock" name="stock" value="@if(isset($product)){{ $product->stock }}@else{{ old('stock') }}@endif">
        </div>
        <button type="submit" class="btn btn-primary">@if(isset($product)){{ 'Actualizar' }}@else{{ 'Guardar' }}@endif</button>
    </form>
@endsection
