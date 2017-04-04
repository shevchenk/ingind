<?php

class MetaCuadro extends Base
{
    public $table = "metas_cuadro";
    public static $where =['id' , 'meta_id' , 'anio', 'actividad', 'estado'];
    public static $selec =['id' , 'meta_id' , 'anio', 'actividad', 'estado'];
    
    public static function getCargarCount( $array )
    {
        $sSql=" SELECT  COUNT(mc.id) cant
                FROM metas_cuadro mc
                INNER JOIN metas m on mc.meta_id=m.id
                WHERE 1=1 ";
        $sSql.= $array['where'];
        $oData = DB::select($sSql);
        return $oData[0]->cant;
    }

    public static function getCargar( $array )
    {
        $sSql=" SELECT mc.id,mc.meta_id, mc.actividad, mc.anio, mc.estado,m.nombre as meta
                FROM metas_cuadro mc
                INNER JOIN metas m on mc.meta_id=m.id
                WHERE 1=1 ";
        $sSql.= $array['where'].
                $array['order'].
                $array['limit'];
        $oData = DB::select($sSql);
        return $oData;
    }


    public function getMeta(){
        $metacuadro=DB::table('metas')
                ->select('id','nombre','estado')
                ->where( 
                    function($query){
                        if ( Input::get('estado') ) {
                            $query->where('estado','=','1');
                        }
                    }
                )
                ->orderBy('id')
                ->get();
                
        return $metacuadro;
    }
        
        public function getMetaCuadro($array )
    {
        $sSql=" SELECT m.nombre,m.id as meta_id,mc.actividad,mc.id as meta_cuadro_id,mf1.comentario as d,
			 mf1.id as id_d,mf1.fecha as df,mf2.comentario as p,mf2.id as id_p,mf2.fecha as pf,
			(SELECT CONCAT_WS('|',GROUP_CONCAT(ma.ruta),GROUP_CONCAT(ma.id))
			 FROM metas_archivo ma
			 WHERE  ma.tipo_avance=4 AND ma.avance_id=mf2.id AND ma.estado=1
			 GROUP BY ma.avance_id) as a_p,
			(SELECT CONCAT_WS('|',GROUP_CONCAT(dd.titulo),GROUP_CONCAT(md.id),GROUP_CONCAT(md.doc_digital_id))
			 FROM metas_docdigital md
			 INNER JOIN doc_digital dd ON md.doc_digital_id=dd.id
			 WHERE  md.tipo_avance=4 AND md.avance_id=mf2.id AND md.estado=1
			 GROUP BY md.avance_id) as d_p,
			(SELECT CONCAT_WS('|',GROUP_CONCAT(ma.ruta),GROUP_CONCAT(ma.id))
			 FROM metas_archivo ma
			 WHERE  ma.tipo_avance=3 AND ma.avance_id=mf1.id AND ma.estado=1
			 GROUP BY ma.avance_id) as a_d,
                         (SELECT CONCAT_WS('|',GROUP_CONCAT(dd.titulo),GROUP_CONCAT(md.id),GROUP_CONCAT(md.doc_digital_id))
			 FROM metas_docdigital md
			 INNER JOIN doc_digital dd ON md.doc_digital_id=dd.id
			 WHERE  md.tipo_avance=3 AND md.avance_id=mf2.id AND md.estado=1
			 GROUP BY md.avance_id) as d_d,
			(SELECT CONCAT_WS('|',GROUP_CONCAT(ma.ruta),GROUP_CONCAT(ma.id))
			 FROM metas_archivo ma
			 WHERE  ma.tipo_avance=2 AND ma.avance_id=mc.id AND ma.estado=1
			 GROUP BY ma.avance_id) as a_a,
			(SELECT CONCAT_WS('|',GROUP_CONCAT(dd.titulo),GROUP_CONCAT(md.id),GROUP_CONCAT(md.doc_digital_id))
			 FROM metas_docdigital md
			 INNER JOIN doc_digital dd ON md.doc_digital_id=dd.id
			 WHERE  md.tipo_avance=2 AND md.avance_id=mf2.id AND md.estado=1
			 GROUP BY md.avance_id) as d_a,
			(SELECT CONCAT_WS('|',GROUP_CONCAT(ma.ruta),GROUP_CONCAT(ma.id))
			 FROM metas_archivo ma
			 WHERE  ma.tipo_avance=1 AND ma.avance_id=m.id AND ma.estado=1
                        GROUP BY ma.avance_id) as a_m,
                         (SELECT CONCAT_WS('|',GROUP_CONCAT(dd.titulo),GROUP_CONCAT(md.id),GROUP_CONCAT(md.doc_digital_id))
			 FROM metas_docdigital md
			 INNER JOIN doc_digital dd ON md.doc_digital_id=dd.id
			 WHERE  md.tipo_avance=1 AND md.avance_id=mf2.id AND md.estado=1
			 GROUP BY md.avance_id) as d_m
                FROM metas_cuadro mc
                INNER JOIN metas m on mc.meta_id=m.id
                LEFT JOIN metas_fechavencimiento mf1 on mc.id=mf1.meta_cuadro_id and mf1.tipo=1
                LEFT JOIN metas_fechavencimiento mf2 on mc.id=mf2.meta_cuadro_id and mf2.relacion_id=mf1.id
                WHERE 1=1 ";
        $sSql.= $array['where'];
        $oData = DB::select($sSql);
        return $oData;
    }
}
