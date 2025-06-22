@extends('layouts.plantilla')
@section('contenido')

    <h1>Modificación de un Personal</h1>

    <div class="alert bg-light p-4 col-8 mx-auto shadow">
        <form action="/personal/update" method="post">
            @method('patch')
            @csrf

            <div class="form-group">
                <label for="nombre">Nombre</label>
                <input type="text" name="nombre"
                       value="{{ $personal->nombre }}"
                       class="form-control" id="nombre" required>

                <label for="apellido">Apellido</label>
                <input type="text" name="apellido"
                       value="{{ $personal->apellido }}"
                       class="form-control" id="apellido" required>

                <label for="dni">DNI</label>
                <input type="number" name="dni"
                       value="{{ $personal->dni }}"
                       class="form-control" id="dni" required>

                <label for="id_area">Área</label>
                <select name="id_area" id="id_area" class="form-select">
                    @foreach ($areas as $area)
                        <option value="{{ $area->id }}"
                            @if ($area->id == $personal->id_area) selected @endif>
                            {{ $area->nombre_area }}
                        </option>
                    @endforeach
                </select>
            </div>

            <input type="hidden" name="id" value="{{ $personal->id }}">

            <button class="btn btn-dark my-3 px-4">Modificar Personal</button>
            <a href="/personal" class="btn btn-outline-secondary">
                Volver al panel de Personal
            </a>
        </form>
    </div>

@endsection
