@extends('layouts.plantilla')
@section('contenido')

    <h1>Alta de un Area</h1>

    <div class="alert bg-light p-4 col-8 mx-auto shadow">
        <form action="/area/store" method="post">
        @csrf
            <div class="form-group">
                <label for="descripcion">Nombre del Area</label>
                <input type="text" name="descripcion"
                       class="form-control" id="descripcion" required>
            </div>

            <button class="btn btn-dark my-3 px-4">Agregar Area</button>
            <a href="/areas" class="btn btn-outline-secondary">
                Volver a panel de Areas
            </a>
        </form>
    </div>

@endsection