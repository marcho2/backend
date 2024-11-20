<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Producto;

class productoController extends Controller
{
    public function index()
    {
        $productos = Producto::all();
        $data = [
            'productos' => $productos,
            'status' => 200
        ];

        return response()->json($data, 200);
    }
    
    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'producto' => 'required|max:255',
            'precio' => 'required|integer',
            'fecha_de_ingreso' => 'required|date'
        ]);

        if ($validator->fails()) {
            $data = [
                'message' => 'Error en la validación de los datos',
                'errors' => $validator->errors(),
                'status' => 400
            ];
            return response()->json($data, 400);
        }

        $producto = Producto::create([
            'producto' => $request->producto,
            'precio' => $request->precio,
            'fecha_de_ingreso' => $request->fecha_de_ingreso
        ]);

        if (!$producto) {
            $data = [
                'message' => 'Error al crear el producto',
                'status' => 500
            ];
            return response()->json($data, 500);
        }

        $data = [
            'producto' => $producto,
            'message' => 'Producto Creado',
            'status' => 201
        ];

        return response()->json($data, 201);

    }
}
