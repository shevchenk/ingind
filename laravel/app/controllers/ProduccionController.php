<?php

class ProduccionController extends \BaseController
{
    public function index()
    {

    }

    public function show($id)
    {
        $fecha_ini=Input::get('fecha_inicio');
        $fecha_fin=Input::get('fecha_final');
        $produccion=array();
        $produccion['msj']='Revise fecha de inicio o fecha final';
        if( Input::has('fecha_inicio') && Input::has('fecha_final') ){
        $sql="  SELECT p.dni,COUNT(r.id) cant
                FROM rutas r
                INNER JOIN personas p ON p.id=r.usuario_created_at
                WHERE date(r.fecha_inicio) BETWEEN '".$fecha_ini."' AND '".$fecha_fin."'
                GROUP BY p.id";

        $sql2=" SELECT p.dni, count(rdv.id) cant
                FROM rutas_detalle_verbo rdv
                INNER JOIN personas p ON p.id=rdv.usuario_updated_at
                WHERE date(rdv.updated_at) BETWEEN '".$fecha_ini."' AND '".$fecha_fin."'
                GROUP BY p.id";

        $r=DB::select($sql);
        $r2=DB::select($sql2);
        $produccion['tramites']=$r;
        $produccion['tareas']=$r2;
        $produccion['msj']='Listado correctamente';
        }

        return Response::json($produccion); 
    }

}
