@extends('layouts.plantilla')
    @section('contenido')
        <div class="col-8 mx-auto">
            <form action="/proceso" method="post">
                @csrf
                <div class="mb-3">
                    <label for="" class="class-label">
                        Nombre
                    </label>
                    <input type="text" name="nombre" class="form-control">
                </div>
                <div class="mb-3">
                    <button type="submit" class="btn btn-success">Enviar</button>

                </div>
            </form>
    
        </div>
    @endsection

    