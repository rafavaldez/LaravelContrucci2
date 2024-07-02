<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AutenticarController extends Controller
{
    public function showLoginForm()
    {
        return view('autenticacion.autenticacion');
    }
    public function login(Request $request)
    {
        $request->validate([
            'dni' => 'required|string',
            'password' => 'required|string',
        ]);

        $dni = $request->input('dni');
        $password = $request->input('password');

        // Verifica si los datos no están vacíos
        if (empty($dni) || empty($password)) {
            return back()->withErrors(['message' => 'Datos de entrada incompletos'])->withInput();
        }

        $user = User::where('dni', $dni)->first();

        if ($user) {
            if ($user->contrasenaHash === $password) {
                Auth::login($user);

                $roles = $user->roles;

                if (in_array('admin', $roles)) {
                    return redirect()->route('admin_home');
                } else {
                    return redirect()->route('admin_RegistroPacientes');
                }
            } else {
                return back()->withErrors(['message' => 'Contraseña incorrecta'])->withInput();
            }
        } else {
            return back()->withErrors(['message' => 'Usuario no encontrado'])->withInput();
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
