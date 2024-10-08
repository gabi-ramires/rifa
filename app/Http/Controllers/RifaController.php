<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Rifa;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\ControleRifaController;

class RifaController extends Controller
{
    public function store(Request $request)
    {
        // Validação dos dados recebidos
        $validatedData = $request->validate([
            'user_id' => 'required|numeric|min:0',
            'nome' => 'required|string|max:255',
            'descricao' => 'required|string|max:255',
            'preco' => 'required|numeric|min:0',
            'total_rifas' => 'required|numeric|min:0|max:500',
        ]);
    
        // Criação da rifa com os dados validados
        $rifa = Rifa::create([
            'user_id' => $validatedData['user_id'],
            'nome' => $validatedData['nome'],
            'descricao' => $validatedData['descricao'],
            'preco' => $validatedData['preco'],
            'total_rifas' => $validatedData['total_rifas'],
        ]);

        // Cria o controle dos números das rifas
        $controle = new ControleRifaController;

        for ($numero=1; $numero <= $rifa->total_rifas; $numero++) { 
            $request_controler = [
                'rifa_id' => $rifa->id,
                'user_id' => $rifa->user_id,
                'numero' => $numero
            ];
            $request = new Request($request_controler);
    
            $controle->store($request);
        }

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
            'total_rifas' => 'required|numeric|min:0|max:500',
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

        if (isset($validatedData['total_rifas'])) {
            $rifa->total_rifas = $validatedData['total_rifas'];
        }

        // Salva as alterações no banco de dados
        $res = $rifa->save();

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

        // Remove todos os números da rifa
        $controle = new ControleRifaController;
        $controle->deleteByRifaId($id);
        

        // Retorna uma resposta de sucesso
        return response()->json(['message' => 'Rifa excluída com sucesso.']);
    }





    
}
