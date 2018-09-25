<?php

class CarnetCanesQRController extends \BaseController
{

    /**
     * cargar modulos, mantenimiento
     * POST /cargo/cargar
     *
     * @return Response
     */
    public function postCargar()
    {
        //si la peticion es ajax
        if ( Request::ajax() ) {
            $cargos = CarnetCanesQR::get(Input::all());
            return Response::json(array('rst'=>1,'datos'=>$cargos));
        }
    }
    /**
     * Store a newly created resource in storage.
     * POST /cargo/listar
     *
     * @return Response
     */
    /*
    public function postListar()
    {
        //si la peticion es ajax
        if ( Request::ajax() ) {
            
            if (Input::get('usuario_id')) {
                $usuarioId = Input::get('usuario_id');
                $cargos = DB::table('submodulo_usuario as su')
                        ->rightJoin(
                            'submodulos as s', function($join) use ($usuarioId)
                            {
                            $join->on('su.submodulo_id', '=', 's.id')
                            ->on('su.usuario_id', '=', DB::raw($usuarioId));
                            }
                        )
                        ->rightJoin(
                            'modulos as m', 
                            's.modulo_id', '=', 'm.id'
                        )
                        ->select(
                            'm.nombre',
                            DB::raw('MAX(su.estado) as estado')
                        )
                        ->where('m.estado', '=', 1)
                        ->groupBy('m.nombre')
                        ->orderBy('m.nombre')
                        ->get();
            } else {
                $cargos = DB::table('cargos')
                            ->select('id', 'nombre')
                            ->where('estado', '=', '1')
                            ->orderBy('nombre')
                            ->get();
            }
        
            return Response::json(array('rst'=>1,'datos'=>$cargos));
        }
    }
    */
    /**
     * Store a newly created resource in storage.
     * POST /cargo/cargaropciones
     *
     * @return Response
     */
    /*
    public function postCargaropciones()
    {
        $cargoId = Input::get('cargo_id');
        $cargo = new Cargo;
        $opciones = $cargo->getOpciones($cargoId);
        return Response::json(array('rst'=>1,'datos'=>$opciones));
    }
    */
    /**
     * Store a newly created resource in storage.
     * POST /cargo/crear
     *
     * @return Response
     */
    public function postCrear()
    {
        //si la peticion es ajax
        if ( Request::ajax() ) {
            $regex='regex:/^([a-zA-Z .,ñÑÁÉÍÓÚáéíóú]{2,60})$/i';
            $required='required';
            $reglas = array(
                'nombre' => $required.'|'.$regex,
                //'path' =>$regex.'|unique:modulos,path,',
            );

            $mensaje= array(
                'required'    => ':attribute Es requerido',
                'regex'        => ':attribute Solo debe ser Texto',
            );

            $validator = Validator::make(Input::all(), $reglas, $mensaje);

            if ( $validator->fails() ) {
                return Response::json(
                    array(
                    'rst'=>2,
                    'msj'=>$validator->messages(),
                    )
                );
            }

            $cargo = new CarnetCanesQR;
            $cargo->serie = Input::get('serie');
            $cargo->nombre = Input::get('nombre');
            $cargo->paterno = Input::get('paterno');
            $cargo->materno = Input::get('materno');
            $cargo->fecha_entrega = Input::get('fecha_entrega');
            $cargo->fecha_nace = Input::get('fecha_nace');
            $cargo->sexo = Input::get('sexo');
            $cargo->raza = Input::get('raza');

            $cargo->estado = Input::get('estado');
            $cargo->persona_id_created_at = Auth::user()->id;
            $cargo->save();

            return Response::json(
                array(
                'rst'=>1,
                'msj'=>'Registro realizado correctamente',
                )
            );
        }
    }

    /**
     * Update the specified resource in storage.
     * POST /cargo/editar
     *
     * @return Response
     */
    public function postEditar()
    {
        if ( Request::ajax() ) {
            $regex='regex:/^([a-zA-Z .,ñÑÁÉÍÓÚáéíóú]{2,60})$/i';
            $required='required';
            $reglas = array(
                'nombre' => $required.'|'.$regex,
            );

            $mensaje= array(
                'required'    => ':attribute Es requerido',
                'regex'        => ':attribute Solo debe ser Texto',
            );

            $validator = Validator::make(Input::all(), $reglas, $mensaje);

            if ( $validator->fails() ) {
                return Response::json(
                    array(
                    'rst'=>2,
                    'msj'=>$validator->messages(),
                    )
                );
            }
            $cargoId = Input::get('id');

            $cargos = CarnetCanesQR::find($cargoId);
            $cargos->nombre = Input::get('nombre');
            $cargos->estado = Input::get('estado');
            $cargos->usuario_updated_at = Auth::user()->id;
            $cargos->save();
                        
            return Response::json(
                array(
                'rst'=>1,
                'msj'=>'Registro actualizado correctamente',
                )
            );
        }
    }

