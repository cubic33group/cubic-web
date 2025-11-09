<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class InvitationController extends Controller
{
    public function show($token)
    {
        $user = User::where('invitation_token', $token)->first();

        if (!$user) {
            return redirect()->route('login')
                ->with('error', 'Token de invitación inválido.');
        }

        if (!$user->isInvitationValid()) {
            return redirect()->route('login')
                ->with('error', 'La invitación ha expirado. Solicita una nueva invitación.');
        }

        $empresas = $user->clientes()
            ->wherePivot('status', 'invited')
            ->get();

        return view('auth.accept-invitation', compact('user', 'empresas', 'token'));
    }

    public function accept(Request $request, $token)
    {
        $user = User::where('invitation_token', $token)->first();

        if (!$user) {
            return redirect()->route('login')
                ->with('error', 'Token de invitación inválido.');
        }

        if (!$user->isInvitationValid()) {
            return redirect()->route('login')
                ->with('error', 'La invitación ha expirado.');
        }

        $request->validate([
            'password' => 'required|string|min:8|confirmed',
        ]);

        DB::beginTransaction();

        try {
            $user->password = Hash::make($request->password);
            $user->acceptInvitation();

            DB::table('cliente_user')
                ->where('user_id', $user->id)
                ->where('status', 'invited')
                ->update([
                    'status' => 'active',
                    'accepted_at' => now(),
                ]);

            DB::commit();

            Auth::login($user);

            return redirect()->route('dashboard')
                ->with('success', '¡Bienvenido! Tu cuenta ha sido activada exitosamente.');

        } catch (\Exception $e) {
            DB::rollBack();
            
            return redirect()->back()
                ->with('error', 'Error al procesar la invitación: ' . $e->getMessage());
        }
    }
}