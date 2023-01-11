<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Http\Requests\StoreproductRequest;
use App\Http\Requests\UpdateproductRequest;
use Exception;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::paginate(20);
        return view('product.index')->with(compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('product.form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreproductRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre' => 'required|min:2|max:255',
            'referencia' => 'required|min:2|max:255',
            'precio' => 'required|integer',
            'peso' => 'required|integer',
            'categoria' => 'required|min:2|max:255',
            'stock' => 'required|integer',
        ]);

        Product::create($validated);

        return redirect()->route('products.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(product $product)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(product $product)
    {
        return view('product.form')->with(compact('product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateproductRequest  $request
     * @param  \App\Models\product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, product $product)
    {
        $validated = $request->validate([
            'nombre' => 'required|min:2|max:255',
            'referencia' => 'required|min:2|max:255',
            'precio' => 'required|integer',
            'peso' => 'required|integer',
            'categoria' => 'required|min:2|max:255',
            'stock' => 'required|integer',
        ]);

        $nombre = $validated['nombre'];
        $referencia = $validated['referencia'];
        $precio = $validated['precio'];
        $peso = $validated['peso'];
        $categoria = $validated['categoria'];
        $stock = $validated['stock'];

        if($request->has('nombre')) {
            $product->nombre = $nombre;
        }

        if($request->has('referencia')) {
            $product->referencia = $referencia;
        }
        if($request->has('precio')) {
            $product->precio = $precio;
        }
        if($request->has('peso')) {
            $product->peso = $peso;
        }
        if($request->has('categoria')) {
            $product->categoria = $categoria;
        }
        if($request->has('stock')) {
            $product->stock = $stock;
        }

        if($product->isDirty()) {
            $product->save();

            return redirect()->route('products.index')->with('status', "Producto: $product->nombre  Actualizado Exitosamente !");
        } else {
            return redirect()->route('products.edit', $product->id)->with('error', "No hay cambios para Actualizar !");
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        if($product->delete()) {
            return redirect()->route('products.index')->with('status', "Producto: $product->nombre  Eliminado Exitosamente !");
        }
    }
}
