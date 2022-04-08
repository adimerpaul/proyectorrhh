<?php

namespace App\Http\Controllers;

use App\Models\Persona;
use App\Http\Requests\StorePersonaRequest;
use App\Http\Requests\UpdatePersonaRequest;
use Illuminate\Http\Request;


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
    public function upload(Request $request){
        if ($request->hasFile('imagen')){
            $file=$request->file('imagen');
            $nombre=time().'.'.$file->getClientOriginalExtension();
            $file->move(\public_path('imagenes'),$nombre);
            $persona=Persona::find($request->persona_id);
            $persona->foto=$nombre;
            $persona->save();
            return $nombre;
        }else{
            return "no existe la imagen";
        }
    }
    public function base64(Request $request){
        if ($request->imagen==''){
            return '';
        }
        $path = 'imagenes/'.$request->imagen;
        $type = pathinfo($path, PATHINFO_EXTENSION);
        $data = file_get_contents($path);
        $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
        return $base64;

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
        $persona->fechafin=$request->fechafin;
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
        $persona->fechafin=$request->fechafin;
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