    /**
     * Changed the specified resource from storage.
     * POST /cargo/cambiarestado
     *
     * @return Response
     */
    public function postCambiarestado()
    {

        if ( Request::ajax() ) {
            $estado = Input::get('estado');
            $cargoId = Input::get('id');
            $cargo = CarnetCanesQR::find($cargoId);
            $cargo->persona_id_updated_at = Auth::user()->id;
            $cargo->estado = Input::get('estado');
            $cargo->save();

            return Response::json(
                array(
                'rst'=>1,
                'msj'=>'Registro actualizado correctamente',
                )
            );    

        }
    }


    /* ***************** GENERACIÓN DE IMAGEN PARA IMPRIMIR ********************** */
    public function getCrearcarnetqr($id, $serie, $tamano, $tipo)
    {
        ini_set("max_execution_time", 300);
        ini_set('memory_limit','512M');        

        /*end get destinatario data*/
        //$vistaprevia='';
        $size = 80; // TAMAÑO EN PX

        $png = QrCode::format('png')
                        ->margin(0)
                        ->size($size)
                        ->color(40,40,40)
                        ->generate("http://proceso.munindependencia.pe/carnetcanes/vistacarnetqrvalida/".$id."/".$serie."/".$tamano."/".$tipo)
                        ;
        
        file_put_contents("img/carnet_cane/temp.png", $png);
        $oData=CarnetCanesQR::verData($id);

        //ini_set("display_errors", true);
        header('Content-type: image/png');
        header('Content-Disposition: attachment; filename="carnet.jpg"');
        
        $nombres = $oData[0]->nombre;
        $apellidos = $oData[0]->paterno.' '.$oData[0]->materno;
        $serie = $oData[0]->serie;
        $fecha_entrega = $oData[0]->fecha_entrega;
        $fecha_nace = $oData[0]->fecha_nace;        
        $sexo = $oData[0]->sexo;
        $raza = $oData[0]->raza;
        $rutaFoto = "http://proceso.munindependencia.pe/img/carnet_cane/".$oData[0]->foto;

        //http://proceso.munindependencia.pe/img/carnet_cane/42892330.jpg
        $rutaQR = "img/carnet_cane/temp.png";

        $im = $this->crearCarnet($nombres, $apellidos, $serie, $fecha_entrega, $fecha_nace, $sexo, $raza, $rutaFoto, $rutaQR);

        imagejpeg($im);
        imagedestroy($im);
    }

    public function crearCarnet($nombres, $apellidos, $serie, $fecha_entrega, $fecha_nace, $sexo, $raza, $rutaFoto, $rutaQR)
    {
        $im = imagecreatefromjpeg ('http://proceso.munindependencia.pe/img/carnet_cane/carnet.jpg');

        $black = imagecolorallocate($im, 0, 0, 0);

        function imagettftextSp($image, $size, $angle, $x, $y, $color, $font, $text, $spacing = 0)
        {
            if ($spacing == 0)
            {
                imagettftext($image, $size, $angle, $x, $y, $color, $font, ($text));
            }
            else
            {
                $temp_x = $x;
                for ($i = 0; $i < strlen($text); $i++)
                {
                    $bbox = imagettftext($image, $size, $angle, $temp_x, $y, $color, $font, ($text[$i]));
                    $temp_x += $spacing + ($bbox[2] - $bbox[0]);
                }
            }
        }

        function getImageFromUrl($rutaQR){
            $fi = explode(".", $rutaQR);
            switch ($fi[count($fi)-1]){
                case 'png':
                    $stamp = imagecreatefrompng($rutaQR);
                    break;
                case 'jpg':
                case 'jpeg':
                    $stamp = imagecreatefromjpeg($rutaQR);
                    break;
                case 'gif':
                    $stamp = imagecreatefromgif($rutaQR);
                    break;
            }

            return $stamp;
        }

        $font = 'fonts/carnet/Hack-Bold.ttf';
        $font2 = 'fonts/carnet/Hack-Regular.ttf';

        imagettftext($im, 10, 0, 53, 190, $black, $font, $serie);

        imagettftextSp($im, 9, 0, 170, 110, $black, $font, utf8_decode($nombres),-0.05);
        imagettftextSp($im, 9, 0, 170, 82, $black, $font, utf8_decode($apellidos),-0.05);        
         
        imagettftext($im, 8, 0, 257, 110, $black, $font, $fecha_entrega);
        imagettftext($im, 8, 0, 257, 138, $black, $font2, $fecha_nace);
        imagettftext($im, 8, 0, 257, 168, $black, $font2, $sexo);
        imagettftext($im, 8, 0, 180, 197, $black, $font2, $raza);

        $stamp = getImageFromUrl($rutaFoto);
        $sx = imagesx($stamp);
        $sy = imagesy($stamp);

        imagecolortransparent($stamp, imagecolorallocate($stamp, 255, 0, 255));
        $myRed = 255;
        $myGreen = 0;
        $myBlue = 0;
        imagealphablending($stamp, false);

        $r=$sx/2;
        for($x=0;$x<$sx;$x++)
            for($y=0;$y<$sy;$y++){
                $_x = $x - $sx/2;
                $_y = $y - $sy/2;
                if((($_x*$_x) + ($_y*$_y)) < ($r*$r)){
                    //imagesetpixel($stamp,$x,$y,$c);
                }else{
                    $alphacolor = imagecolorallocatealpha($stamp, 0, 0, 0, 127);
                    imagesetpixel($stamp, $x, $y, $alphacolor );
                }
            }

        imagecopyresampled($im, $stamp, 27, 28, 0, 0, 113, 103, imagesx($stamp), imagesy($stamp));

        $stamp = getImageFromUrl($rutaQR);
        $marge_right = 180;
        $marge_bottom = 116;
        $sx = imagesx($stamp);
        $sy = imagesy($stamp);

        imagecopyresampled($im, $stamp, $marge_right, $marge_bottom, 0, 0, 65, 65, imagesx($stamp), imagesy($stamp));

        return $im;
    }
    /* *************************************************************************** */

