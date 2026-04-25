<?php

namespace App\Http\Controllers;

use App\Models\Equipo;
use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\View\View;


class EquipoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index() : View

    {
        $data_equipos = Equipo::orderBy('created_at', 'desc')->get();
        
        return view('vista_equipos',compact('data_equipos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() // - <- Metodo ir al formulario
    {

        return view ('vista_fomulario_crear_equipo');

    
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) // - <- Metodo guardar formulario 
    {
        
    $equipo = new Equipo();
    $equipo->nombre = $request->input('nombre'); 
    $equipo->url_logo = $request->input('url_logo'); 
    $equipo->region = $request->input('region'); 
      

        $equipo->save();

        return redirect()->route('vista_equipos'); // - <- redireccion a index
    }

    /**
     * Display the specified resource.
     */
    public function show($idEquipo)
    {

    $data_detalle_equipo = Equipo::find($idEquipo);

    $patrocinadores= $data_detalle_equipo->patrocinadores()->get();
    return view( 'vista_detalle_equipo',compact('data_detalle_equipo','patrocinadores'));
     
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Equipo $equipo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Equipo $equipo)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Equipo $equipo)
    {
        //
    }
}
