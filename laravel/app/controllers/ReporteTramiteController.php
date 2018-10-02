<?php
class ReporteTramiteController extends BaseController
{
    public function postTramiteunico()
    {
      $array=array();
      $fecha='';
      $array['where']='';
      
      if( Input::has('tramite') AND Input::get('tramite')!='' ){
        $tramite=explode(" ",trim(Input::get('tramite')));
        for($i=0; $i<count($tramite); $i++){
          $array['where'].=" AND re.referido LIKE '%".$tramite[$i]."%' ";
        }
      }
      


      $r = ReporteTramite::TramiteUnico( $array );


      return Response::json(
          array(
              'rst'=>1,
              'datos'=>$r
          )
      );
    }

    public function postTramitedetalle()
    {
      $array=array();
      $array['where']='';

      if( Input::has('ruta_id') AND Input::get('ruta_id')!='' ){
        $array['where']=" AND r.id=".Input::get('ruta_id')." ";
      }

      $r = ReporteTramite::TramiteDetalle( $array );
      return Response::json(
          array(
              'rst'=>1,
              'datos'=>$r
          )
      );
    }

    public function postExpedienteunico()
    {
      $rst=ReporteTramite::ExpedienteUnico(); 


       $new = array();
      
        $ftp_server = "10.0.100.11";
        $conn_id = ftp_connect($ftp_server);
        $login_result = ftp_login($conn_id, 'anonymous', '');
        $contents = ftp_nlist($conn_id, ".");
        $new=array();
        foreach ($contents as $key => $value) {
          $new[$key]=array('server'=>"10.0.100.11",'nombre'=>utf8_decode($value);)
        }

        $ftp_server = "10.0.1.61";
        $conn_id = ftp_connect($ftp_server);
        $login_result = ftp_login($conn_id, 'anonymous', '');
        $contents = ftp_nlist($conn_id, ".");
        foreach ($contents as $key => $value) {
          $new[$key]=array('server'=>"10.0.1.61",'nombre'=>utf8_decode($value);)
        }

        foreach ($rst as $ind => $ndc) {
                $ad=explode(" - ", $ndc->referido);
                if(isset($ad[1]))
                foreach ($new as $iFile => $dFile) {

                        $daFile=strtolower(str_replace(' ', '', $dFile['nombre']));
                        $nom = strtolower(str_replace(' ', '', $ad[0]));
                        $num = (int)str_replace("Nº ", '', $ad[1]);

                        $c1 = strpos($daFile, $nom);
                        $c2 = strpos($daFile, "".$num);
                        if($c1 !== false && $c2 !== false){
                                //echo "FOUND: $ndc->referido -> ".$new[$iFile];
                          $rst[$ind]->referido .= ' <b><a href="javascript:loadVid('.($ind+1).');"<i class="fa fa-video-camera"><input type="hidden" id="vid_'.($ind+1).'" value="'.$dFile['nombre'].'"> </i></a></b>';
                        }
                }
        }

      return Response::json(
            array(
                'rst'=>1,
                'datos'=>$rst
            )
        );
    }
}
