@extends('layouts.plantilla')
    @section('contenido')
    <h1>Panel de administración de Areas</h1>

    
    @if( session('mensaje') )
        <div class="alert alert-{{ session('css') }}">
            {{ session('mensaje') }}
        </div>
    @endif

    <div class="row my-3 d-flex justify-content-between">
        <div class="col">
            <a href="/inicio" class="btn btn-outline-secondary">
                Listado
            </a>
        </div>
        <div class="col text-end">
            <a href="/area/create" class="btn btn-outline-secondary">
                <i class="bi bi-plus-square"></i>
                Agregar
            </a>
        </div>
    </div>


    <ul class="list-group">
        <li class="col-md-6 list-group-item list-group-item-action d-flex justify-content-between">
            <div class="col border">
                <span class="fs-4">Nombre del Area</span>
            </div>
            
            <div class="col border text-end btn-group">
                <span class="fs-4">Acciones</span>
            </div>
        </li>
        @foreach ($areas as $area)
        <li class="col-md-6 list-group-item list-group-item-action d-flex justify-content-between">
            <div class="col">
                <!-- <span class="fs-4">{{ $area->id }}</span> -->
                <span class="fs-4">{{ $area->nombre_area }}</span>
            </div>
            <div class="col text-end btn-group">
                <a href="/area/edit/{{ $area->id }}" class="btn btn-outline-secondary me-1">
                    <i class="bi bi-pencil-square"></i>
                    Modificar
                </a>
                <a href="/area/delete/{{ $area->id }}" class="btn btn-outline-secondary me-1">
                    <i class="bi bi-trash"></i>
                    &nbsp;Eliminar&nbsp;
                </a>
            </div>
        </li>
        @endforeach
    </ul>
    @endsection

    