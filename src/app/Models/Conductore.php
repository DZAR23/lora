<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Conductore extends Model
{
    use HasFactory;

    // Permitir asignación masiva para estos atributos
    protected $fillable = ['name', 'movil', 'categoria', 'imagen', 'email', 'telefono'];

    /**
     * Obtiene la URL completa de la imagen del conductor.
     *
     * @return string
     */

    public function getImagenUrlAttribute()
    {
        // Asegúrate de que `imagen` tenga una ruta válida antes de intentar construir la URL
        if ($this->imagen) {
            // Retorna la URL completa de la imagen almacenada
            return storage_path('app/public/conductores/' . $this->imagen);
        }

        // Retorna una URL predeterminada si no hay imagen
        return 'https://via.placeholder.com/150';
    }

    /**
     * Obtiene la URL de la imagen para usar en vistas web.
     *
     * @return string
     */
    public function getImagenWebUrlAttribute()
    {
        // Usar Storage para obtener la URL pública
        if ($this->imagen) {
            return asset('storage/conductores/' . $this->imagen);
        }

        // Retorna una URL predeterminada si no hay imagen
        return 'https://via.placeholder.com/150';
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}