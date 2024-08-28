<?php

namespace App\Http\Controllers;

use App\Models\Conductore;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ConductoreController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->query('search');

        // Consultar la base de datos según el término de búsqueda
        $conductores = Conductore::query()
            ->when($search, function ($query, $search) {
                $query->where('id', 'like', "%{$search}%")
                      ->orWhere('name', 'like', "%{$search}%")
                      ->orWhere('telefono', 'like', "%{$search}%")
                      ->orWhere('email', 'like', "%{$search}%");
            })
            ->get();

        // Verificar si no se encontraron resultados
        if ($conductores->isEmpty()) {
            session()->flash('search_message', 'No se encontraron resultados para: ' . htmlspecialchars($search));
        }

        return view('Conductore.index', compact('conductores'));
    }

    public function create()
    {
        return view('Conductore.create');
    }

    public function store(Request $request)
    {
        // Validar los datos del formulario
        $request->validate([
            'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validación de imagen
            'name' => 'required|string|min:5|max:255',
            'movil' => 'required|string|min:1|max:6',
            'categoria' => 'required|string|min:2|max:15',
            'email' => 'required|string|min:6|max:100|unique:conductores,email',
            'telefono' => 'required|string|min:9|max:9',
        ], [
            'imagen.image' => 'El archivo debe ser una imagen.',
            'imagen.mimes' => 'La imagen debe ser de tipo: jpeg, png, jpg, gif.',
            'imagen.max' => 'La imagen no debe pesar más de 2 MB.',
            'name.required' => 'El nombre es obligatorio.',
            'email.required' => 'El correo electrónico es obligatorio.',
            'email.unique' => 'Este correo ya está registrado.',
            'movil.required' => 'El número de móvil es obligatorio.',
            'movil.unique' => 'El número de móvil ya está registrado.',
            'telefono.required' => 'El número de teléfono es obligatorio.',
        ]);

        // Manejar la subida de la imagen
        $imagenPath = null;
        if ($request->hasFile('imagen')) {
            $imagenPath = $request->file('imagen')->store('public/conductores');
            $imagenPath = str_replace('public/', '', $imagenPath); // Obtener ruta relativa
        }

        // Crear un nuevo conductor en la base de datos
        Conductore::create([
            'imagen' => $imagenPath,
            'name' => $request->input('name'),
            'movil' => $request->input('movil'),
            'categoria' => $request->input('categoria'),
            'email' => $request->input('email'),
            'telefono' => $request->input('telefono'),
        ]);

        // Redireccionar a la vista de listado de conductores
        return redirect()->route('Conductore.index')->with('success', 'Conductor creado con éxito.');
    }

    public function show(string $id)
    {
        $conductore = Conductore::findOrFail($id);
        return view('Conductore.show', compact('conductore'));
    }

    public function edit(string $id)
    {
        $conductore = Conductore::findOrFail($id);
        return view('Conductore.edit', compact('conductore'));
    }

    public function update(Request $request, string $id)
    {
        // Validar los datos del formulario
        $request->validate([
            'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validación de imagen
            'name' => 'required|string|min:5|max:255',
            'movil' => 'required|string|min:1|max:6',
            'categoria' => 'required|string|min:2|max:15',
            'email' => 'required|string|min:6|max:100|unique:conductores,email,' . $id,
            'telefono' => 'required|string|min:9|max:9',
        ], [
            'imagen.image' => 'El archivo debe ser una imagen.',
            'imagen.mimes' => 'La imagen debe ser de tipo: jpeg, png, jpg, gif.',
            'imagen.max' => 'La imagen no debe pesar más de 2 MB.',
            'name.required' => 'El nombre es obligatorio.',
            'email.required' => 'El correo electrónico es obligatorio.',
            'email.unique' => 'Este correo ya está registrado.',
            'movil.required' => 'El número de móvil es obligatorio.',
            'movil.unique' => 'El número de móvil ya está registrado.',
            'telefono.required' => 'El número de teléfono es obligatorio.',
        ]);

        // Buscar el conductor por su ID
        $conductore = Conductore::findOrFail($id);

        // Manejar la subida de la imagen
        if ($request->hasFile('imagen')) {
            // Eliminar la imagen anterior si existe
            if ($conductore->imagen) {
                Storage::delete('public/conductores/' . $conductore->imagen);
            }

            $imagenPath = $request->file('imagen')->store('public/conductores');
            $imagenPath = str_replace('public/', '', $imagenPath); // Obtener ruta relativa
        } else {
            $imagenPath = $conductore->imagen; // Mantener la imagen existente si no se sube una nueva
        }

        // Actualizar los datos del conductor
        $conductore->update([
            'imagen' => $imagenPath,
            'name' => $request->input('name'),
            'movil' => $request->input('movil'),
            'categoria' => $request->input('categoria'),
            'email' => $request->input('email'),
            'telefono' => $request->input('telefono'),
        ]);

        // Redireccionar a la vista de listado de conductores
        return redirect()->route('Conductore.index')->with('success', 'Conductor actualizado con éxito.');
    }

    public function destroy(string $id)
    {
        $conductore = Conductore::findOrFail($id);

        // Eliminar la imagen si existe
        if ($conductore->imagen) {
            Storage::delete('public/conductores/' . $conductore->imagen);
        }

        // Eliminar el conductor
        $conductore->delete();

        // Redireccionar a la vista de listado de conductores
        return redirect()->route('Conductore.index')->with('success', 'Conductor eliminado con éxito.');
    }
}
