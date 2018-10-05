<?php
class ReporteTramiteController extends BaseController
{

    private $archivos = array();
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
        $x = array();
        foreach ($rst as $ind => $ndc){
          $x = $this->addVideoLink($rst[$ind]->referido);
          if(count($x)>0){
            $e[]=$x;
          }
        }

      return Response::json(
            array(
                'rst'=>1,
                'datos'=>$rst, 
                'errors'=>$x,
                //'allFiles'=>$this->archivos
            )
        );
    }

    function getFilesR($conn_id,$path='/',$srv){
      $result = array();
      $list = ftp_rawlist($conn_id, $path, TRUE);
        if(is_array($list))foreach($list as $ind => $val){
            $x = explode(' ',$val);
            $i=3;
            unset($x[0]);unset($x[1]);unset($x[2]);unset($x[3]);
            do {
              unset($x[$i]);
              $i++;
            } while ($x[$i]=="");
            if($x[$i]=="<DIR>"){
                    unset($x[$i]);
                    $result = array_merge($result,$this->getFilesR($conn_id,$path.'/'.trim(implode($x,' ')),$srv));
            }else{
                    unset($x[$i]);
                    $result[] = 'ftp://'.$srv.$path.'/'.trim(implode($x,' '));
            }
        }
        return $result;
    }


    function addVideoLink(&$reference){

        $errors = array();

        if(!is_array($this->archivos) || count($this->archivos<1)){
          $ftp_server = "10.0.100.11";
          $conn_id = ftp_connect($ftp_server);
          $login_result = ftp_login($conn_id, 'anonymous', '');

          if($login_result){
            $list = $this->getFilesR($conn_id,'/', $ftp_server);
            ftp_close($conn_id);
          }else{
            $errors['conn1']="No login en $ftp_server";
          }

          $ftp_server0 = "10.0.1.61";
          $conn_id0 = ftp_connect($ftp_server0);
          $login_result0 = ftp_login($conn_id0, 'anonymous', '');
          if($login_result0){
            $list0 = $this->getFilesR($conn_id0,'/', $ftp_server0);
            ftp_close($conn_id0);
          }else{
            $errors['conn2']="No login en $ftp_server0";
          }

          $this->archivos = array_merge($list,$list0);
        }

        $ad=explode(" - ", $reference);

        if(isset($ad[1]))
        foreach ($this->archivos as $dFile) {
          $daFile=strtolower(str_replace(' ', '', trim($dFile)));
          $nom = strtolower(str_replace(' ', '', trim($ad[0])));
          $num = (int)preg_replace("/[^A-Za-z0-9]/", "", trim($ad[1]));
          $found=strpos(
              preg_replace("/[^A-Za-z0-9]/", "",trim($dFile)), 
              preg_replace("/[^A-Za-z0-9]/", "",trim($reference))
          );

          $c1 = false;//strpos($daFile, $nom);
          $c2 = false;//strpos($daFile, "".$num);

          if($found!==false || ($c1 !== false && $c2 !== false)){

              $v0 = substr($dFile, 0,strrpos($dFile, "/")+1);
              $v1 = substr($dFile, strrpos($dFile, "/")+1);

              $vidName= $v0.rawurlencode($v1);

              $reference .= ' <b><a href="javascript:window.open(atob(\''.base64_encode( $vidName ).'\'));"<i class="fa fa-video-camera"></i></a></b>';
              //var_dump($rst[$ind]);
          }
        }
        return $errors;
    }
}
