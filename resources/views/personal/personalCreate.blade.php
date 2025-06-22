@extends('layouts.plantilla')
@section('contenido')

    <h1>Alta de un Personal</h1>

    <div class="alert bg-light p-4 col-8 mx-auto shadow">
        <form action="/personal/store" method="post">
        @csrf
            <div class="form-group">
                <label for="nombre">Nombre</label>
                <input type="text" name="nombre"
                       class="form-control" id="nombre" required>

                <label for="apellido">Apellido</label>
                <input type="text" name="apellido"
                       class="form-control" id="apellido" required>
                
                <label for="dni">DNI</label>
                <input type="number" name="dni"
                       class="form-control" id="dni" required>

                <label for="id_area">Area</label>
                <select name="id_area" id="id_area" class="form-select">
                    @foreach ($areas as $area)
                        <option value="{{ $area->id }}">{{ $area->nombre_area }}</option>
                    @endforeach

                </select>
            </div>

            <button class="btn btn-dark my-3 px-4">Agregar Personal</button>
            <a href="/personal" class="btn btn-outline-secondary">
                Volver a panel de Personal
            </a>
        </form>
    </div>

@endsection