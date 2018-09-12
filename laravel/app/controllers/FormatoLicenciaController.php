<?php

class FormatoLicenciaController extends \BaseController
{
    protected $_errorController;
    /**
     * Valida sesion activa
     */
    public function __construct(ErrorController $ErrorController)
    {
        $this->beforeFilter('auth');
        $this->_errorController = $ErrorController;
    }
    /**
     * cargar roles, mantenimiento
     * POST /ActividadCategoria/cargar
     *
     * @return Response
     */    
    public function postCrearliccontruc()
    {
        if ( Request::ajax() ) {
            $regex = 'regex:/^([a-zA-Z .,ñÑÁÉÍÓÚáéíóú]{2,60})$/i';
            $required = 'required';
            $reglas = array(
                //'expediente' => $required.'|'.$regex,
            );

            $mensaje= array(
                'required' => ':attribute Es requerido',
                'regex'    => ':attribute Solo debe ser Texto',
            );

            $validator = Validator::make(Input::all(), $reglas, $mensaje);

            if ( $validator->fails() ) {
                return Response::json( array('rst'=>2, 'msj'=>$validator->messages()) );
            }

            $formatolic = new FormatoLicenciaContruccion;
            if(Input::get('expediente'))
                $formatolic->expediente = Input::get('expediente');

            if(Input::get('fecha_emision'))
                $formatolic->fecha_emision = Input::get('fecha_emision');

            if(Input::get('fecha_vence'))
                $formatolic->fecha_vence = Input::get('fecha_vence');

            if(Input::get('licencia_edifica'))
                $formatolic->licencia_edifica = Input::get('licencia_edifica');

            if(Input::get('modalidad'))
                $formatolic->modalidad = Input::get('modalidad');

            if(Input::get('uso'))
                $formatolic->uso = Input::get('uso');

            if(Input::get('zonifica'))
                $formatolic->zonifica = Input::get('zonifica');

            if(Input::get('altura'))
                $formatolic->altura = Input::get('altura');

            if(Input::get('propietario'))
                $formatolic->propietario = Input::get('propietario');

            if(Input::get('departamento'))
                $formatolic->departamento = Input::get('departamento');

            if(Input::get('provincia'))
                $formatolic->provincia = Input::get('provincia');

            if(Input::get('distrito'))
                $formatolic->distrito = Input::get('distrito');

            if(Input::get('dir_urbaniza'))
                $formatolic->dir_urbaniza = Input::get('dir_urbaniza');

            if(Input::get('dir_mz'))
                $formatolic->dir_mz = Input::get('dir_mz');

            if(Input::get('dir_lote'))
                $formatolic->dir_lote = Input::get('dir_lote');

            if(Input::get('dir_calle'))
                $formatolic->dir_calle = Input::get('dir_calle');

            if(Input::get('area_terreno'))
                $formatolic->area_terreno = Input::get('area_terreno');

            if(Input::get('valor_obra'))
                $formatolic->valor_obra = Input::get('valor_obra');

            if(Input::get('piso_1'))
                $formatolic->piso_1 = Input::get('piso_1');

            if(Input::get('area_1'))
                $formatolic->area_1 = Input::get('area_1');

            if(Input::get('piso_2'))
                $formatolic->piso_2 = Input::get('piso_2');
            
            if(Input::get('area_2'))
                $formatolic->area_2 = Input::get('area_2');
            
            if(Input::get('piso_3'))
                $formatolic->piso_3 = Input::get('piso_3');
            
            if(Input::get('area_3'))
                $formatolic->area_3 = Input::get('area_3');
            
            if(Input::get('piso_4'))
                $formatolic->piso_4 = Input::get('piso_4');
            
            if(Input::get('area_4'))
                $formatolic->area_4 = Input::get('area_4');
            
            if(Input::get('piso_5'))
                $formatolic->piso_5 = Input::get('piso_5');
            
            if(Input::get('area_5'))
                $formatolic->area_5 = Input::get('area_5');

            if(Input::get('derecho_licencia'))
                $formatolic->derecho_licencia = Input::get('derecho_licencia');
            
            if(Input::get('recibo'))
                $formatolic->recibo = Input::get('recibo');
            
            if(Input::get('fecha_recibo'))
                $formatolic->fecha_recibo = Input::get('fecha_recibo');

            $formatolic->estado = 1;
            $formatolic->created_at = date('Y-m-d h:m:s');
            $formatolic->persona_id_created_at = Auth::user()->id;
            $formatolic->save();

            return Response::json(array('rst'=>1, 'msj'=>'Registro realizado correctamente.'));
        }
    }    

}
