<?php

class DocumentoRecuperado extends Base{
    public $table = "doc_recuperado";

    public static function getRecuperadosArea($area_id){
        $ppath=url('/').'/';
        $sql = "SELECT id, tipo_doc, concat('$ppath',archivo) as archivo,fecha_doc,numero FROM doc_recuperado WHERE estado=1 AND area=".$area_id;
        $r= DB::select($sql);
        return $r;

    }

    public static function getRecuperados(){
        $ppath=url('/').'/';
        $sql = "SELECT id, tipo_doc, concat('$ppath',archivo) as archivo,fecha_doc,numero FROM doc_recuperado WHERE estado=1";
        $r= DB::select($sql);
        return $r;
        
    }



/*
    public function opciones(){
        return $this->belongsToMany('Opcion');
    }
*/
}
