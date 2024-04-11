<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Aluno;

class AlunoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $alunos = Aluno::all();
        return response()->json($alunos);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $request->validate([
            'nome' => 'required|string',
            'codigo' => 'required|string|unique:alunos,codigo',
            'turma' => 'required|string',
            'email' => 'required|string|email|unique:alunos,email',
        ]);

        $aluno = new Aluno();
        $aluno->nome = $request->input('nome');
        $aluno->codigo = $request->input('codigo');
        $aluno->turma = $request->input('turma');
        $aluno->email = $request->input('email');
        $aluno->save();

        return response()->json($aluno, 201);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $aluno = Aluno::findOrFail($id);
        return response()->json($aluno);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'nome' => 'required|string',
            'codigo' => 'required|string|unique:alunos,codigo,'.$id,
            'turma' => 'required|string',
            'email' => 'required|string|email|unique:alunos,email,'.$id,
        ]);

        $aluno = Aluno::findOrFail($id);
        $aluno->nome = $request->input('nome');
        $aluno->codigo = $request->input('codigo');
        $aluno->turma = $request->input('turma');
        $aluno->email = $request->input('email');
        $aluno->save();

        return response()->json($aluno, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $aluno = Aluno::findOrFail($id);
        $aluno->delete();
        return response()->json(null, 204);
    }
}
