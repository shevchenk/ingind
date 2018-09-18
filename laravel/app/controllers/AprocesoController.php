<?php
class AprocesoController extends \BaseController
{

    public function getGuardar()
    {

            $allInputs = $_POST;
            var_dump($allInputs);
            die();

/*
            $r = RutaFlujo::getGuardar();
            return Response::json(
                array(
                    'rst'   => 1,
                    'msj'   => $r['mensaje'],
                    'ruta_flujo_id'=>$r['ruta_flujo_id']
                )
            );
        }
*/
    }


    public function getCrear(){
        
        $fichero = public_path()."/file/log.dat";
        $actual = file_get_contents($fichero);
        
        $cod = (Input::has('codigo')?Input::get('codigo'):'NOCODE');
        $actual .= '[G E T] : '.date("m-d h:ia  ",time())."COD: $cod  \r\n";
        file_put_contents($fichero, $actual);



        if(Input::has('codigo')){

            $r           = new Ruta;
            $res         = Array();
            $res         = $r->crearRuta02();

            return Response::json( array('rst'   => $res['rst'],'msj'   => $res['msj']));
        }else{
            return Response::json(array('rst'  => 0,'msj'   => "Sin datos."));
        }


    }

    public function postCrear(){
        $fichero = public_path()."/file/log.dat";
        $actual = file_get_contents($fichero);
        
        $cod = (Input::has('codigo')?Input::get('codigo'):'NOCODE');
        $actual .= '[P O S T] : '.date("m-d h:ia  ",time())."COD: $cod  \r\n";
        file_put_contents($fichero, $actual);


        if(Input::has('codigo')){

            $r           = new Ruta;
            $res         = Array();
            $res         = $r->crearRuta02();

            return Response::json( array('rst'   => $res['rst'],'msj'   => $res['msj']));
        }else{
            return Response::json(array('rst'  => 0,'msj'   => "Sin datos."));
        }

    }



}
