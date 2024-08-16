<?php

namespace App\Http\Controllers;

use App\Models\ControleRifa;
use Illuminate\Http\Request;

class ControleRifaController extends Controller
{
    // Exibir uma lista de todos os registros
    public function index()
    {
        $controleRifas = ControleRifa::all();
        return response()->json($controleRifas);
    }

    // Exibir um registro específico
    public function show($id)
    {
        $controleRifa = ControleRifa::findOrFail($id);
        return response()->json($controleRifa);
    }

    // Criar um novo registro
    public function store(Request $request)
    {
        $request->validate([
            'rifa_id' => 'required|exists:rifas,id',
            'user_id' => 'required|exists:users,id',
            'numero' => 'required|integer',
        ]);

        $controleRifa = ControleRifa::create($request->all());
        return response()->json($controleRifa, 201);
    }

    // Atualizar um registro existente
    public function update(Request $request, $id)
    {
        $request->validate([
            'rifa_id' => 'required|exists:rifas,id',
            'user_id' => 'required|exists:users,id',
            'numero' => 'required|integer',
            'nome_comprador' => 'required|string|max:255',
        ]);

        $controleRifa = ControleRifa::findOrFail($id);
        $controleRifa->update($request->all());
        return response()->json($controleRifa);
    }

    // Excluir um registro
    public function destroy($id)
    {
        $controleRifa = ControleRifa::findOrFail($id);
        $controleRifa->delete();
        return response()->json(null, 204);
    }

    public function deleteByRifaId($rifaId)
    {
        // Deleta todos os registros com o rifa_id especificado
        ControleRifa::where('rifa_id', $rifaId)->delete();

        return response()->json(['message' => 'Números da rifa excluídos com sucesso.'], 200);
    }
}
