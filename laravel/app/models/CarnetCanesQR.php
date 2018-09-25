<?php
class CarnetCanesQR extends Base
{
    public $table = "carnet_canes";
    public static $where =['id', 'serie', 'paterno', 'materno', 'nombre', 'fecha_entrega', 'fecha_nace', 'sexo', 'raza', 'estado'];
    public static $selec =['id', 'serie', 'paterno', 'materno', 'nombre', 'fecha_entrega', 'fecha_nace', 'sexo', 'raza', 'estado'];

    public static function verData($id)
    {
        $sql = "SELECT * 
				FROM carnet_canes
					WHERE id = $id;";        
        $r = DB::select($sql);
        return $r;
    }
}

/*
class Cargo extends Base
{
    public $table = "cargos";
    public static $where =['id', 'nombre', 'estado'];
    public static $selec =['id', 'nombre', 'estado'];
        
}
*/