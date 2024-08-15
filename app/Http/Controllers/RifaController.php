<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Rifa;
use Illuminate\Support\Facades\Hash;

class RifaController extends Controller
{
    public function store(Request $request)
    {
        // Validação dos dados recebidos
        $validatedData = $request->validate([
            'nome' => 'required|string|max:255',
            'descricao' => 'required|string|max:255',
            'preco' => 'required|numeric|min:0', // Garante que o preço seja um número decimal
        ]);
    
        // Criação da rifa com os dados validados
        $rifa = Rifa::create([
            'nome' => $validatedData['nome'],
            'descricao' => $validatedData['descricao'],
            'preco' => $validatedData['preco'], // Formata o preço para decimal
        ]);

        return response()->json($rifa, 201);
    }
    

    public function index()
    {
        // Retorna todas as rifas como JSON
        $rifas = Rifa::all();
        return response()->json($rifas);
    }

    public function show($id)
    {
        // Encontra a rifa pelo ID
        $rifa = Rifa::find($id);

        // Verifica se a rifa foi encontrada
        if ($rifa) {
            return response()->json($rifa);
        } else {
            return response()->json(['message' => 'Rifa não encontrada.'], 404);
        }
    }

    public function update(Request $request, $id)
    {
        // Encontra a rifa pelo ID
        $rifa = Rifa::find($id);

        // Verifica se a rifa foi encontrada
        if (!$rifa) {
            return response()->json(['message' => 'Rifa não encontrada.'], 404);
        }

        // Valida os dados recebidos
        $validatedData = $request->validate([
            'nome' => 'sometimes|required|string|max:255',
            'descricao' => 'sometimes|required|string|max:255',
            'preco' => 'sometimes|required|numeric|min:0',
        ]);

        // Atualiza os dados do usuário com os valores validados
        if (isset($validatedData['nome'])) {
            $rifa->nome = $validatedData['nome'];
        }
        if (isset($validatedData['descricao'])) {
            $rifa->descricao = $validatedData['descricao'];
        }
        if (isset($validatedData['preco'])) {
            $rifa->preco = $validatedData['preco'];
        }

        // Salva as alterações no banco de dados
        $rifa->save();

        // Retorna a rifa atualizada como resposta JSON
        return response()->json($rifa);
    }

    public function destroy($id)
    {
        // Encontra a rifa pelo ID
        $rifa = Rifa::find($id);

        // Verifica se a rifa foi encontrada
        if (!$rifa) {
            return response()->json(['message' => 'Rifa não encontrada.'], 404);
        }

        // Deleta a rifa
        $rifa->delete();

        // Retorna uma resposta de sucesso
        return response()->json(['message' => 'Rifa excluída com sucesso.']);
    }





    
}
