<?php

class DetalleContratacion extends Base
{
    public $table = "contra_reque";
    public static $where =['id', 'contratacion_id','fecha_inicio','fecha_fin','fecha_aviso','monto','fecha_conformidad','tipo','texto','programacion_aviso','nro_doc','estado'];
    public static $selec =['id', 'contratacion_id','fecha_inicio','fecha_fin','fecha_aviso','monto','fecha_conformidad','tipo','texto','programacion_aviso','nro_doc','estado'];
    
    public static function getCargarCount( $array )
    {
        $sSql=" SELECT  COUNT(cr.id) cant
                FROM contra_reque cr
                WHERE 1=1 ";
        $sSql.= $array['where'];
        $oData = DB::select($sSql);
        return $oData[0]->cant;
    }

    public static function getCargar($array )
    {
        $sSql=" SELECT cr.id, cr.contratacion_id,cr.fecha_inicio,cr.fecha_fin,cr.fecha_aviso,cr.monto, case cr.fecha_conformidad  when '0000-00-00' then ''  else cr.fecha_conformidad end as fecha_conformidad,cr.tipo,cr.texto,cr.programacion_aviso,cr.nro_doc,cr.estado
                FROM contra_reque cr
                WHERE cr.estado=1 ";
        $sSql.= $array['where'];
        $oData = DB::select($sSql);
        return $oData;
    }


//    public function getContratacion(){
//        $verbo=DB::table('contratacion')
//                ->select('id', 'titulo','monto_total','objeto','justificacion','actividades','fecha_conformidad','fecha_inicio','fecha_fin','fecha_aviso','programacion_aviso','nro_doc','area_id', 'estado')
//                ->where( 
//                    function($query){
//                        if ( Input::get('estado') ) {
//                            $query->where('estado','=','1');
//                        }
//                    }
//                )
//                ->orderBy('titulo')
//                ->get();
//                
//        return $verbo;
//    }
}