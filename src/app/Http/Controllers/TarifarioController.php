<?php

namespace App\Http\Controllers;

use App\Models\Tarifario;
use Illuminate\Http\Request;

class TarifarioController extends Controller
{
    public function index()
    {
        $tarifarios = Tarifario::all();
        return view('tarifario.index', compact('tarifarios'));
    }

    public function create()
    {
        return view('tarifario.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'precio' => 'required|numeric',
        ]);

        Tarifario::create($request->all());

        return redirect()->route('tarifario.index')
                         ->with('success', 'Tarifario creado exitosamente.');
    }

    public function edit(Tarifario $tarifario)
    {
        return view('tarifario.edit', compact('tarifario'));
    }

    public function update(Request $request, Tarifario $tarifario)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'precio' => 'required|numeric',
        ]);

        $tarifario->update($request->all());

        return redirect()->route('tarifario.index')
                         ->with('success', 'Tarifario actualizado exitosamente.');
    }

    public function destroy(Tarifario $tarifario)
    {
        $tarifario->delete();

        return redirect()->route('tarifario.index')
                         ->with('success', 'Tarifario eliminado exitosamente.');
    }
}
