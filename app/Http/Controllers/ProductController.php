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
        ],
        [   'nombre.required' => 'El campo Nombre es obligatorio.',
            'nombre.min' => 'El campo Nombre debe contener por lo menos 2 caracteres.',
            'nombre.max' => 'El campo Nombre debe contener máximo 255 caracteres.',
            'referencia.required' => 'El campo Referencia es obligatorio.',
            'referencia.min' => 'El campo Referencia debe contener por lo menos 2 caracteres.',
            'referencia.max' => 'El campo Referencia debe contener máximo 255 caracteres.',
            'precio.required' => 'El campo Precio es obligatorio.',
            'precio.integer' => 'El campo Precio debe ser Entero.',
            'peso.required' => 'El campo Peso es obligatorio.',
            'peso.integer' => 'El campo Peso debe ser Entero.',
            'categoria.required' => 'El campo Categoría es obligatorio.',
            'categoria.min' => 'El campo Categoría debe contener por lo menos 2 caracteres.',
            'categoria.max' => 'El campo Categoría debe contener máximo 255 caracteres.',
            'stock.required' => 'El campo Stock es obligatorio.',
            'stock.integer' => 'El campo Stock debe ser Entero.',
        ]);

        $product = Product::create($validated);

        return redirect()->route('products.index')->with('status', "El Producto: $product->nombre  Ha Sido Creado Exitosamente !");
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
        ],
        [   'nombre.required' => 'El campo Nombre es obligatorio.',
            'referencia.required' => 'El campo Referencia es obligatorio.',
            'referencia.required' => 'El campo Referencia es obligatorio.',
            'precio.required' => 'El campo Precio es obligatorio.',
            'precio.integer' => 'El campo Precio debe ser Entero.',
            'peso.required' => 'El campo Peso es obligatorio.',
            'peso.integer' => 'El campo Peso debe ser Entero.',
            'categoria.required' => 'El campo Categoria es obligatorio.',
            'stock.required' => 'El campo Stock es obligatorio.',
            'stock.integer' => 'El campo Stock debe ser Entero.',
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
