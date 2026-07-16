<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\Subcategoria;
use App\Models\Categoria;
use Illuminate\Http\Request;

class ProductoController extends Controller
{
    /**
     * Display a listing of the resource. -- Muestra los productos disponibles
     */
    public function index()
    {
        $productos = Producto::all();
        return view('productos.index', compact('productos'));
    }

    /**
     * Show the form for creating a new resource. -- Muestra el formulario para crear productos
     */
    public function create()
    {
        $subcategorias = Subcategoria::all();
        $categorias = Categoria::all();
        return view('productos.create', compact('subcategorias', 'categorias'));
    }

    /**
     * Store a newly created resource in storage. -- Guarda el producto en la base de datos
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255|unique:productos',
            'subcategoria_id' => 'required|exists:subcategorias,id',
            'categoria_id' => 'required|exists:categorias,id'
        ]);

        Producto::create($request->all());

        return redirect()->route('productos.index')->with('success', 'Producto creado exitosamente.');
    }

    /**
     * Display the specified resource. -- Muestra el producto especifico
     */
    public function show(string $id)
    {
        $producto = Producto::findOrFail($id);
        return view('productos.show', compact('producto'));
    }

    /**
     * Show the form for editing the specified resource. -- Muestra el formulario de edición del producto
     */
    public function edit(string $id)
    {
        $producto = Producto::findOrFail($id);
        $subcategorias = Subcategoria::all();
        $categorias = Categoria::all();
        return view('productos.edit', compact('producto', 'subcategorias', 'categorias'));
    }

    /**
     * Update the specified resource in storage. -- Actualiza el producto en la base de datos
     */
    public function update(Request $request, string $id)
    {
        $producto = Producto::findOrFail($id);
        $request->validate([
            'nombre' => 'required|string|max:255|unique:productos,nombre,' . $producto->id,
            'subcategoria_id' => 'required|exists:subcategorias,id',
            'categoria_id' => 'required|exists:categorias,id'
        ]);

        $producto->update($request->all());

        return redirect()->route('productos.index')->with('success', 'Producto actualizado exitosamente.');
    }

    /**
     * Remove the specified resource from storage. -- Elimina el producto de la base de datos
     */
    public function destroy(string $id)
    {
        $producto = Producto::findOrFail($id);
        $producto->delete();
        return redirect()->route('productos.index')->with('success', 'Producto eliminado exitosamente.');
    }
}
