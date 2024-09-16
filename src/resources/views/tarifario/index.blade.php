@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="text-2xl font-bold mb-4">Tarifarios</h1>
    <a href="{{ route('tarifario.create') }}" class="btn btn-primary mb-4">Crear Nuevo Tarifario</a>
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <table class="table-auto w-full border-collapse border border-gray-200">
        <thead>
            <tr>
                <th class="border border-gray-300 px-4 py-2">Nombre</th>
                <th class="border border-gray-300 px-4 py-2">Precio</th>
                <th class="border border-gray-300 px-4 py-2">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($tarifarios as $tarifario)
                <tr>
                    <td class="border border-gray-300 px-4 py-2">{{ $tarifario->nombre }}</td>
                    <td class="border border-gray-300 px-4 py-2">{{ $tarifario->precio }}</td>
                    <td class="border border-gray-300 px-4 py-2">
                        <a href="{{ route('tarifario.edit', $tarifario) }}" class="text-blue-500">Editar</a>
                        <form action="{{ route('tarifario.destroy', $tarifario) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-500">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
