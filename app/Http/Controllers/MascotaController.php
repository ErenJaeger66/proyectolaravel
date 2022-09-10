<?php

namespace App\Http\Controllers;

use Datetime;
use App\Models\Mascota;
use Illuminate\Support\Facades\App;
use Luecano\NumeroALetras\NumeroALetras;
use App\Http\Requests\StoreMascotaRequest;
use App\Http\Requests\UpdateMascotaRequest;

class MascotaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        /*return view('mascota.index');*/
        $mascotas=Mascota::all();
        foreach($mascotas as $mascota){
            $cumpleanos = new DateTime($mascota->fechanac);
            $hoy = new DateTime();
            $annos = $hoy->diff($cumpleanos);            
            $mascota->edad=$annos->y;

            $formatter = new NumeroALetras();
            $palabra=$formatter->toWords($mascota->edad);
            $mascota->palabra=$palabra;
        }
        $data['mascotas']=$mascotas;
        return view('mascota.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('mascota.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreMascotaRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreMascotaRequest $request)
    {
        $mascota = Mascota::create($request->all());
        return redirect()->route('mascota.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Mascota  $mascota
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //return $id;
        $mascota=Mascota::find($id);
        $pdf = App::make('dompdf.wrapper');
        $pdf->loadHTML('<center><h2>Datos de la Mascota</h2></center><p>'
                       .'<div> <b>Nombre: </b>'.$mascota->nombre.'</div>'
                       .'<div> <b>Raza: </b>'.$mascota->raza.'</div>'
                       .'<div> <b>Dueño: </b>'.$mascota->dueno.'</div>'
                       .'<div> <b>Fecha de Nacimiento: </b>'.$mascota->fechanac.'</div>'
                      );
        return $pdf->stream();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Mascota  $mascota
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['mascota']=Mascota::find($id);
        return view('mascota.editar',$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateMascotaRequest  $request
     * @param  \App\Models\Mascota  $mascota
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateMascotaRequest $request, $id)
    {
        $mascota=Mascota::find($id);
        $mascota->update($request->all());
        return redirect()->route('mascota.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Mascota  $mascota
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $mascota=Mascota::find($id);
        $mascota->delete();
        return redirect()->route('mascota.index');
    }
}
