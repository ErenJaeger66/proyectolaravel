@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Registro de Mascotas
                    <a href="{{url('mascota/create')}}" class="btn btn-success">Crear Mascota <i class="fa-solid fa-circle-plus"></i></a>
                </div>

                <div class="card-body">
                   <table class="table">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Nombre</th>
                            <th>Color</th>
                            <th>Raza</th>
                            <th>Dueño</th>
                            <th>Fecha de Nacimiento</th>
                            <th>Edad</th>
                            <th>En Texto</th>
                            <th>Acción</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($mascotas as $mascota)
                          <tr>
                            <td>{{$mascota->id}}</td>
                            <td>{{$mascota->nombre}}</td>
                            <td>{{$mascota->color}}</td>
                            <td>{{$mascota->raza}}</td>
                            <td>{{$mascota->dueno}}</td>
                            <td>{{$mascota->fechanac}}</td>
                            <td>{{$mascota->edad}}</td>
                            <td>{{$mascota->palabra}}</td>
                            <td>
                                <a href="{{url('mascota/'.$mascota->id.'/edit')}}" class="btn btn-warning"><i class="fa-solid fa-pen-to-square"></i> Editar</a>
                                <form action="{{url('mascota/'.$mascota->id)}}" method="POST">
                                    @csrf
                                    <button class="btn btn-danger" type="submit"><i class="fa-solid fa-trash-can"></i> Eliminar</button>
                                    @method('DELETE')
                                </form>
                                <a target="-black" href="{{url('mascota/'.$mascota->id)}}" class="btn btn-info"><i class="fa-solid fa-eye"></i> Ver</a>                                
                            </td>
                          </tr>
                        @endforeach
                    </tbody>
                   </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection