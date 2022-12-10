<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tienda;
use Illuminate\Support\Facades\Validator;
use DB;
class TiendaController extends Controller
{
    public function index()
    {
        $Tienda = DB::table('tienda')
            ->select('*')
            ->where('estado', 1)
            ->get();

        return response()->json($Tienda);
    }

    public function storage(Request $request)
    {
        try {
            $validate = Validator::make(
                $request->all(),
                [
                    'nombre' => 'required',
                    'fecha_apertura' => 'required',
                ],
                [
                    'required' => 'El campo :attribute es requerido.',
                ]
            );

            if ($validate->fails()) {
                $message = [
                    'tipo' => 'error',
                    'mensaje' => $validate->errors(),
                ];
            } else {
                $Tienda = new Tienda();
                $Tienda->nombre = $request->nombre;
                $Tienda->fecha_apertura = $request->fecha_apertura;
                $Tienda->save();
                $message = [
                    'tipo' => 'susses',
                    'mensaje' => 'Datos almacenados correctamente ',
                ];
            }
        } catch (Exception $th) {
            $message = [
                'tipo' => 'error',
                'mensaje' => $th,
            ];
        }

        return response()->json($message);
    }

    public function update(Request $request)
    {
        try {
            $validate = Validator::make(
                $request->all(),
                [
                    'id' => 'required',
                    'nombre' => 'required',
                    'fecha_apertura' => 'required',
                ],
                [
                    'required' => 'El campo :attribute es requerido.',
                ]
            );

            if ($validate->fails()) {
                $message = [
                    'tipo' => 'susses',
                    'mensaje' => $validate->errors(),
                ];
            } else {
                $affected = DB::table('tienda')
                    ->where('id', $request->id)
                    ->update([
                        'nombre' => $request->nombre,
                        'fecha_apertura' => $request->fecha_apertura,
                    ]);

                $message = [
                    'tipo' => 'susses',
                    'mensaje' => 'Datos almacenados correctamente ',
                ];
            }

            return response()->json($message);
        } catch (Exception $th) {
            return response()->json($th);
        }
    }

    public function cargar($id)
    {
        $Tienda = DB::table('tienda')
            ->select('*')
            ->where('id', $id)
            ->get();

        return response()->json($Tienda);
    }
    public function delete($id)
    {
        try {
            $affected = DB::table('tienda')
                ->where('id', $id)
                ->update([
                    'estado' => 0,
                ]);

            $message = [
                'tipo' => 'susses',
                'mensaje' => 'Datos eliminados correctamente ',
            ];
        } catch (Exception $th) {
            return response()->json($th);
            $message = [
                'tipo' => 'error',
                'mensaje' => $h,
            ];
        }

        return response()->json($message);
    }
}
