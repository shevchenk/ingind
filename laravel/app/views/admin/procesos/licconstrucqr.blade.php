<!DOCTYPE html>
@extends('layouts.master')  

@section('includes')
    @parent
    {{ HTML::style('lib/bootstrap-multiselect/dist/css/bootstrap-multiselect.css') }}
    {{ HTML::script('lib/bootstrap-multiselect/dist/js/bootstrap-multiselect.js') }}
    {{ Html::style('lib/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css') }}
    {{ Html::script('lib/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js') }}
    {{ Html::script('lib/bootstrap-datetimepicker/js/locales/bootstrap-datetimepicker.es.js') }}

    @include( 'admin.js.slct_global_ajax' )
    @include( 'admin.js.slct_global' )
    @include( 'admin.procesos.js.licconstrucqr_ajax' )
    @include( 'admin.procesos.js.licconstrucqr' )
@stop
<!-- Right side column. Contains the navbar and content of the page -->
@section('contenido')
    <!-- Content Header (Page header) -->

<style type="text/css">
    .formato{
        background-color: #FFF;
        margin:10px auto;
        -webkit-box-shadow: 5px 5px 20px #999;
        -moz-box-shadow: 5px 5px 20px #999;
        filter: shadow(color=#999999, direction=135, strength=2);
    }    
</style>

    <section class="content-header">
        <h1>
            <small style="font-weight: bold;">Formato de Licencia de Construcci&oacute;n</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Admin</a></li>
            <li><a href="#">Procesos</a></li>
            <li class="active">Licencia de Construcción</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
    <div class="row">
        <div class="col-md-1"></div>
        <div id="signupbox" class="formato col-md-10">
            <div class="form-horizontal">
                <form action="#" method="post" enctype="multipart/form-data" name="form_forlic" id="form_forlic">
                    <div class="col-md-12">
                        <h2 class="text-center"><span class="fa fa-edit fa-1x"></span> RESOLUCION DE LICENCIA DE EDIFICACION </h2>
                        <h5>Por favor complete el siguiente formulario para poder generar el formato fis&iacute;co:</h5>
                        <hr/>
                    </div>
                    
                    <div class="col-md-12">
                        <div class="form-group row">
                          <label for="" class="col-md-2 col-form-label">EXPEDIENTE</label>
                          <div class="col-md-4">
                            <input class="form-control" name="txt_expediente" id="txt_expediente" type="text" value="" placeholder="4698-2016">
                          </div>
                        </div>
                        <div class="form-group row">
                          <label for="" class="col-md-2 col-form-label">FECHA EMISION</label>
                          <div class="col-md-2">
                            <div class="input-group">
                              <input class="form-control data_fija fechas" placeholder="yyyy-mm-dd" id="txt_fecha_emision" name="txt_fecha_emision" type="text" style="cursor:pointer;" value="<?=date('Y-m-d')?>" readonly>
                              <span class="input-group-addon"><span class="glyphicon glyphicon-calendar" aria-hidden="true"></span></span>
                            </div>
                          </div>
                          <label for="" class="col-md-2 col-form-label">FEC. VENCIMIENTO</label>
                          <div class="col-md-2">
                            <div class="input-group">
                              <input class="form-control fechas" placeholder="yyyy-mm-dd" id="txt_fecha_vence" name="txt_fecha_vence" type="text" style="cursor:pointer;" readonly>
                              <span class="input-group-addon"><span class="glyphicon glyphicon-calendar" aria-hidden="true"></span></span>
                            </div>
                          </div>
                        </div>

                        <div class="form-group row">
                          <label for="" class="col-md-2 col-form-label">LIC. EDIFICACIÓN</label>
                          <div class="col-md-6">
                            <input class="form-control" name="txt_licencia_edifica" id="txt_licencia_edifica" type="text" value="" placeholder="Licencia de Edifición">
                          </div>
                          <label for="" class="col-md-2 col-form-label">MODALIDAD</label>
                          <div class="col-md-2">
                            <input class="form-control" name="txt_modalidad" id="txt_modalidad" type="text" value="" placeholder="B">
                          </div>
                        </div>   
                        <div class="form-group row">
                          <label for="" class="col-md-2 col-form-label">USO</label>
                          <div class="col-md-3">
                            <input class="form-control" name="txt_uso" id="txt_uso" type="text" value="" placeholder="Uso">
                          </div>
                          <label for="" class="col-md-1 col-form-label">ZONIFICA</label>
                          <div class="col-md-2">
                            <input class="form-control" name="txt_zonifica" id="txt_zonifica" type="text" value="" placeholder="Zonificación">
                          </div>
                          <label for="" class="col-md-2 col-form-label">ALTURA</label>
                          <div class="col-md-2">
                            <input class="form-control" name="txt_altura" id="txt_altura" type="text" value="" placeholder="Altura">
                          </div>
                        </div>
                        <div class="form-group row">
                          <label for="" class="col-md-2 col-form-label">ADMINISTRADO</label>
                          <div class="col-md-6">
                            <input class="form-control" name="" id="" type="text" value="" placeholder="">
                          </div>
                          
                          <label for="" class="col-md-2 col-form-label">PROPIETARIO</label>
                          <div class="col-md-2">
                            <input class="form-control" name="txt_propietario" id="txt_propietario" type="text" value="" placeholder="B">
                          </div>
                        </div>
                        
                        <div class="form-group row">
                          <label for="" class="col-md-2 col-form-label">UBICACION</label>
                           <div class="col-md-3 text-center">
                            <input class="form-control data_fija" name="txt_departamento" id="txt_departamento" type="text" value="LIMA" readonly><strong>Departamento</strong>
                          </div>
                          <div class="col-md-3 text-center">
                            <input class="form-control data_fija" name="txt_provincia" id="txt_provincia" type="text" value="LIMA" readonly><strong>Provincia</strong>
                          </div>
                          <div class="col-md-4 text-center">
                            <input class="form-control data_fija" name="txt_distrito" id="txt_distrito" type="text" value="INDEPENDENCIA" readonly><strong>Distrito</strong>
                          </div>
                        </div>

                        <div class="form-group row">
                          <label for="" class="col-md-2 col-form-label">DIRECCION</label>
                           <div class="col-md-4 text-center">
                            <input class="form-control" name="txt_dir_urbaniza" id="txt_dir_urbaniza" type="text" value=""><strong>Urbanizaci&oacute;n/AA.HH/Otro</strong>
                          </div>
                          <div class="col-md-1 text-center">
                            <input class="form-control" name="txt_dir_mz" id="txt_dir_lote" type="text" value=""><strong>Mz.</strong>
                          </div>
                          <div class="col-md-1 text-center">
                            <input class="form-control" name="txt_dir_lote" id="txt_dir_lote" type="text" value=""><strong>Lote</strong>
                          </div>
                          <div class="col-md-4 text-center">
                            <input class="form-control" name="txt_dir_calle" id="txt_dir_calle" type="text" value=""><strong>Av./Jr./Calle/Pasaje</strong>
                          </div>
                        </div>

                        <div class="form-group row">
                          <label for="" class="col-md-2 col-form-label">AREA TERRENO</label>
                          <div class="col-md-2">
                            <input class="form-control" name="txt_area_terreno" id="txt_area_terreno" type="text" value="" placeholder="Area de Terreno">
                          </div>
                          <label for="" class="col-md-1 col-form-label">VALOR</label>
                          <div class="col-md-3">
                            <input class="form-control" name="txt_valor_obra" id="txt_valor_obra" type="text" value="" placeholder="Valor de Obra">
                          </div>
                        </div>
                        
                        <div class="form-group row">
                          <label for="" class="col-md-2 col-form-label">&nbsp;</label>
                          <div class="col-md-6">
                            <table class="table table-striped" style="border: 5px solid #f5f5f5;">
                                <thead>
                                  <tr>
                                    <th><input class="form-control data_fija" name="txt_piso" id="txt_piso" type="text" value="Piso"></th>
                                    <th><input class="form-control data_fija" name="txt_area_techada" id="txt_area_techada" type="text" value="Area Techada"></th>
                                  </tr>
                                </thead>
                                <tbody>
                                  <tr>
                                    <td><input class="form-control data_fija" name="txt_piso_1" id="txt_piso_1" type="text" value="1° Piso"></td>
                                    <td><input class="form-control" name="txt_area_1" id="txt_area_1" type="text" value="" placeholder="000.00 m2"></td>
                                  </tr>
                                  <tr>
                                    <td><input class="form-control data_fija" name="txt_piso_2" id="txt_piso_2" type="text" value="2° Piso"></td>
                                    <td><input class="form-control" name="txt_area_2" id="txt_area_2" type="text" value="" placeholder="000.00 m2"></td>
                                  </tr>
                                  <tr>
                                    <td><input class="form-control" name="txt_piso_3" id="txt_piso_3" type="text" value=""></td>
                                    <td><input class="form-control" name="txt_area_3" id="txt_area_3" type="text" value="" placeholder="000.00 m2"></td>
                                  </tr>
                                  <tr>
                                    <td><input class="form-control" name="txt_piso_4" id="txt_piso_4" type="text" value=""></td>
                                    <td><input class="form-control" name="txt_area_4" id="txt_area_4" type="text" value="" placeholder="000.00 m2"></td>
                                  </tr>
                                </tbody>
                              </table>
                          </div>                              
                        </div>

                        <div class="form-group row">
                          <label for="" class="col-md-2 col-form-label">DERECHO LICENCIA</label>
                          <div class="col-md-2">
                            <input class="form-control" name="txt_derecho_licencia" id="txt_derecho_licencia" type="text" value="" placeholder="Derecho Licencia">
                          </div>
                          <label for="" class="col-md-1 col-form-label">Rec. N°</label>
                          <div class="col-md-3">
                            <input class="form-control" name="txt_recibo" id="txt_recibo" type="text" value="" placeholder="000000001">                            
                          </div>
                          <div class="col-md-2">                            
                            <div class="input-group">
                              <input class="form-control fechas" placeholder="yyyy-mm-dd" id="txt_fecha_recibo" name="txt_fecha_recibo" type="text" style="cursor:pointer;" readonly>
                              <span class="input-group-addon"><span class="glyphicon glyphicon-calendar" aria-hidden="true"></span></span>
                            </div>
                          </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-12 text-center">
                            <button type="button" id="btnadd" name="btnadd" onclick="Agregar();" class="btn btn-primary">Guardar</button>
                            <button type="button" id="btnempty" name="btnempty" class="btn btn-info">Limpiar</button>
                            <a href="" id="hrefcancel" class="btn btn-default active">Cancelar</a>
                            </div>
                        </div>
                    </div>
                                                    
                </form>
            </div>
        </div>
    </div>
    </section><!-- /.content -->
@stop
