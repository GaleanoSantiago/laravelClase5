<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
// Para mostrar la vista del formulario
Route::get('/formulario', function () {
    return view('form');
});

// Aca envia los datos el formulario
Route::post('/proceso', function () {

    // Agarrar dato del formulario
    $nombre = request('nombre');

    // Retornar vista inicio y pasar variable nombre
    return view('inicio', ['nombre' => $nombre]);
});

// Vista de areas
// Route::get('/areas', function () {
//     $areas = DB::select('SELECT * FROM area');
//     // dd($areas);
//     return view('areas', ['areas' => $areas]);
// });

//=========================== CRUD De areas - Listar Areas =========================== 
Route::get('/areas', function () {

    // $areas = DB::select('SELECT id, descripcion FROM area');
     //Query Builder
     $areas= DB::table('area')->select('id', 'nombre_area')->get();
 
 
     //dd($areas);
     return view('areas',[ 'areas'=>$areas ] );
 });

 //Form crear Areaas
 Route::get('/area/create', function () {
 
     return view('areaCreate');
 });

//  Almacenar Areas
 Route::post('/area/store', function ()
 {
     //capturamos dato enviado por el form
     $descripcion = request()->descripcion;
     //insertar dato en tabla 
     try {
         //Raw SQL
        // DB::insert("
        //          INSERT INTO area
        //                  (descripcion)
        //              VALUES
        //                  ( :descripcion )",
        //                  [ $descripcion ]
        //          );
                 //Query Builder
         DB::table('area')
                 ->insert(
                     [ 'nombre_area'=>$descripcion ]
                 );
         return redirect('/areas')
                 ->with([
                     'mensaje'=>'Area: '.$descripcion.' agregada correctamente.',
                     'css'=>'success'
                 ]);
     }
     catch ( \Throwable $th ){
         return redirect('/areas')
             ->with([
                 'mensaje'=>'No se pudo agregar la Area: '.$descripcion,
                 'css'=>'danger'
             ]);
     }
 });
 Route::get('/area/edit/{id}', function ($id)
 {
     //obtenemos el dato de la Area por su id
   /* $area = DB::select(
                         'SELECT id, descripcion
                             FROM area
                             WHERE id = :id',
                             [ $id ]);
                            dd($area);*/
    
    // Query Builder
     $area = DB::table('area')
                     ->where('id', $id)
                     ->first();
 
     return view('areaEdit', [ 'area'=>$area ]);
 });
 Route::patch('/area/update', function ()
 {
     //capturamos datos enviados popr el form
     $id = request()->id;
     $descripcion = request()->descripcion;
     /**
      *  Raw SQL
      *  DB::update("UPDATE area
      *                   SET descripcion = :descripcion
      *                   WHERE id = :id",
      *                   [ $descripcion, $id ]
      *                 );
      */
     try {
         DB::table('area')
                 ->where( 'id', $id )
                 ->update(
                     [ 'nombre_area' => $descripcion ]
                 );
         return redirect('/areas')
                 ->with([
                         'mensaje'=>'Area: '.$descripcion.' modificada correctamente',
                         'css'=>'success'
                        ]);
     }
     catch ( \Throwable $th ){
         return redirect('/areas')
             ->with([
                 'mensaje'=>'No se pudo modificar el Area: '.$descripcion,
                 'css'=>'danger'
             ]);
     }
 });
 Route::get('/area/delete/{id}', function ($id)
 {
     //obtenemos datos de la Area por su id
     $area = DB::table('area')
                     ->where('id', $id)
                     ->first();
     //saber si hay Destinos relacionados
     /*$cantidad = DB::table('destinos')
                     ->where('id', $id)
                     ->count(); //first() : obj | null*/
    /*if( $cantidad ){
         return redirect('areas')
             ->with([
                 'mensaje' => 'No se puede borrar la Area: '.$area->descripcion,
                 'css' => 'warning'
             ]);
     }*/
 
     return view('areaDelete', [ 'area'=>$area ]);
 });
 Route::delete('/area/destroy', function ()
 {
     $id = request()->id;
     $descripcion = request()->descripcion;
     try{
         DB::table('area')
             ->where('id',$id)
             ->delete();
         return redirect('/areas')
             ->with([
                 'mensaje'=>'Area: '.$descripcion.' eliminada correctamente',
                 'css'=>'success'
             ]);
     }
     catch ( \Throwable $th ){
         return redirect('/areas')
             ->with([
                 'mensaje'=>'No se pudo eliminar la Area: '.$descripcion,
                 'css'=>'danger'
             ]);
     }
 });


//  ========================== Crud de Personal ==============================

Route::get('/personal', function () {

    // $areas = DB::select('SELECT id, descripcion FROM area');
     //Query Builder
     $personal= DB::table('personal')->select('id', 'nombre', 'apellido', 'dni', 'id_area')->get();
 
 
    //  dd($personal);
     return view('personal.personal',[ 'personal'=>$personal ] );
 });

 //Form crear personal
 Route::get('/personal/create', function () {
 
    $areas= DB::table('area')->select('id', 'nombre_area')->get();

    return view('personal.personalCreate',[ 'areas'=>$areas ] );
 });


 
//  Almacenar Personal
Route::post('/personal/store', function () {
    $nombre = request()->nombre;
    $apellido = request()->apellido;
    $dni = request()->dni;
    $id_area = request()->id_area;

    try {
        DB::table('personal')->insert([
            'nombre' => $nombre,
            'apellido' => $apellido,
            'dni' => $dni,
            'id_area' => $id_area
        ]);

        return redirect('/personal')->with([
            'mensaje' => 'Personal agregado correctamente.',
            'css' => 'success'
        ]);
    }
    catch (\Throwable $th) {
        return redirect('/personal')->with([
            'mensaje' => 'No se pudo agregar el personal.',
            'css' => 'danger'
        ]);
    }
});

// Editar un personal
Route::get('/personal/edit/{id}', function ($id) {
    $personal = DB::table('personal')->where('id', $id)->first();
    $areas = DB::table('area')->select('id', 'nombre_area')->get();

    return view('personal.personalEdit', [
        'personal' => $personal,
        'areas' => $areas
    ]);
});
// Actualizar personal
Route::patch('/personal/update', function () {
    $id = request()->id;
    $nombre = request()->nombre;
    $apellido = request()->apellido;
    $dni = request()->dni;
    $id_area = request()->id_area;

    try {
        DB::table('personal')
            ->where('id', $id)
            ->update([
                'nombre' => $nombre,
                'apellido' => $apellido,
                'dni' => $dni,
                'id_area' => $id_area
            ]);

        return redirect('/personal')->with([
            'mensaje' => 'Personal modificado correctamente.',
            'css' => 'success'
        ]);
    } catch (\Throwable $th) {
        return redirect('/personal')->with([
            'mensaje' => 'No se pudo modificar el personal.',
            'css' => 'danger'
        ]);
    }
});

// Confirmar eliminar
Route::get('/personal/delete/{id}', function ($id) {
    $personal = DB::table('personal')->where('id', $id)->first();

    return view('personal.personalDelete', [
        'personal' => $personal
    ]);
});


Route::delete('/personal/destroy', function () {
    $id = request()->id;
    $nombre = request()->nombre;

    try {
        DB::table('personal')->where('id', $id)->delete();

        return redirect('/personal')->with([
            'mensaje' => 'Personal "' . $nombre . '" eliminado correctamente.',
            'css' => 'success'
        ]);
    } catch (\Throwable $th) {
        return redirect('/personal')->with([
            'mensaje' => 'No se pudo eliminar el personal.',
            'css' => 'danger'
        ]);
    }
});
