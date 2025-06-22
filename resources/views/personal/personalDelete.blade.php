@extends('layouts.plantilla')
@section('contenido')

    <h1>Baja de un Personal</h1>

    <div class="alert text-danger bg-light p-4 col-8 mx-auto shadow">
        Se eliminará el personal:
        <span class="fs-4">{{ $personal->nombre }} {{ $personal->apellido }}</span>.
        <form action="/personal/destroy" method="post">
            @method('delete')
            @csrf
            <input type="hidden" name="id" value="{{ $personal->id }}">
            <input type="hidden" name="nombre" value="{{ $personal->nombre }} {{ $personal->apellido }}">

            <button class="btn btn-danger btn-block my-3">Confirmar baja</button>
            <a href="/personal" class="btn btn-outline-secondary btn-block my-2">
                Volver al panel
            </a>
        </form>
    </div>

@endsection
