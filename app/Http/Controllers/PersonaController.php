<?php

namespace App\Http\Controllers;

use App\Models\Persona;
use App\Http\Requests\StorePersonaRequest;
use App\Http\Requests\UpdatePersonaRequest;


class PersonaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Persona::all();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePersonaRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UpdatePersonaRequest $request)
    {
        $persona=new Persona();
        $persona->paterno=$request->paterno;
        $persona->materno=$request->materno;
        $persona->nombres=$request->nombres;
        $persona->ci=$request->ci;
        $persona->cargo=$request->cargo;
        $persona->foto='';
        $persona->sueldo=$request->sueldo;
        $persona->fecharegistro=date('Y-m-d');
        $persona->save();
        return $persona;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Persona  $persona
     * @return \Illuminate\Http\Response
     */
    public function show(Persona $persona)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Persona  $persona
     * @return \Illuminate\Http\Response
     */
    public function edit(Persona $persona)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePersonaRequest  $request
     * @param  \App\Models\Persona  $persona
     * @return \Illuminate\Http\Response
     */
    public function update(StorePersonaRequest $request, Persona $persona)
    {
        $persona->paterno=$request->paterno;
        $persona->materno=$request->materno;
        $persona->nombres=$request->nombres;
        $persona->ci=$request->ci;
        $persona->cargo=$request->cargo;
        $persona->sueldo=$request->sueldo;
        $persona->save();
        return $persona;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Persona  $persona
     * @return \Illuminate\Http\Response
     */
    public function destroy(Persona $persona)
    {
        $persona->delete();
        return $persona;
    }
}
