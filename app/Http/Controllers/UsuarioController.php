<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UsuarioController extends Controller
{
    public function index()
    {
        $usuarios = User::all();
        return view('admin.gestionar_usuario', compact('usuarios'));
    }


    public function registrar(Request $request)
    {
        $request->validate([
            'nombreUsuario' => 'required|string|max:255',
            'nombre' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'dni' => 'required|string|max:8',
            'correoElectronico' => 'required|email|max:255',
            'contrasenaHash' => 'required|string|min:8',
            'fechaRegistro' => 'required|date_format:Y-m-d\TH:i:s',
            'roles' => 'required|array',
            'activo' => 'required|boolean',
        ]);

        User::create($request->all());

        return redirect()->route('admin.agregar')->with('success', 'Usuario creado correctamente.');
    }

    

    public function editar(User $usuario)
    {
        return view('admin.editar', compact('usuario'));
    }


    public function actualizar(Request $request, User $usuario)
    {
        $request->validate([
            'nombreUsuario' => 'required|string|max:255',
            'nombre' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'dni' => 'required|string|max:8',
            'correoElectronico' => 'required|email|max:255',
            'contrasenaHash' => 'nullable|string|min:8',
            'fechaRegistro' => 'required|date_format:Y-m-d\TH:i:s',
            'roles' => 'required|array',
            'activo' => 'required|boolean',
        ]);

        $usuario->update($request->all());

        return redirect()->route('admin.gestionar_usuario')->with('success', 'Usuario actualizado correctamente.');
    }

    public function eliminar(User $usuario)
    {
        $usuario->delete();
        return redirect()->route('admin.gestionar_usuario')->with('success', 'Usuario eliminado correctamente.');
    }
}
