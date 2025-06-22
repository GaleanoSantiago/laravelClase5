@extends('layouts.plantilla')
@section('contenido')

    <h1>Baja de una Area</h1>


    <div class="alert text-danger bg-light p-4 col-8 mx-auto shadow">
        Se eliminará la Area
        <span class="fs-4">{{ $area->nombre_area }}</span>.
        <form action="/area/destroy" method="post">
        @method('delete')
        @csrf
            <input type="hidden" name="id"
                   value="{{ $area->id }}">
            <input type="hidden" name="descripcion"
                   value="{{ $area->nombre_area }}">
            <button class="btn btn-danger btn-block my-3">Confirmar baja</button>
            <a href="/areas" class="btn btn-outline-secondary btn-block my-2">
                volver a panel
            </a>
        </form>

    </div>


@endsection