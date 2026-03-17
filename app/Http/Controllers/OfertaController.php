<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Oferta;
class OfertaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Obtener todas las ofertas de la base de datos
        $ofertas = Oferta::all();

        // Retornar una vista llamada 'ofertas.index' con los datos
        return view('ofertas.index', compact('ofertas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('ofertas.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'titulo' => 'required|string|max:255',
            'vigencia' => 'required|date',
            'tienda' => 'required|string|max:255',
            'precio_original' => 'required|numeric',
            'precio_descuento' => 'required|numeric',
        ]);

        $oferta = new Oferta();
        $oferta->titulo = $request->input('titulo');
        $oferta->vigencia = $request->input('vigencia');
        $oferta->tienda = $request->input('tienda');
        $oferta->precio_original = $request->input('precio_original');

        return redirect()->route('ofertas.index')->with('success', 'Oferta creada exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $oferta = Oferta::findOrFail($id);
        return view('ofertas.show')->with('oferta', $oferta);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $oferta = Oferta::findOrFail($id);
        return view('ofertas.edit')->with('oferta', $oferta);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'titulo' => 'required|string|max:255',
            'vigencia' => 'required|date',
            'tienda' => 'required|string|max:255',
            'precio_original' => 'required|numeric',
            'precio_descuento' => 'required|numeric',
        ]);

        $oferta = Oferta::findOrFail($id);
        $oferta->titulo = $request->input('titulo');
        $oferta->vigencia = $request->input('vigencia');
        $oferta->tienda = $request->input('tienda');
        $oferta->precio_original = $request->input('precio_original');
        $oferta->precio_descuento = $request->input('precio_descuento');
        $oferta->save();

        return redirect()->route('ofertas.index')->with('success', 'Oferta actualizada exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $oferta = Oferta::findOrFail($id);
        $oferta->delete();

        return redirect()->route('ofertas.index')->with('success', 'Oferta eliminada exitosamente.');
    }
}
