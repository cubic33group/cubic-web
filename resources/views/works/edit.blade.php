{{-- @extends('layouts.app')

@section('content') --}}
<x-app-layout>
<div style="min-height: 100vh; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); padding: 2rem 0;">
    <div style="max-width: 1200px; margin: 0 auto; padding: 0 1rem;">
        
        {{-- Header --}}
        <div style="background: rgba(255, 255, 255, 0.95); border-radius: 20px; padding: 2rem; margin-bottom: 2rem; box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1rem;">
                <div>
                    <h1 style="color: #2c4a6b; margin: 0; font-size: 28px; font-weight: 700;">
                        ✏️ Editar Obra
                    </h1>
                    <p style="color: #6b7280; margin: 0.5rem 0 0 0;">{{ $obra->name }}</p>
                </div>
                <a href="{{ route('works.show', $obra) }}" class="btn btn-secondary">
                    ← Volver a la Obra
                </a>
            </div>
        </div>

        {{-- Formulario --}}
        <form action="{{ route('works.update', $obra) }}" method="POST">
            @csrf
            @method('PUT')

            <div style="background: white; border-radius: 20px; padding: 2rem; box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);">
                
                {{-- Información Básica --}}
                <div style="margin-bottom: 2rem;">
                    <h3 style="color: #2c4a6b; font-size: 20px; font-weight: 600; margin-bottom: 1.5rem; border-bottom: 2px solid #FCC200; padding-bottom: 0.5rem;">
                        📋 Información Básica
                    </h3>

                    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 1.5rem;">
                        <div class="form-group">
                            <label class="form-label">Código *</label>
                            <input type="text" name="code" class="form-input" value="{{ old('code', $obra->code) }}" required>
                            @error('code')
                                <small style="color: #ef4444;">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label class="form-label">Nombre de la Obra *</label>
                            <input type="text" name="name" class="form-input" value="{{ old('name', $obra->name) }}" required>
                            @error('name')
                                <small style="color: #ef4444;">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label class="form-label">Cliente *</label>
                            <select name="client_id" class="form-select" required>
                                <option value="">Seleccionar cliente</option>
                                @foreach($clientes as $cliente)
                                    <option value="{{ $cliente->id }}" {{ old('client_id', $obra->client_id) == $cliente->id ? 'selected' : '' }}>
                                        {{ $cliente->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('client_id')
                                <small style="color: #ef4444;">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label class="form-label">Responsable *</label>
                            <select name="manager_user_id" class="form-select" required>
                                <option value="">Seleccionar responsable</option>
                                @foreach($managers as $usuario)
                                    <option value="{{ $usuario->id }}" {{ old('manager_user_id', $obra->manager_user_id) == $usuario->id ? 'selected' : '' }}>
                                        {{ $usuario->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('manager_user_id')
                                <small style="color: #ef4444;">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="form-group" style="grid-column: 1 / -1;">
                            <label class="form-label">Descripción</label>
                            <textarea name="description" rows="4" class="form-textarea">{{ old('description', $obra->description) }}</textarea>
                            @error('description')
                                <small style="color: #ef4444;">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                </div>

                {{-- Estado y Progreso --}}
                <div style="margin-bottom: 2rem;">
                    <h3 style="color: #2c4a6b; font-size: 20px; font-weight: 600; margin-bottom: 1.5rem; border-bottom: 2px solid #FCC200; padding-bottom: 0.5rem;">
                        🎯 Estado y Progreso
                    </h3>

                    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 1.5rem;">
                        <div class="form-group">
                            <label class="form-label">Estado *</label>
                            <select name="status" class="form-select" required>
                                <option value="planning" {{ old('status', $obra->status) == 'planning' ? 'selected' : '' }}>📝 Planeación</option>
                                <option value="in_progress" {{ old('status', $obra->status) == 'in_progress' ? 'selected' : '' }}>🚧 En Progreso</option>
                                <option value="paused" {{ old('status', $obra->status) == 'paused' ? 'selected' : '' }}>⏸️ Pausada</option>
                                <option value="completed" {{ old('status', $obra->status) == 'completed' ? 'selected' : '' }}>✅ Completada</option>
                                <option value="cancelled" {{ old('status', $obra->status) == 'cancelled' ? 'selected' : '' }}>❌ Cancelada</option>
                            </select>
                            @error('status')
                                <small style="color: #ef4444;">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label class="form-label">Progreso (%) *</label>
                            <input type="number" name="progress_pct" class="form-input" value="{{ old('progress_pct', $obra->progress_pct) }}" min="0" max="100" required>
                            @error('progress_pct')
                                <small style="color: #ef4444;">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label class="form-label">Fecha de Inicio</label>
                            <input type="date" name="start_date" class="form-input" value="{{ old('start_date', $obra->start_date ? $obra->start_date->format('Y-m-d') : '') }}">
                            @error('start_date')
                                <small style="color: #ef4444;">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label class="form-label">Fecha de Fin</label>
                            <input type="date" name="end_date" class="form-input" value="{{ old('end_date', $obra->end_date ? $obra->end_date->format('Y-m-d') : '') }}">
                            @error('end_date')
                                <small style="color: #ef4444;">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                </div>

                {{-- Ubicación --}}
                <div style="margin-bottom: 2rem;">
                    <h3 style="color: #2c4a6b; font-size: 20px; font-weight: 600; margin-bottom: 1.5rem; border-bottom: 2px solid #FCC200; padding-bottom: 0.5rem;">
                        📍 Ubicación
                    </h3>

                    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 1.5rem;">
                        <div class="form-group" style="grid-column: 1 / -1;">
                            <label class="form-label">Dirección</label>
                            <input type="text" name="address" class="form-input" value="{{ old('address', $obra->address) }}">
                            @error('address')
                                <small style="color: #ef4444;">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label class="form-label">Latitud</label>
                            <input type="number" step="any" name="lat" class="form-input" value="{{ old('lat', $obra->lat) }}">
                            @error('lat')
                                <small style="color: #ef4444;">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label class="form-label">Longitud</label>
                            <input type="number" step="any" name="lng" class="form-input" value="{{ old('lng', $obra->lng) }}">
                            @error('lng')
                                <small style="color: #ef4444;">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                </div>

                {{-- Presupuesto --}}
                <div style="margin-bottom: 2rem;">
                    <h3 style="color: #2c4a6b; font-size: 20px; font-weight: 600; margin-bottom: 1.5rem; border-bottom: 2px solid #FCC200; padding-bottom: 0.5rem;">
                        💰 Presupuesto
                    </h3>

                    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 1.5rem;">
                        <div class="form-group">
                            <label class="form-label">Monto</label>
                            <input type="number" step="0.01" name="budget_amount" class="form-input" value="{{ old('budget_amount', $obra->budget_amount) }}">
                            @error('budget_amount')
                                <small style="color: #ef4444;">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label class="form-label">Moneda</label>
                            <select name="currency" class="form-select">
                                <option value="MXN" {{ old('currency', $obra->currency) == 'MXN' ? 'selected' : '' }}>MXN - Peso Mexicano</option>
                                <option value="USD" {{ old('currency', $obra->currency) == 'USD' ? 'selected' : '' }}>USD - Dólar</option>
                                <option value="EUR" {{ old('currency', $obra->currency) == 'EUR' ? 'selected' : '' }}>EUR - Euro</option>
                            </select>
                            @error('currency')
                                <small style="color: #ef4444;">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                </div>

                {{-- Botones --}}
                <div style="display: flex; gap: 1rem; justify-content: flex-end; padding-top: 1.5rem; border-top: 1px solid #e5e7eb;">
                    <a href="{{ route('works.show', $obra) }}" class="btn btn-secondary">
                        Cancelar
                    </a>
                    <button type="submit" class="btn btn-primary">
                        💾 Guardar Cambios
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

<style>
    .form-group {
        margin-bottom: 0;
    }

    .form-label {
        display: block;
        font-size: 14px;
        font-weight: 600;
        color: #374151;
        margin-bottom: 0.5rem;
    }

    .form-input, .form-select, .form-textarea {
        width: 100%;
        padding: 0.75rem 1rem;
        border: 2px solid #e5e7eb;
        border-radius: 10px;
        font-size: 14px;
        transition: all 0.3s ease;
        background: white;
        color: #374151;
    }

    .form-input:focus, .form-select:focus, .form-textarea:focus {
        outline: none;
        border-color: #FCC200;
        box-shadow: 0 0 0 3px rgba(252, 194, 0, 0.1);
    }

    .btn {
        padding: 0.75rem 1.5rem;
        border-radius: 10px;
        font-weight: 600;
        font-size: 14px;
        cursor: pointer;
        transition: all 0.3s ease;
        border: none;
        text-decoration: none;
        display: inline-block;
    }

    .btn-primary {
        background: #FCC200;
        color: #2c4a6b;
    }

    .btn-primary:hover {
        background: #e6af00;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(252, 194, 0, 0.3);
    }

    .btn-secondary {
        background: #6b7280;
        color: white;
    }

    .btn-secondary:hover {
        background: #4b5563;
        transform: translateY(-2px);
    }
</style>
</x-app-layout>
{{-- @endsection --}}