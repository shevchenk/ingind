<?php

class AnexoController extends BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */

	public function postAnexosbytramite(){
		$rst=Anexo::getAnexosbyTramite();
          return Response::json(
              array(
                  'rst'=>1,
                  'datos'=>$rst
              )
          );
	}

	public function postAnexobyid(){
		$rst=Anexo::getDetalleAnexobyId();
          return Response::json(
              array(
                  'rst'=>1,
                  'datos'=>$rst
              )
          );
	}

	public function index()
	{
		
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function postCreate()
	{
		$img = $_FILES['txt_file'];
		$data = $_POST;

		if($img && $data){
			$name = md5($img['name']).'_'.$data['txt_codtramite'].'.jpeg';
			$root = public_path().'/img/anexo/'.$name;

			if(move_uploaded_file($img['tmp_name'], $root)){
				$anexo = new Anexo;
		       	$anexo['tramite_id'] = $data['txt_codtramite'];
		        $anexo['persona_id'] = Auth::user()->id;
		        $anexo['fecha_anexo'] = date('Y-m-d H:i:s');
		        $anexo['usuario_atendio'] = Auth::user()->id;
		        $anexo['nombre'] = $data['txt_nombtramite'];
		        $anexo['nro_folios'] = $data['txt_folio'];
		        $anexo['obeservacion'] =$data['txt_observ'];
		        $anexo['imagen'] = $name;
		        $anexo['usuario_created_at'] = Auth::user()->id;
		        $anexo->save();

		        return Response::json(
		            array(
		            'rst'=>1,
		            'msj'=>'Registro realizado correctamente',
		            )
		        );
		    }
		}

	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}


}