    public function getVistacarnetqrvalida($id, $serie, $tamano, $tipo)
    {
        ini_set("max_execution_time", 300);
        ini_set('memory_limit','512M');        

        /*end get destinatario data*/        
        $vistaprevia='Documento Vista Previa';
        
        $size = 80; // TAMAÑO EN PX 
        $png = QrCode::format('png')->margin(0)->size($size)->generate("http://proceso.munindependencia.pe/carnetcanes/vistacarnetqrvalida/".$id."/".$serie."/".$tamano."/".$tipo);
        $png = base64_encode($png);
        $png= "<img src='data:image/png;base64," . $png . "' width='65' height='65'>";
        
        $oData=CarnetCanesQR::verData($id);

        if(date("m") == '01') $mes_ac = 'Enero';
        else if(date("m") == '02') $mes_ac = 'Febrero';
        else if(date("m") == '03') $mes_ac = 'Marzo';
        else if(date("m") == '04') $mes_ac = 'Abril';
        else if(date("m") == '05') $mes_ac = 'Mayo';
        else if(date("m") == '06') $mes_ac = 'Junio';
        else if(date("m") == '07') $mes_ac = 'Julio';
        else if(date("m") == '08') $mes_ac = 'Agosto';
        else if(date("m") == '09') $mes_ac = 'Septiembre';
        else if(date("m") == '10') $mes_ac = 'Octubre';
        else if(date("m") == '11') $mes_ac = 'Noviembre';
        else if(date("m") == '12') $mes_ac = 'Diciembre';        

        $params = [
            'reporte'=>2,
            'nombres'=>$oData[0]->nombre,
            'apellidos'=>$oData[0]->paterno.' '.$oData[0]->materno,
            'serie'=>$oData[0]->serie,
            'fecha_entrega'=>$oData[0]->fecha_entrega,
            'fecha_nace'=>$oData[0]->fecha_nace,
            'sexo'=>$oData[0]->sexo,
            'raza'=>$oData[0]->raza,
            'estado'=>$oData[0]->estado,            
            'foto'=>$oData[0]->foto,
            'fecha_actual_texto' => date("d") . " del " . $mes_ac . " de " . date("Y"),
            'tamano'=>$tamano,
            'vistaprevia'=>$vistaprevia,
            'imagen'=>$png
        ];

        $view = \View::make('admin.mantenimiento.templates.plantilla_carnetcan', $params);
        $html = $view->render();

        $pdf = App::make('dompdf');
        $html = preg_replace('/>\s+</', '><', $html);
        $pdf->loadHTML($html);

        $pdf->setPaper('a'.$tamano)->setOrientation('portrait');

        return $pdf->stream();
        //\PDFF::loadHTML($html)->setPaper('a4')->setOrientation('landscape')->setWarnings(false)->stream();
    }


}
