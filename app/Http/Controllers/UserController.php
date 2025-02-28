<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{

    public function index()
    {
        try {
        
            $parametros = [
                "users" => User::withTrashed()->paginate(50)
            ];

            return view('ver_usuarios', $parametros);

        } catch (\Exception $e) {
            return back()->with('error', 'Ocorreu um erro ao tentar carregar os dados. Por favor, tente novamente.');
        }
    }    

    public function create()
    {
        try {
            $ultimoUsuario = User::max('id');
            
            $proximoId = $ultimoUsuario + 1;
    
            $parametros = [
                "users" => User::all(),
                "proximo_id" => $proximoId
            ];
            return view('users', $parametros);

        } catch (\Exception $e) {
            return back()->with('error', 'Ocorreu um erro ao tentar carregar os dados. Por favor, tente novamente.');
        }
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email'
        ], [
            'email.unique' => 'Este e-mail já está cadastrado.'
        ]);
    
        User::create([
            'name' => $request->name,
            'email' => $request->email
        ]);
    
        return response()->json([
            'message' => 'Usuário cadastrado com sucesso!',
        ]);
    }
    
    public function show(Request $request, $id)
    {
        try {
      
            $user = User::withTrashed()->find($id);

            $parametros = [
                "user" => $user
            ];
          
            return view('ver_usuario', $parametros);
        } catch (\Exception $e) {
            return back()->with('error', 'Ocorreu um erro ao tentar carregar os dados. Por favor, tente novamente.');
        }
    }

    public function update(Request $request, string $id)
    {
        $user = User::findOrFail($id); 

        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();

        return response()->json([
            'message' => 'Usuário atualizado com sucesso!'
        ]);
    }

    public function destroy($id)
    {
        try {
            $user = User::findOrFail($id); 

            $user->delete();
            
            return redirect()->route('users.index')->with('success', 'Usuário inativado com sucesso!');
        } catch (\Exception $e) {
            return redirect()->route('users.index')->with('error', 'Erro ao tentar inativar o usuário.');
        }
    }

    public function restore($id)
    {
        try {
            $user = User::withTrashed()->findOrFail($id);   

            $user->restore();

            return redirect()->route('users.index')->with('success', 'Usuário ativado com sucesso!');
        } catch (\Exception $e) {
            return redirect()->route('users.index')->with('error', 'Erro ao tentar ativar o usuário.');
        }
    }

}
