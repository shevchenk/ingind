<?php

class recoveryController extends \BaseController
{


    public function postGuardar(){


            if (Input::hasFile('documento')) {
                $path = 'img/documentos/recovery/';
                $file            = Input::file('documento');
                $extension = Input::file('documento')->getClientOriginalExtension();
                $destinationPath = public_path().'/'.$path;
                $filename        = str_random(3) . '_' . time();
                $uploadSuccess   = $file->move($destinationPath, $filename.'.'.$extension);
                
                if($uploadSuccess){

                    $nDoc = new DocumentoRecuperado;
                    $nDoc->numero = Input::get('numero');
                    $nDoc->tipo_doc = Input::get('tipo_documento');
                    $nDoc->fecha_doc = Input::get('fecha');
                    $nDoc->area = Auth::user()->area_id;
                    $nDoc->archivo = $path.$filename.'.'.$extension;
                    $nDoc->created_at = date('Y-m-d H:m:s');
                    $nDoc->usuario_created_at = Auth::user()->id;
                    $nDoc->estado = 1;
                    $nDoc->save();

                    // SUBIDO Y GUARDADO 

                }else{
                    // NO SUBIDO 
                }
            }else{
                // NO FILE
            }
            return Redirect::to('admin.mantenimiento.recovery');
    }
    /**
     * Store a newly created resource in storage.
     * POST /cargo/listar
     *
     * @return Response
     */
    public function postLoad(){

        //$numero = (Input::has('numero') ? Input::get('numero'):'');
        $result = DocumentoRecuperado::getRecuperadosArea(Auth::user()->area_id);

        return Response::json($result); 

    }


}
