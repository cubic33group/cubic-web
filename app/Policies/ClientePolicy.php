<?php

namespace App\Policies;

use App\Models\Cliente;
use App\Models\User;

class ClientePolicy
{
    /**
     * Determina si el usuario puede ver cualquier cliente
     */
    public function viewAny(User $user): bool
    {
        // Todos los usuarios autenticados pueden ver la lista
        // pero el controlador filtra según su rol
        return true;
    }

    /**
     * Determina si el usuario puede ver un cliente específico
     */
    public function view(User $user, Cliente $cliente): bool
    {
        // Superadmin puede ver todo
        if ($user->isSuperAdmin()) {
            return true;
        }

        // Verificar si el usuario tiene acceso a este cliente
        return $user->hasAccessToCliente($cliente->id);
    }

    /**
     * Determina si el usuario puede crear clientes
     */
    public function create(User $user): bool
    {
        // Solo superadmin puede crear clientes
        return $user->isSuperAdmin();
    }

    /**
     * Determina si el usuario puede actualizar un cliente
     */
    public function update(User $user, Cliente $cliente): bool
    {
        // Superadmin puede editar todo
        if ($user->isSuperAdmin()) {
            return true;
        }

        // Company admin puede editar su propia empresa
        return $user->isCompanyAdmin($cliente->id);
    }

    /**
     * Determina si el usuario puede eliminar un cliente
     */
    public function delete(User $user, Cliente $cliente): bool
    {
        // Solo superadmin puede eliminar clientes
        return $user->isSuperAdmin();
    }

    /**
     * Determina si el usuario puede restaurar un cliente
     */
    public function restore(User $user, Cliente $cliente): bool
    {
        return $user->isSuperAdmin();
    }

    /**
     * Determina si el usuario puede eliminar permanentemente un cliente
     */
    public function forceDelete(User $user, Cliente $cliente): bool
    {
        return $user->isSuperAdmin();
    }

    /**
     * Determina si el usuario puede asignar otros usuarios a un cliente
     */
    public function assignUsers(User $user, Cliente $cliente): bool
    {
        // Superadmin o company admin pueden asignar usuarios
        return $user->isSuperAdmin() || $user->isCompanyAdmin($cliente->id);
    }
    
}