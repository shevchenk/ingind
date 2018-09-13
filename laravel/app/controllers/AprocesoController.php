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


    public function getCrear()
    {
    
        if(Input::has('codigo')){

            $r           = new Ruta;
            $res         = Array();
            $res         = $r->crearRuta02();

            return Response::json(
                array(
                    'rst'   => $res['rst'],
                    'msj'   => $res['msj']
                )
            );
        }else{

            return Response::json(
                array(
                    'rst'   => 0,
                    'msj'   => "Sin datos."
                )
            );
        }

    }

    public function postCrear()
    {
    
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
