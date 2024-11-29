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
        //dd($request->all());
        //Validator: valida los parametros a requerir con un conjunto de reglas como request, el tipo de dato, etc 
        $validator = Validator::make($request->all(), [
            'producto' => 'required|max:255',
            'precio' => 'required|integer',
            'fechaIngreso' => 'required|date'
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
            'fechaIngreso' => $request->fechaIngreso
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

    public function destroy($id)
    {
        $producto = Producto::find($id);

        if (!$producto) {
            $data = [
                'message' => 'Producto no encontrado',
                'status' => 404
            ];
            return response()->json($data, 404);
        }
        
        $producto->delete();

        $data = [
            'message' => 'Producto eliminado',
            'status' => 200
        ];

        return response()->json($data, 200);
    }

    public function update(Request $request, $id)
    {
        $producto = Producto::find($id);

        if (!$producto) {
            $data = [
                'message' => 'Producto no encontrado',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        $validator = Validator::make($request->all(), [
            'producto' => 'max:255',
            'precio' => 'integer',
            'fechaIngreso' => 'date'
        ]);

        if ($validator->fails()) {
            $data = [
                'message' => 'Error en la validación de los datos',
                'errors' => $validator->errors(),
                'status' => 400
            ];
            return response()->json($data, 400);
        }

        if ($request->has('producto')) {
            $producto->producto = $request->producto;
        }

        if ($request->has('precio')) {
            $producto->precio = $request->precio;
        }

        if ($request->has('fechaIngreso')) {
            $producto->fechaIngreso = $request->fechaIngreso;
        }

        $producto->save();

        $data = [
            'message' => 'Producto actualizado',
            'producto' => $producto,
            'status' => 200
        ];

        return response()->json($data, 200);
    }

    public function show($id)
    {
        $producto = Producto::find($id);

        if (!$producto) {
            $data = [
                'message' => 'Producto no encontrado',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        $data = [
            'message' => 'Producto encontrado',
            'producto' => $producto,
            'status' => 200
        ];

        return response()->json($data, 200);
    }
}
