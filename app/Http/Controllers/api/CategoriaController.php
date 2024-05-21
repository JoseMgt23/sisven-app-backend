<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Models\Categoria;

class CategoriaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categorias = Categoria::all();
        return json_encode(['categorias'=>$categorias]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $categoria = new Categoria();
        $categoria->nombre = $request->nombre;
        $categoria->descricion = $request->descripcion;
        $categoria->save();

        return json_encode(['categoria'=>$categoria]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $categoria = Categoria::find($id);
        if(is_null($categoria)) {
            return abort(404);  
        }
        $categoria = DB::table('categorias')
        ->orderBy('nombre')
        ->orderBy('descripcion')
        ->get();
        return json_encode(['categoria'=>$categoria]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validate = Validator::make($request->all(), [
            'nombre'=> ['required', 'max:30', 'unique'],
            'descripcion'=> ['nullable'],
        ]);
        if($validate->fails()){
            return response()->json([
                'msg'=>'Se produjo un error en la validacion de la informacion.',
                'statusCode'=>400
            ]);
        }

        $categoria = Categoria::find($id);
        $categoria->nombre = $request->nombre;
        $categoria->descripcion = $request->descripcion;
        $categoria->save();

        return json_encode(['categoria'=>$categoria]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $categoria = Categoria::find($id);
        $categoria->delete();
        $categorias = Categoria::all();
        return json_encode(['categorias'=>$categorias, 'success'=> true]);
    }
}
