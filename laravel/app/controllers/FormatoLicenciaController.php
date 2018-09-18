<?php
use PhpOffice\PhpWord\SimpleType\DocProtect;
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

            $Ssql="SELECT MAX(correlativo) as correlativo FROM licencia_construccion;";
            $lic_cons=DB::select($Ssql);
            $correlativo = ($lic_cons[0]->correlativo + 1);

            $formatolic = new FormatoLicenciaContruccion;
            if($correlativo)
                $formatolic->correlativo = $correlativo;

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

            /* GENERACIÓN DEL WORD PLANILLA */
            $data = array('expediente' => $formatolic->expediente,
                            'fecha_emi' => $formatolic->fecha_emision,
                            'fecha_vence' => $formatolic->fecha_vence,
                            'correlativo' => $formatolic->correlativo,
                            'licencia_edifica' => $formatolic->licencia_edifica,
                            'mod' => $formatolic->modalidad,
                            'uso' => $formatolic->uso,
                            'zonifica' => $formatolic->zonifica,
                            'altura' => $formatolic->altura,

                            'propietario' => $formatolic->propietario,
                            'departamento' => $formatolic->departamento,
                            'provincia' => $formatolic->provincia,
                            'distrito' => $formatolic->distrito,
                            'dir_urbaniza' => $formatolic->dir_urbaniza,
                            'dir_mz' => $formatolic->dir_mz,
                            'dir_lote' => $formatolic->dir_lote,
                            'dir_calle' => $formatolic->dir_calle,
                            'area_terre' => $formatolic->area_terreno,
                            'valor_obra' => $formatolic->valor_obra,
                            'piso_1' => $formatolic->piso_1,
                            'area_1' => $formatolic->area_1,
                            'piso_2' => $formatolic->piso_2,
                            'area_2' => $formatolic->area_2,
                            'piso_3' => $formatolic->piso_3,
                            'area_3' => $formatolic->area_3,
                            'piso_4' => $formatolic->piso_4,
                            'area_4' => $formatolic->area_4,
                            'piso_5' => $formatolic->piso_5,
                            'area_5' => $formatolic->area_5,
                            'derecho_licencia' => $formatolic->derecho_licencia,
                            'recibo' => $formatolic->recibo,
                            'fecha_recibo' => $formatolic->fecha_recibo,
                            'fecha_actual_texto' => date("d") . " del " . date("m") . " de " . date("Y")
                    );

            $this->getEje2($data);
            // --

            return Response::json(array('rst'=>1, 'msj'=>'Registro realizado correctamente.', 'id'=>$formatolic->id));
        }
    }


    public function getEje2($data)
    {
        $templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor('templates/resources/formato_licencia_contruc.docx');

            // Variables on different parts of document
            //$templateProcessor->setValue('weekday', date('l'));            // On section/content
            //$templateProcessor->setValue('time', date('H:i'));             // On footer
            //$templateProcessor->setValue('serverName', realpath(__DIR__)); // On header

            //$png = "<img class='img-thumbnail' src='data:image/png;base64' width='140' height='140'>";
            //$templateProcessor->setValue('cod_qr', $png);
            
            $templateProcessor->setValue('expediente', $data['expediente']);
            $templateProcessor->setValue('fecha_emi', $data['fecha_emi']);
            $templateProcessor->setValue('fecha_vence', $data['fecha_vence']);
            $templateProcessor->setValue('correlativo', $data['correlativo']);
            $templateProcessor->setValue('licencia_edifica', $data['licencia_edifica']);
            $templateProcessor->setValue('mod', $data['mod']);
            $templateProcessor->setValue('uso', $data['uso']);
            $templateProcessor->setValue('zonifica', $data['zonifica']);
            $templateProcessor->setValue('altura', $data['altura']);
            //Persona
            $templateProcessor->setValue('propietario', $data['propietario']);
            $templateProcessor->setValue('dir_urbaniza', $data['dir_urbaniza']);
            $templateProcessor->setValue('dir_mz', $data['dir_mz']);
            $templateProcessor->setValue('dir_lote', $data['dir_lote']);
            $templateProcessor->setValue('dir_calle', $data['dir_calle']);
            $templateProcessor->setValue('area_terre', number_format($data['area_terre'], 2));
            $templateProcessor->setValue('valor_obra', number_format($data['valor_obra'], 2));
            // Simple table
            /*
            $templateProcessor->cloneRow('rowValue', 10);

            $templateProcessor->setValue('rowValue#1', 'Sun');
            $templateProcessor->setValue('rowValue#2', 'Mercury');
            $templateProcessor->setValue('rowValue#3', 'Venus');
            $templateProcessor->setValue('rowValue#4', 'Earth');
            $templateProcessor->setValue('rowValue#5', 'Mars');
            $templateProcessor->setValue('rowValue#6', 'Jupiter');
            $templateProcessor->setValue('rowValue#7', 'Saturn');
            $templateProcessor->setValue('rowValue#8', 'Uranus');
            $templateProcessor->setValue('rowValue#9', 'Neptun');
            $templateProcessor->setValue('rowValue#10', 'Pluto');

            $templateProcessor->setValue('rowNumber#1', '1');
            $templateProcessor->setValue('rowNumber#2', '2');
            $templateProcessor->setValue('rowNumber#3', '3');
            $templateProcessor->setValue('rowNumber#4', '4');
            $templateProcessor->setValue('rowNumber#5', '5');
            $templateProcessor->setValue('rowNumber#6', '6');
            $templateProcessor->setValue('rowNumber#7', '7');
            $templateProcessor->setValue('rowNumber#8', '8');
            $templateProcessor->setValue('rowNumber#9', '9');
            $templateProcessor->setValue('rowNumber#10', '10');

            // Table with a spanned cell
            $templateProcessor->cloneRow('userId', 3);

            $templateProcessor->setValue('userId#1', '1');
            $templateProcessor->setValue('userFirstName#1', 'James');
            $templateProcessor->setValue('userName#1', 'Taylor');
            $templateProcessor->setValue('userPhone#1', '+1 428 889 773');

            $templateProcessor->setValue('userId#2', '2');
            $templateProcessor->setValue('userFirstName#2', 'Robert');
            $templateProcessor->setValue('userName#2', 'Bell');
            $templateProcessor->setValue('userPhone#2', '+1 428 889 774');

            $templateProcessor->setValue('userId#3', '3');
            $templateProcessor->setValue('userFirstName#3', 'Michael');
            $templateProcessor->setValue('userName#3', 'Ray');
            $templateProcessor->setValue('userPhone#3', '+1 428 889 775');
            */

            $templateProcessor->setValue('derecho_licencia', number_format($data['derecho_licencia'],2));
            $templateProcessor->setValue('recibo', $data['recibo']);
            $templateProcessor->setValue('fecha_recibo', $data['fecha_recibo']);
            $templateProcessor->setValue('fecha_actual_texto', $data['fecha_actual_texto']);

            $source='results/licencia_construc.docx';
            $templateProcessor->saveAs($source);

            $phpWord = \PhpOffice\PhpWord\IOFactory::load($source);
            $documentProtection = $phpWord->getSettings()->getDocumentProtection();
            $documentProtection->setEditing(DocProtect::READ_ONLY);
            $documentProtection->setPassword('hola');

            $section = $phpWord->addSection();
            $section->addText('this document is password protected');
            //$phpWord->save($source);
            //return Redirect::to($source);
            $phpWord->save('results/licencia_construc.pdf','PDF');
            return Redirect::to('/results/licencia_construc.pdf');
    }

    public function obtenerCodQRLicConstr($id_lic_constr) {
      $size = 100; // TAMAÑO EN PX
      $png = QrCode::format('png')->margin(0)->size($size)->generate("http://proceso.munindependencia.pe/formatolicencia/vistaqrliccontruccion/".$id_lic_constr);
      $png = base64_encode($png);
      $png = "<img class='img-thumbnail' src='data:image/png;base64," . $png . "' width='140' height='140'>";
      
      return $png;
    }


    public function getVistaqrliccontruccion($id_lic_constr)
    {

    }

}
