<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;
use DB;
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
            $validate = Validator::make(
                $request->all(),
                [
                    'nombre' => 'required',
                    'sku' => 'required|unique:producto',
                    'valor' => 'required',
                    'imagen' => 'required',
                    'tienda' => 'required',
                ],
                [
                    'required' => 'El campo :attribute es requerido.',
                    'unique' => 'El campo :attribute No se puede repetir  ',
                ]
            );

            if ($validate->fails()) {
                $message = [
                    'tipo' => 'error',
                    'mensaje' => $validate->errors(),
                ];
            } else {
                if ($request->hasFile('imagen')) {
                    $archivo = $request->file('imagen');
                    // $carpetaDestino = 'images/';
                    // $nombreArchivo = time() . '-' . $archivo->getClientOriginalName();
                    // $subir = $request->file('subir')->move( public_path($carpetaDestino),$nombreArchivo);
                }

                $Producto = new Producto();

                $Producto->nombre = $request->nombre;
                $Producto->sku = $request->sku;
                $Producto->valor = $request->valor;
                $Producto->tienda = $request->tienda;
                $Producto->imagen = $request->imagen;

                $Producto->save();

                $message = [
                    'tipo' => 'susses',
                    'mensaje' => 'Datos almacenados correctamente ',
                ];
            }
        } catch (Exception $e) {
            $message = [
                'tipo' => 'error',
                'mensaje' => $e,
            ];
        }
        // return response()->json($message);

        return redirect()->back();
    }

    //actualizar productos
    public function update(Request $request)
    {
        try {
            $validate = Validator::make(
                $request->all(),
                [
                    'id' => 'required',
                    'nombre' => 'required',
                    'sku' => 'required',
                    'valor' => 'required',
                    'imagen' => 'required',
                    'tienda' => 'required',
                ],
                [
                    'required' => 'El campo :attribute es requerido.',
                    'unique' => 'El campo :attribute No se puede repetir',
                ]
            );

            if ($validate->fails()) {
                $message = [
                    'tipo' => 'error',
                    'mensaje' => $validate->errors(),
                ];
            } else {
                DB::table('producto')
                    ->where('id', $request->id)
                    ->update([
                        'nombre' => $request->nombre,
                        'sku' => $request->sku,
                        'valor' => $request->valor,
                        'imagen' => $request->imagen,
                        'tienda' => $request->tienda,
                    ]);

                $message = [
                    'tipo' => 'susses',
                    'mensaje' => 'Datos almacenados correctamente ',
                ];
            }

            return response()->json($message);
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

            $message = [
                'tipo' => 'susses',
                'mensaje' => 'Datos eliminados correctamente ',
            ];
        } catch (\Throwable $th) {
            $message = [
                'tipo' => 'error',
                'mensaje' => $th,
            ];
        }

        return redirect()->back();
    }
}
