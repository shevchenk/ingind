<?php

Route::get(
    '/', function () {
        return View::make('login');
    }
);

Route::get(
    'salir', function () {
        Auth::logout();

        return Redirect::to('/');
    }
);

Route::controller('check', 'LoginController');

Route::get(
    '/{ruta}', function ($ruta) {
    $val = explode("_", $ruta);
        $valores = array( 'valida_ruta_url' => $ruta );
            if (count($val) == 2) {
                $dv = explode("=", $val[1]);
                $valores[$dv[0]] = $dv[1];
            }

            return View::make($ruta)->with($valores);
    }
);

Route::controller('language', 'LanguageController');

Route::controller('area', 'AreaController');
Route::controller('cargo', 'CargoController');
Route::controller('flujo', 'FlujoController');
Route::controller('menu', 'MenuController');
Route::controller('opcion', 'OpcionController');
Route::controller('ruta_flujo', 'RutaFlujoController');
Route::controller('software', 'SoftwareController');
Route::controller('tiempo', 'TiempoController');
Route::controller('tipoRespuesta', 'TipoRespuestaController');
Route::controller('tipoRespuestaDetalle', 'TipoRespuestaDetalleController');
