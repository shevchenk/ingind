<?php

class Persona extends Base
{
    public $table = "personas";
    public static $where =[
                        'id', 'paterno','materno','nombre','email','dni',
                        'password','fecha_nacimiento','imagen', 'estado'
                        ];
    public static $selec =[
                        'id', 'paterno','materno','nombre','email','dni',
                        'password','fecha_nacimiento','imagen', 'estado'
                        ];
    /**
     * Cargos relationship
     */
    public function cargos()
    {
        return $this->belongsToMany('Cargo');
    }
    public function getAreas($personaId)
    {
        //subconsulta
        $sql = DB::table('cargo_persona as cp')
        ->join(
            'cargos as c', 
            'cp.cargo_id', '=', 'c.id'
        )
        ->join(
            'area_cargo_persona as acp', 
            'cp.id', '=', 'acp.cargo_persona_id'
        )
        ->join(
            'areas as a', 
            'acp.area_id', '=', 'a.id'
        )
        ->select(
            DB::raw(
                "
                CONCAT(c.id, '-',
                    GROUP_CONCAT(a.id)
                ) AS info"
            )
        )
        ->whereRaw("cp.persona_id=$personaId AND cp.estado=1 AND c.estado=1")

        ->groupBy('c.id');
        //consulta
        $areas = DB::table(DB::raw("(".$sql->toSql().") as a"))
                ->select(
                    DB::raw("GROUP_CONCAT( info SEPARATOR '|'  ) as DATA ")
                )
               ->get();

        return $areas;
    }
    /*public static function getCargoArea()
    {
        $query = DB::table('tipos_respuesta_detalle as trd')
                ->join(
                    'tipos_respuesta as tr',
                    'trd.tipo_respuesta_id', '=', 'tr.id'
                )
                ->select(
                    'trd.id',
                    'trd.nombre',
                    'trd.estado',
                    'tr.nombre as tiporespuesta',
                    'tr.id as tiporespuesta_id'
                )
                ->where('tr.estado', '=', 1)
                ->get();
        $personas =  DB::table('personas as p')
                        ->join(
                            'empresas as e',
                            'u.empresa_id', '=', 'e.id'
                        )
                        ->join(
                            'perfiles as p',
                            'u.perfil_id', '=', 'p.id'
                        )
                        ->select(
                            'p.id',
                            'p.paterno',
                            'p.materno',
                            'p.nombre',
                            'p.email',
                            'p.dni',
                            'p.password',
                            'p.fecha_nacimiento',
                            'p.estado',
                            'p.imagen',
                            'a.nombre as empresa',
                            'c.nombre as perfil'
                        )
                        ->get();
        return $query;
    }*/

}


