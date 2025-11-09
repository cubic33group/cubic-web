<x-app-layout>
    <style>
        .form-input, .form-select {
    width: 100%;
    padding: 0.75rem 1rem;
    border: 2px solid #e5e7eb;
    border-radius: 10px;
    font-size: 14px;
    transition: all 0.3s ease;
    color: #000 !important; /* ← AGREGAR ESTA LÍNEA */
    background: white;
}
        .create-client-page {
            font-family: 'Inter', 'Segoe UI', system-ui, -apple-system, sans-serif;
            background: #f5f7fa;
            min-height: 100vh;
            padding: 2rem 0;
        }

        .page-header {
            background: linear-gradient(135deg, #2c4a6b 0%, #1e3449 100%);
            color: white;
            padding: 2rem;
            border-radius: 16px;
            margin-bottom: 2rem;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .page-header h1 {
            font-size: 28px;
            font-weight: 700;
            margin: 0;
        }

        .form-container {
            background: white;
            border-radius: 16px;
            padding: 2rem;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.06);
        }

        .section-title {
            font-size: 18px;
            font-weight: 600;
            color: #2c4a6b;
            margin-bottom: 1.5rem;
            padding-bottom: 0.5rem;
            border-bottom: 2px solid #FCC200;
        }

        .form-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 1.5rem;
            margin-bottom: 2rem;
        }

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

        .form-label.required::after {
            content: " *";
            color: #ef4444;
        }

        .form-input, .form-select {
            width: 100%;
            padding: 0.75rem 1rem;
            border: 2px solid #e5e7eb;
            border-radius: 10px;
            font-size: 14px;
            transition: all 0.3s ease;
        }

        .form-input:focus, .form-select:focus {
            outline: none;
            border-color: #FCC200;
            box-shadow: 0 0 0 3px rgba(252, 194, 0, 0.1);
        }

        .checkbox-container {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 1rem;
            background: #f9fafb;
            border-radius: 10px;
            border: 2px solid #e5e7eb;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .checkbox-container:hover {
            border-color: #FCC200;
            background: #fffbeb;
        }

        .checkbox-container input[type="checkbox"] {
            width: 20px;
            height: 20px;
            cursor: pointer;
        }

        .checkbox-label {
            font-weight: 600;
            color: #2c4a6b;
            cursor: pointer;
        }

        .user-section {
            background: #f9fafb;
            padding: 1.5rem;
            border-radius: 12px;
            border: 2px solid #e5e7eb;
            margin-top: 1rem;
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
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
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
        }

        .form-actions {
            display: flex;
            gap: 1rem;
            justify-content: flex-end;
            margin-top: 2rem;
            padding-top: 2rem;
            border-top: 1px solid #e5e7eb;
        }

        .error-message {
            color: #ef4444;
            font-size: 12px;
            margin-top: 0.25rem;
        }
    </style>

    <div class="create-client-page">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            {{-- Header --}}
            <div class="page-header">
                <h1>➕ Nuevo Cliente</h1>
            </div>

            {{-- Error Messages --}}
            @if (session('error'))
                <div class="mb-4 px-4 py-3 rounded-lg bg-red-100 border border-red-400 text-red-700">
                    {{ session('error') }}
                </div>
            @endif

            {{-- Form --}}
            <form action="{{ route('clientes.store') }}" method="POST">
                @csrf
                
                <div class="form-container">
                    
                    {{-- Información del Cliente --}}
                    <div class="section-title">📋 Información del Cliente</div>
                    
                    <div class="form-grid">
                        <div class="form-group">
                            <label class="form-label required">Nombre de la Empresa</label>
                            <input type="text" name="name" class="form-input" value="{{ old('name') }}" required>
                            @error('name')
                                <span class="error-message">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label class="form-label">Email de Contacto</label>
                            <input type="email" name="email" class="form-input" value="{{ old('email') }}">
                            @error('email')
                                <span class="error-message">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label class="form-label">Teléfono</label>
                            <input type="text" name="phone" class="form-input" value="{{ old('phone') }}">
                            @error('phone')
                                <span class="error-message">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label class="form-label">RFC / Tax ID</label>
                            <input type="text" name="tax_id" class="form-input" value="{{ old('tax_id') }}">
                            @error('tax_id')
                                <span class="error-message">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group" style="grid-column: 1 / -1;">
                            <label class="form-label">Dirección</label>
                            <input type="text" name="address" class="form-input" value="{{ old('address') }}">
                            @error('address')
                                <span class="error-message">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    {{-- Crear Usuario --}}
                    <div class="section-title">👤 Usuario Administrador</div>
                    
                    <label class="checkbox-container">
                        <input type="checkbox" name="create_user" id="create_user" value="1" {{ old('create_user') ? 'checked' : '' }}>
                        <span class="checkbox-label">Crear usuario administrador para este cliente</span>
                    </label>

                    {{-- Sección de Usuario (se muestra al marcar checkbox) --}}
                    <div id="user-section" class="user-section" style="display: {{ old('create_user') ? 'block' : 'none' }};">
                        <div class="form-grid">
                            <div class="form-group">
                                <label class="form-label required">Nombre</label>
                                <input type="text" name="user_first_name" class="form-input" value="{{ old('user_first_name') }}">
                                @error('user_first_name')
                                    <span class="error-message">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label class="form-label required">Apellido</label>
                                <input type="text" name="user_last_name" class="form-input" value="{{ old('user_last_name') }}">
                                @error('user_last_name')
                                    <span class="error-message">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label class="form-label required">Email</label>
                                <input type="email" name="user_email" class="form-input" value="{{ old('user_email') }}">
                                @error('user_email')
                                    <span class="error-message">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label class="form-label">Teléfono</label>
                                <input type="text" name="user_phone" class="form-input" value="{{ old('user_phone') }}">
                                @error('user_phone')
                                    <span class="error-message">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label class="form-label required">Rol en la Empresa</label>
                                <select name="user_role" class="form-select">
                                    <option value="company_admin" {{ old('user_role') == 'company_admin' ? 'selected' : '' }}>Administrador de Empresa</option>
                                    <option value="gestor" {{ old('user_role') == 'gestor' ? 'selected' : '' }}>Gestor</option>
                                    <option value="viewer" {{ old('user_role') == 'viewer' ? 'selected' : '' }}>Visualizador</option>
                                </select>
                                @error('user_role')
                                    <span class="error-message">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div style="margin-top: 1rem; padding: 1rem; background: #eff6ff; border-radius: 8px; font-size: 13px; color: #1e40af;">
                            ℹ️ Se enviará un email de invitación al usuario para que establezca su contraseña y acceda al sistema.
                        </div>
                    </div>

                    {{-- Actions --}}
                    <div class="form-actions">
                        <a href="{{ route('clientes.index') }}" class="btn btn-secondary">
                            Cancelar
                        </a>
                        <button type="submit" class="btn btn-primary">
                            💾 Crear Cliente
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Mostrar/ocultar sección de usuario
        document.getElementById('create_user').addEventListener('change', function() {
            const userSection = document.getElementById('user-section');
            userSection.style.display = this.checked ? 'block' : 'none';
            
            // Hacer campos requeridos o no
            const requiredInputs = userSection.querySelectorAll('input[name="user_first_name"], input[name="user_last_name"], input[name="user_email"]');
            requiredInputs.forEach(input => {
                input.required = this.checked;
            });
        });
    </script>
</x-app-layout>