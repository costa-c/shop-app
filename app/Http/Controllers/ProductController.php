<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ProductController extends Controller
{
    function __construct()
    {
        // $this->middleware('auth')
        $this->middleware('permission:product-list|product-create|product-edit|product-delete',
            ['only' => ['index','show']])->except(['index', 'show']);
        $this->middleware('permission:product-create', ['only' => ['create','store']]);
        $this->middleware('permission:product-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:product-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Product::latest()->paginate(5);
        return view('products.index', compact('data'))->with('i',(request()->input('page', 1) - 1) * 5);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('products.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'detail' => 'required',
            'product_image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|dimensions:min_with=100,
                    min_height=100,max_with=1200,max_height=1200',
            'stock' => 'required'
        ]);
        $file_name = time() . '.' . request()->product_image->getClientOriginalExtension();
        request()->product_image->move(public_path('images'), $file_name);
        $product = new Product;
        $product->name = $request->name;
        $product->detail = $request->detail;
        $product->stock = $request->stock;
        $product->product_image = $file_name;
        $product->save();
        return redirect()->route('products.index')->with('success', 'Produto adicionado com sucesso');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        return view('products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        return view('products.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required',
            'detail' => 'required',
            'stock' => 'required',
            'product_image' => 'image|mimes:jpg,png,jpeg,gif,svg|dimensions:min_with=100,
                    min_height=100,max_with=1200,max_height=1200'
        ]);
        $product_image = $request->hidden_product_image;

        if($request->product_image != '')
        {
            $image_path = public_path().'/images/'.$product_image;
            if(File::exists($image_path))
            {
                File::delete($image_path);
            }
            $product_image = time() . '.' . request()->product_image->getClientOriginalExtension();
            request()->product_image->move(public_path('images'), $product_image);
        }

        $product = Product::find($request->hidden_id);
        $product->name = $request->name;
        $product->detail = $request->detail;
        $product->stock = $request->stock;
        $product->product_image = $product_image;
        $product->save();
        return redirect()->route('products.index')->with('success', 'Produto atualizado com sucesso');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $image_path = public_path().'/images/'.$product->product_image;
        if(File::exists($image_path))
        {
            File::delete($image_path);
        }
        $product->delete();
        return redirect()->route('products.index')->with('success', 'Produto eliminado com sucesso');

    }
}
