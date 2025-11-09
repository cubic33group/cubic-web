<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class ObraMedia extends Model
{
    use HasFactory;

    /**
     * El nombre de la tabla asociada al modelo
     */
    protected $table = 'obras_media';

    /**
     * Los atributos que son asignables en masa
     */
    protected $fillable = [
        'detalle_id',
        'type',
        'path',
        'original_name',
        'mime_type',
        'size_bytes',
    ];

    /**
     * Los atributos que deben ser convertidos a tipos nativos
     */
    protected $casts = [
        'detalle_id' => 'integer',
        'size_bytes' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Appends para agregar atributos calculados
     */
    protected $appends = [
        'url',
        'size_formatted',
    ];

    /**
     * Relaciones
     */
    
    /**
     * Un archivo media pertenece a un detalle de obra
     */
    public function detalle()
    {
        return $this->belongsTo(ObraDetalle::class, 'detalle_id');
    }

    /**
     * Obtener la obra a través del detalle
     */
    public function obra()
    {
        return $this->hasOneThrough(
            Obra::class,
            ObraDetalle::class,
            'id', // Foreign key en obras_detalles
            'id', // Foreign key en obras
            'detalle_id', // Local key en obras_media
            'obra_id' // Local key en obras_detalles
        );
    }

    /**
     * Scopes
     */
    
    /**
     * Filtrar por tipo de archivo
     */
    public function scopeOfType($query, $type)
    {
        return $query->where('type', $type);
    }

    /**
     * Solo imágenes
     */
    public function scopeImages($query)
    {
        return $query->where('type', 'image');
    }

    /**
     * Solo documentos
     */
    public function scopeDocuments($query)
    {
        return $query->where('type', 'document');
    }

    /**
     * Solo videos
     */
    public function scopeVideos($query)
    {
        return $query->where('type', 'video');
    }

    /**
     * Accessors
     */
    
    /**
     * Obtiene la URL completa del archivo
     */
    public function getUrlAttribute()
    {
        return Storage::url($this->path);
    }

    /**
     * Obtiene el tamaño del archivo formateado
     */
    public function getSizeFormattedAttribute()
    {
        $bytes = $this->size_bytes;
        
        if ($bytes >= 1073741824) {
            return number_format($bytes / 1073741824, 2) . ' GB';
        } elseif ($bytes >= 1048576) {
            return number_format($bytes / 1048576, 2) . ' MB';
        } elseif ($bytes >= 1024) {
            return number_format($bytes / 1024, 2) . ' KB';
        } elseif ($bytes > 1) {
            return $bytes . ' bytes';
        } elseif ($bytes == 1) {
            return '1 byte';
        } else {
            return '0 bytes';
        }
    }

    /**
     * Verifica si es una imagen
     */
    public function isImage()
    {
        return $this->type === 'image';
    }

    /**
     * Verifica si es un documento
     */
    public function isDocument()
    {
        return $this->type === 'document';
    }

    /**
     * Verifica si es un video
     */
    public function isVideo()
    {
        return $this->type === 'video';
    }

    /**
     * Obtiene la extensión del archivo
     */
    public function getExtensionAttribute()
    {
        return pathinfo($this->original_name, PATHINFO_EXTENSION);
    }

    /**
     * Elimina el archivo físico del storage
     */
    public function deleteFile()
    {
        if (Storage::exists($this->path)) {
            Storage::delete($this->path);
        }
    }

    /**
     * Boot method para eventos del modelo
     */
    protected static function boot()
    {
        parent::boot();

        // Eliminar el archivo físico cuando se elimina el registro
        static::deleting(function ($media) {
            $media->deleteFile();
        });
    }
}