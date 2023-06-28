<?php

namespace App\Http\Controllers;

use App\Models\Turno;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TurnosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.turnos.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.turnos.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }


    public function view(string $id)
    {
        return view('admin.turnos.view', [
            'turno' => json_encode(DB::selectOne('SELECT * FROM turnos WHERE id = ?', [$id]), true)
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return view('admin.turnos.show', [
            'turno' => json_encode(DB::selectOne('SELECT * FROM turnos WHERE id = ?', [$id]), true)
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        return view('turnos.edit', [
            'turno' => DB::selectOne('SELECT * FROM turnos WHERE id = ?', [$id])
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
