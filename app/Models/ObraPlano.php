<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class ObraPlano extends Model
{
    use HasFactory;

    protected $table = 'obras_planos';

    protected $fillable = [
        'obra_id',
        'uploaded_by',
        'nombre_archivo',
        'ruta_archivo',
        'tamanio',
        'extension',
        'descripcion'
    ];

    protected $casts = [
        'tamanio' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    // Relaciones
    public function obra()
    {
        return $this->belongsTo(Obra::class);
    }

    public function uploadedBy()
    {
        return $this->belongsTo(User::class, 'uploaded_by');
    }

    // Accessor para obtener la URL del archivo
    public function getUrlAttribute()
    {
        return Storage::url($this->ruta_archivo);
    }

    // Método para eliminar el archivo físico
    public function deleteFile()
    {
        if (Storage::exists($this->ruta_archivo)) {
            return Storage::delete($this->ruta_archivo);
        }
        return false;
    }
}