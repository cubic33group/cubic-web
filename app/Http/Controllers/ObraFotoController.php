<?php

namespace App\Http\Controllers;

use App\Models\Obra;
use App\Models\ObraFoto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ObraFotoController extends Controller
{
    public function store(Request $request, Obra $obra)
    {
        try {
            $request->validate([
                'fotos.*' => 'required|image|mimes:jpg,jpeg,png,gif|max:10240',
                'descripcion' => 'nullable|string|max:500',
                'fecha_captura' => 'nullable|date'
            ]);

            $fotos = $request->file('fotos');
            $fotosGuardadas = [];

            foreach ($fotos as $foto) {
                $nombreOriginal = $foto->getClientOriginalName();
                $extension = $foto->getClientOriginalExtension();
                $nombreUnico = Str::slug(pathinfo($nombreOriginal, PATHINFO_FILENAME)) . '_' . time() . '_' . uniqid() . '.' . $extension;
                
                $ruta = $foto->storeAs('fotos/' . $obra->id, $nombreUnico, 'public');

                $fotoModel = $obra->fotos()->create([
                    'uploaded_by' => auth()->id(),
                    'nombre_archivo' => $nombreOriginal,
                    'ruta_archivo' => $ruta,
                    'tamanio' => $foto->getSize(),
                    'extension' => $extension,
                    'descripcion' => $request->descripcion,
                    'fecha_captura' => $request->fecha_captura ?? now()
                ]);

                $fotoModel->load('uploadedBy');
                $fotosGuardadas[] = $fotoModel;
            }

            return response()->json([
                'success' => true,
                'message' => count($fotosGuardadas) . ' foto(s) subida(s) exitosamente',
                'fotos' => $fotosGuardadas
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al subir las fotos: ' . $e->getMessage()
            ], 500);
        }
    }

    public function destroy(Obra $obra, ObraFoto $foto)
    {
        try {
            if ($foto->obra_id !== $obra->id) {
                return response()->json([
                    'success' => false,
                    'message' => 'Foto no encontrada'
                ], 404);
            }

            $foto->deleteFile();
            $foto->delete();

            return response()->json([
                'success' => true,
                'message' => 'Foto eliminada exitosamente'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al eliminar la foto: ' . $e->getMessage()
            ], 500);
        }
    }
}