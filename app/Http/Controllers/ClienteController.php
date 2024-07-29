<?php

namespace App\Http\Controllers;

use App\Http\Requests\ClienteRequest;
use App\Models\Cliente;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    public function index()
    {
        return Cliente::with('user')->get();
    }

    public function store(ClienteRequest $request)
    {
        $validated = $request->validated();
        $cliente = Cliente::create($validated);
        return response()->json($cliente, 201);
    }

    public function show(string $id)
    {
        $cliente = Cliente::find($id);
        if (!$cliente) {
            return response()->json([
                'message' => 'Cliente não encontrado'
            ]);
        }

        return response()->json($cliente, 200);
    }

    public function update(ClienteRequest $request, string $id)
    {
        $cliente = Cliente::find($id);
        if (!$cliente) {
            return response()->json([
                'message' => 'Cliente não encontrado'
            ]);
        }

        $validated = $request->validated();
        $cliente->update($validated);
        return response()->json($cliente, 200);
    }

    public function destroy(string $id)
    {
        $cliente = Cliente::find($id);
        if (!$cliente) {
            return response()->json([
                'message' => 'Cliente não encontrado'
            ]);
        }

        Cliente::destroy($id);

        return response()->json(null, 204);
    }
}
