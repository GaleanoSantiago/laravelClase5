@extends('layouts.plantilla')
@section('contenido')

    <h1>Modificación de una Area</h1>

    <div class="alert bg-light p-4 col-8 mx-auto shadow">
        <form action="/area/update" method="post">
        @method('patch')
        @csrf
            <div class="form-group">
                <label for="descripcion">Nombre de la región</label>
                <input type="text" name="descripcion"
                       value="{{ $area-> nombre_area }}"
                       class="form-control" id="descripcion" required>

            </div>
            <input type="hidden" name="id"
                   value="{{ $area->id }}">

            <button class="btn btn-dark my-3 px-4">Modificar región</button>
            <a href="/areas" class="btn btn-outline-secondary">
                Volver a panel de Areas
            </a>
        </form>
    </div>

@endsection