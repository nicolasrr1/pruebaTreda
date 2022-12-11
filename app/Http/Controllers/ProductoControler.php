<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;
use DB,Storage;
use Illuminate\Support\Facades\Validator;

class ProductoControler extends Controller
{
    private $username = 'public' . '/';

    private $uploadDir = 'imagen/';

    // listar
    public function index()
    {
        $Producto = Producto::all();
        return response()->json($Producto);
    }

    public function productoTienda($id)
    {
        $producto = DB::table('producto')
            ->select('*')
            ->where('id', '=', $id)
            ->get();

        return view('producto.index', compact('producto', 'id'));
    }

    // crear productos
    public function storage(Request $request)
    {
        try {
            $request->validate(
                [
                    'nombre' => 'required',
                    'sku' => 'required|unique:producto',
                    'valor' => 'required',
                    'imagen' => 'required |image|max:2048 ',
                    'tienda' => 'required',
                ],
                [
                    'required' => 'El campo :attribute es requerido.',
                    'unique' => 'El campo :attribute No se puede repetir  ',
                ]
            );


            $img =  $request->file('imagen')->store('public/images');
            $url = Storage::url($img);
            
            



            $Producto = new Producto();

            $Producto->nombre = $request->nombre;
            $Producto->sku = $request->sku;
            $Producto->valor = $request->valor;
            $Producto->tienda = $request->tienda;
            $Producto->imagen = $url;

            $Producto->save();

          
        } catch (Exception $e) {
            $message = [
                'tipo' => 'error',
                'mensaje' => $e,
            ];
        }

        return redirect()->back();
    }

    //actualizar productos
    public function update(Request $request)
    {
        try {
            $request->validate(
                [
                    'id' => '$required',
                    'nombre' => 'required',
                    'sku' => 'required|unique:producto',
                    'valor' => 'required',
                    'imagen' => 'required |image|max:2048 ',
                    'tienda' => 'required',
                ],
                [
                    'required' => 'El campo :attribute es requerido.',
                    'unique' => 'El campo :attribute No se puede repetir  ',
                ]
            );

            DB::table('producto')
                ->where('id', $request->id)
                ->update([
                    'nombre' => $request->nombre,
                    'sku' => $request->sku,
                    'valor' => $request->valor,
                    'imagen' => $request->imagen,
                    'tienda' => $request->tienda,
                ]);

            return redirect()->back();
        } catch (Exception $e) {
            return response()->json($e);
        }
    }

    // Eliminar producto
    public function delete($id)
    {
        try {
            DB::table('producto')
                ->where('id', '=', $id)
                ->delete();
        } catch (\Throwable $th) {
            $message = [
                'tipo' => 'error',
                'mensaje' => $th,
            ];
        }

        return redirect()->back();
    }
}
