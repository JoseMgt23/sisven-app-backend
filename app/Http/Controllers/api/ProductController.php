<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;    
use Illuminate\Support\Facades\DB;
use App\Models\Product;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::all();
        return json_encode(['products'=>$products]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $product = new Product();
        $product->name = $request->name;
        $product->price = $request->price;
        $product->stock = $request->stock;
        $product->category_id = $request->category_id;
        $product->save();

        return json_encode(['product'=>$product]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $product = Product::find($id);
        if(is_null($product)) {
            return abort(404);  
        }
        $product = DB::table('produts')
        ->orderBy('names')
        ->orderBy('price')
        ->orderBy('stock')
        ->get();
        return json_encode(['product'=>$product]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validate = Validator::make($request->all(), [
            'name'=> ['required', 'max:30', 'unique'],
            'price'=> ['required','max:50','unique'],
            'stock'=> ['required','max:30','unique'],
            'categoria_id' => ['required','max30','unique'],
        ]);
        if($validate->fails()){
            return response()->json([
                'msg'=>'Se produjo un error en la validacion de la informacion.',
                'statusCode'=>400
            ]);
        }

        $product = Product::find($id);
        $product->name = $request->name;
        $product->price = $request->price;
        $product->stock = $request->stock;
        $product->categoria_id = $request->categoria_id;
        $product->save();

        return json_encode(['product'=>$product]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Product::find($id);
        $product->delete();
        $products = Product::all();
        return json_encode(['products'=>$products, 'success'=> true]);
    }
}
