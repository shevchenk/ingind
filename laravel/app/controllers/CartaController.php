<?php

class CartaController extends \BaseController
{
    public function __construct()
    {
        $this->beforeFilter('auth');
    }

    public function postCorrelativo()
    {
        if ( Request::ajax() ) {
            $r = Carta::Correlativo();
            return Response::json(array('rst'=>1,'datos'=>$r));
        }
    }

    public function postCargardetalle()
    {
        if ( Request::ajax() ) {
            $r = Carta::CargarDetalle();
            return Response::json(array('rst'=>1,'datos'=>$r));
        }
    }

    public function postGuardar()
    {
        if ( Request::ajax() ) {
            $r=Carta::CrearActualizar();
            return Response::json(
                $r
            );
        }
    }

    public function postCargar()
    {
        if ( Request::ajax() ) {
            $r = Carta::Cargar();
            return Response::json(array('rst'=>1,'datos'=>$r));
        }
    }


    public function getCartainiciopdf()
    {
        $r = Carta::CargarDetalle();
        $response = $r[0];

        $recursos = explode('*', $response->recursos );
		$count = 0;
		$tr_recursos= "";
        foreach($recursos as $recurso) {
			$count++;
            $row = explode("|", $recurso);
            $tr_recursos .= "<tr><td>$count</td><td>$row[0]</td><td>$row[1]</td><td>$row[2]</td></tr>";
        }

		// metricos
		$data = explode('*', $response->metricos );
		$count = 0;
		$tr_metricos= "";
		foreach($data as $r) {
			$count++;
			$row = explode("|", $r);
			$tr_metricos .= "<tr><td>$count</td><td>$row[0]</td><td>$row[1]</td><td>$row[2]</td><td>$row[3]</td></tr>";
		}


		// desglose
		$data = explode('*', $response->desgloses );
		$count = 0;
		$tr_desgloses= "";
		foreach($data as $r) {
			$count++;
			$row = explode("|", $r);
			$tr_desgloses .= "<tr><td>$count</td><td>$row[0]</td><td>$row[1]</td><td>$row[2]</td><td>$row[3]</td><td>$row[4]</td><td>$row[5]</td><td>$row[6]</td><td>$row[7]</td></tr>";
		}


		$html = "<html><meta charset=\"UTF-8\">
<body>
<style>
table, tr , td, th {
text-align: left !important;
border-collapse: collapse;
border: 1px solid #ccc;
width: 100%;
font-size: .9em;
font-family: arial, sans-serif;
}
Th, td {
padding: 5px;
}
</style>
<h3>CARTA DE INICIO</h3>
<table>
	<tr>
		<th>CARTA: </th>
		<td>".$response->id."</td>
	</tr>
	<tr>
		<th>OBJETIVOS DEL PROYECTO: </th>
		<td>".$response->objetivo."</td>
	</tr>
	<tr>
		<th>ENTREGABLES DEL PROYECTO: </th>
		<td>".$response->entregable."</td>
	</tr>
	<tr>
		<th>ALCANCE DEL PROYECTO: </th>
		<td>".$response->alcance."</td>
	</tr>
</table>
<hr>

<table>
	<tr><th colspan=\"4\">RECURSOS (NO HUMANOS):</th></tr>
	<tr>
		<th>Nro</th>
		<th>Tipo recurso</th>
		<th>Descripción</th>
		<th>Cantidad</th>
	</tr>
	$tr_recursos
</table>

<hr>
<table>
	<tr><th colspan=\"5\">METRICOS:</th></tr>
	<tr>
		<th>Nro</th>
		<th>Metrico</th>
		<th>Actual</th>
		<th>Objetivo</th>
		<th>Comentario</th>
	</tr>
	$tr_metricos
</table>

<hr>
<table>
	<tr><th colspan=\"9\">Desglose de Carta de Inicio N°:</th></tr>
	<tr>
		<th>Nro</th>
		<th>Tipo de actividad</th>
		<th>Actividad</th>
		<th>Responsable - Area</th>
		<th>Recursos</th>
		<th>Fecha Inicio</th>
		<th>Fecha Fin</th>
		<th>Hora Inicio</th>
		<th>Hora Fin</th>
	</tr>
	 $tr_desgloses
</table>

</body>
</html>";


        return PDF::load($html, 'A4', 'portrait')->download('carta-inicio-'.Input::get('carta_id').'');
    }

}
