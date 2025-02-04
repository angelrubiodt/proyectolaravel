<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;

class ProductoController extends Controller
{
    public function index()
    {
        $productos = Producto::all();
        return view('productos.index', compact('productos'));
    }

    public function create()
    {
        return view('productos.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'placa' => 'required|max:10',
            'tipo_material' => 'required|max:50',
            'cantidad' => 'required|integer',
            'precio' => 'required|numeric',
            'comprador' => 'required|max:50',
        ]);

        Producto::create($request->all());
        return redirect()->route('productos.index');
    }

    public function show(Producto $producto)
    {
        return view('productos.show', compact('producto'));
    }

    public function edit(Producto $producto)
    {
        return view('productos.edit', compact('producto'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'placa' => 'required|max:10',
            'tipo_material' => 'required|max:50',
            'cantidad' => 'required|integer',
            'precio' => 'required|numeric',
            'comprador' => 'required|max:50',
        ]);

        $producto = Producto::findOrFail($id);
        $producto->update($request->all());
        return redirect()->route('productos.index')->with('success', 'Producto actualizado exitosamente.');
    }

    public function destroy(Producto $producto)
    {
        $producto->delete();
        return redirect()->route('productos.index');
    }
}
