<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PrepagasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.prepagas.index');
    }

    public function prepagasEliminadas()
    {
        dd('aaa');
        return view('admin.prepagas.eliminadas');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.prepagas.create');
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return view('admin.prepagas.edit', [
            'prepaga' => json_encode(DB::select("SELECT * FROM prepagas WHERE id = ?", [$id]))
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
