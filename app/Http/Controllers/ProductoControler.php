<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;
use DB;
use Illuminate\Support\Facades\Validator;

class ProductoControler extends Controller
{

    private $username='public'.'/';

    private $uploadDir='imagen/';

    // listar
    public function index()
    {
        $Producto = Producto::all();
        return response()->json($Producto);
    }

    public function productoTienda($id)
    {
        return view('producto.index', compact('id'));
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

                
                $file=$request->file('uploadfile');
                $filename=$this->uploadDir.$file->getClientOriginalName();
                $this->originalname=$file->getClientOriginalName();
                if($file){
                    Storage::disk('public')->put($filename, File::get($file));
                }

                

                $Producto = new Producto();

                $Producto->nombre = $request->nombre;
                $Producto->sku = $request->sku;
                $Producto->valor = $request->valor;
                $Producto->image = $fileName;
                $Producto->tienda = $request->tienda;

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

        return response()->json($message);
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
                    'sku' => 'required|unique:producto',
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
                        'image' => $request->imagen,
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

        return response()->json($message);
    }
}
