<?php
class TablaRelacion extends Eloquent
{
    public $table="tablas_relacion";

    public function getRelacion()
    {
        $tr=         DB::table('tablas_relacion AS tr')
                    ->join(
                        'softwares AS s',
                        's.id', '=', 'tr.software_id'
                    )
                    ->select(
                        's.nombre AS software','tr.id_union AS codigo',
                        'tr.estado AS cestado','tr.id',
                        DB::raw(
                            'IF(tr.estado,"Activo","Desactivo") AS estado'
                        )
                    )
                    ->where(
                        function($query){
                            if( Input::get('estado') ){
                                $query->where('tr.estado', '=', Input::get('estado'));
                            }
                        }
                    )
                    ->get();
        return $tr;
    }

    public function guardarRelacion()
    {
        $tr = new TablaRelacion;
        $tr['software_id']= Input::get('software_id');
        $tr['id_union']= Input::get('codigo');
        $tr['usuario_created_at'] = Auth::user()->id;
        $tr->save();

        return $tr;
    }
}