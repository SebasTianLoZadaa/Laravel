<?php

namespace App\Http\Controllers;

use App\Models\Subcategoria;
use App\Models\Categoria;
use Illuminate\Http\Request;

class SubcategoriaController extends Controller
{
    /**
     * Display a listing of the resource. -- Muestra las subcategorias disponibles
     */
    public function index()
    {
        $subcategorias = Subcategoria::all();
        return view('subcategorias.index', compact('subcategorias'));
    }

    /**
     * Show the form for creating a new resource. -- Muestra el formulario para crear una nueva subcategoria
     */
    public function create()
    {
        $categorias = Categoria::all();
        return view('subcategorias.create', compact('categorias'));
    }

    /**
     * Store a newly created resource in storage. -- Guarda la nueva subcategoria en la base de datos
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255|unique:subcategorias',
            'categoria_id' => 'required|exists:categorias,id'
        ]);

        Subcategoria::create([
            'nombre' => $request->nombre,
            'categoria_id' => $request->categoria_id
        ]);

        return redirect()->route('subcategorias.index')->with('success', 'Subcategoria creada exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $subcategoria = Subcategoria::findOrFail($id);
        return view('subcategorias.show', compact('subcategoria'));
    }

    /**
     * Show the form for editing the specified resource. -- Muestra el formulario de edición de la subcategoria
     */
    public function edit(String $id)
    {
        $subcategoria = Subcategoria::findOrFail($id);
        $categorias = Categoria::all();
        return view('subcategorias.edit', compact('subcategoria', 'categorias'));
    }

    /**
     * Update the specified resource in storage. -- Actualiza la subcategoria en la base de datos
     */
    public function update(Request $request, string $id)
    {
        $subcategoria = Subcategoria::findOrFail($id);
        $request->validate([
            'nombre' => 'required|string|max:255|unique:subcategorias,nombre,' . $subcategoria->id,
            'categoria_id' => 'required|exists:categorias,id'
        ]);

        $subcategoria->update ($request->all());

        return redirect()->route('subcategorias.index')->with('success', 'Subcategoria actualizada exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $subcategoria = Subcategoria::findOrFail($id);
        $subcategoria->delete();
        return redirect()->route('subcategorias.index')->with('success', 'Subcategoria eliminada exitosamente.');
    }
}
