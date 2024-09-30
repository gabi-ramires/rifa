<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function store(Request $request)
    {
        // Validação dos dados recebidos
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
        ]);

        // Criação do usuário com os dados validados
        $user = User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']),
        ]);

        // Retorno do usuário criado como resposta JSON
        return response()->json($user, 201);
    }

    public function index()
    {
        // Retorna todos os usuários como JSON
        $users = User::all();
        return response()->json($users);
    }

    public function show($id)
    {
        // Encontra o usuário pelo ID
        $user = User::find($id);

        // Verifica se o usuário foi encontrado
        if ($user) {
            return response()->json($user);
        } else {
            return response()->json(['message' => 'Usuário não encontrado.'], 404);
        }
    }

    public function update(Request $request, $id)
    {
        // Encontra o usuário pelo ID
        $user = User::find($id);

        // Verifica se o usuário foi encontrado
        if (!$user) {
            return response()->json(['message' => 'Usuário não encontrado.'], 404);
        }

        // Valida os dados recebidos
        $validatedData = $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'email' => 'sometimes|required|string|email|max:255|unique:users,email,' . $user->id,
            'password' => 'sometimes|required|string|min:8',
        ]);

        // Atualiza os dados do usuário com os valores validados
        if (isset($validatedData['name'])) {
            $user->name = $validatedData['name'];
        }
        if (isset($validatedData['email'])) {
            $user->email = $validatedData['email'];
        }
        if (isset($validatedData['password'])) {
            $user->password = Hash::make($validatedData['password']);
        }

        // Salva as alterações no banco de dados
        $user->save();

        // Retorna o usuário atualizado como resposta JSON
        return response()->json($user);
    }

    public function destroy($id)
    {
        // Encontra o usuário pelo ID
        $user = User::find($id);

        // Verifica se o usuário foi encontrado
        if (!$user) {
            return response()->json(['message' => 'Usuário não encontrado.'], 404);
        }

        // Deleta o usuário
        $user->delete();

        // Retorna uma resposta de sucesso
        return response()->json(['message' => 'Usuário excluído com sucesso.']);
    }





    
}
