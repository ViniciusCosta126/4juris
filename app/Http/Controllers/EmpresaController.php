<?php

namespace App\Http\Controllers;

use App\Http\Requests\EmpresaRequest;
use App\Models\Empresa;
use Illuminate\Http\Request;

class EmpresaController extends Controller
{
    public function index()
    {
        return Empresa::all();
    }

    public function store(EmpresaRequest $request)
    {
        $validated = $request->validated();
        $empresa = Empresa::create($validated);

        return response()->json($empresa, 201);
    }

    public function show(string $id)
    {
        $empresa = Empresa::find($id);

        if (!$empresa) {
            return response()->json([
                'message' => 'Empresa não encontrada'
            ]);
        }
        return response()->json($empresa, 200);
    }

    public function update(EmpresaRequest $request, string $id)
    {
        $empresa = Empresa::find($id);

        if (!$empresa) {
            return response()->json([
                'message' => 'Empresa não encontrada'
            ]);
        }

        $validated = $request->validated();
        $empresa->update($validated);
        return response()->json($empresa, 200);
    }

    public function destroy(string $id)
    {
        $empresa = Empresa::find($id);

        if (!$empresa) {
            return response()->json([
                'message' => 'Empresa não encontrada'
            ]);
        }

        Empresa::destroy($id);
        return response()->json(null, 204);
    }
}
