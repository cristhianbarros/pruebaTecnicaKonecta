<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Transaction;
use Illuminate\Http\Request;

class ProductTransactionController extends Controller
{


    /**
     * Show the form for creating a new resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function create(Product $product)
    {
        return view('transaction.form')->with(compact('product'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Product $product)
    {
        $validated = $request->validate(
            [
                'cantidad' => 'required|integer',
            ],
            [   'cantidad.required' => 'El campo Cantidad es obligatorio.',
                'cantidad.integer' => 'El campo Cantidad debe ser Entero.'
            ]
        );

        $cantidad = $validated['cantidad'];

        if ($product->stock == 0) {
            return redirect()->route('products.index')
                ->with('error', 'No es posible realizar la venta porque el producto tiene Stock en 0.');
        }

        if ($product->stock < $cantidad) {
            return redirect()->route('products.index')
                ->with('error', 'La cantidad a vender excede el Stock del Producto');
        }

        $validated['product_id'] = $product->id;
        $transaction = Transaction::create($validated);
        if ($transaction) {
            $product->stock = $product->stock - $cantidad;
            $product->save();
        }

        return redirect()->route('products.index');
    }
}
