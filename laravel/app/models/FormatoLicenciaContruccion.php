<?php

class FormatoLicenciaContruccion extends Base
{
    public $table = "licencia_construccion";

    public static function verDataFormatoLicencia($id)
    {
        $sql = "SELECT * 
				FROM licencia_construccion
					WHERE id = $id;";        
        $r = DB::select($sql);
        return $r;
    }
}
