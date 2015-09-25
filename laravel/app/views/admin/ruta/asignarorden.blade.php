<!DOCTYPE html>
@extends('layouts.master')

@section('includes')
    @parent
    {{ HTML::style('lib/datetime/css/bootstrap-datetimepicker.min.css') }}
    {{ HTML::style('lib/bootstrap-multiselect/dist/css/bootstrap-multiselect.css') }}
    {{ HTML::script('lib/bootstrap-multiselect/dist/js/bootstrap-multiselect.js') }}
    
    {{ HTML::script('lib/datetime/js/bootstrap-datetimepicker.min.js') }}
    @include( 'admin.js.slct_global_ajax' )
    @include( 'admin.js.slct_global' )

    @include( 'admin.ruta.js.ruta_ajax' )
    @include( 'admin.ruta.js.asignar_orden_ajax' )
    @include( 'admin.ruta.js.asignar_orden' )
@stop
<!-- Right side column. Contains the navbar and content of the page -->
@section('contenido')
            <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        Asignar orden de trabajo al Proceso
                        <small> </small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Admin</a></li>
                        <li><a href="#">Ruta</a></li>
                        <li class="active">Asignar</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-12">
                            <!-- Inicia contenido -->
                            <div class="box">
                                <form name="form_asignar" id="form_asignar" method="POST" action="">
                                    <div class="row form-group" >
                                        <div class="col-sm-12">
                                            <div class="col-sm-3">
                                                <label class="control-label">Fecha Inicio de la Gestión:</label>
                                                <input type="text" class="form-control" name="txt_fecha_inicio" id="txt_fecha_inicio">
                                            </div>
                                            <div class="col-sm-5">
                                                <label class="control-label">Proceso:</label>
                                                <select class="form-control" name="slct_flujo2_id" id="slct_flujo2_id">
                                                </select>
                                            </div>
                                            <div class="col-sm-3">
                                                <label class="control-label">Area:</label>
                                                <select class="form-control" disabled name="slct_area2_id" id="slct_area2_id">
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="col-sm-3">
                                                <label class="control-label">Nro Trámite:</label>
                                                <div class="input-group">
                                                    <span class="input-group-addon">CI-</span>
                                                    <input class="form-control" id="txt_codigo" name="txt_codigo" type="text" placeholder="Ing. Trámite">
                                                </div>
                                            </div>
                                            <div class="col-sm-3">
                                                <label class="control-label"> Fecha Trámite:</label>
                                                <div class="input-group">
                                                    <div class="input-group-addon">
                                                        <i class="fa fa-calendar"></i>
                                                    </div>
                                                    <input class="form-control" id="txt_fecha_tramite" name="txt_fecha_tramite" type="text">
                                                </div>
                                            </div>
                                            <div class="col-sm-3">
                                                <label class="control-label"> Referente:</label>
                                                <input class="form-control" id="txt_referente" name="txt_referente" type="text" placeholder="Ing. Trámite Ref.">
                                            </div>
                                            <div class="col-sm-3">
                                                <label class="control-label">Tipo Solicitante:</label>
                                                <select class="form-control" name="slct_tipo_persona" id="slct_tipo_persona" onchange="tpersona(this.value);">
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="col-sm-3 juridica" style="display:none">
                                                <label class="control-label"> RUC:</label>
                                                <input class="form-control" type="text" id="txt_ruc" name="txt_ruc" placeholder='RUC'>
                                            </div>
                                            <div class="col-sm-3 juridica org" style="display:none">
                                                <label class="control-label"> Razon social:</label>
                                                <input class="form-control" type="text" id="txt_razon_social" name="txt_razon_social" placeholder='Razon Social'>
                                            </div>
                                        </div>
                                        <div class="col-sm-12 natural" style="display:none">
                                            <div class="col-sm-3">
                                                <label class="control-label"> Paterno:</label>
                                                <input class="form-control" type="text" id="txt_paterno" name="txt_paterno" placeholder='Paterno'>
                                            </div>
                                            <div class="col-sm-3">
                                                <label class="control-label"> Materno:</label>
                                                <input class="form-control" type="text" id="txt_materno" name="txt_materno" placeholder='Materno'>
                                            </div>
                                            <div class="col-sm-3">
                                                <label class="control-label"> Nombre:</label>
                                                <input class="form-control" type="text" id="txt_nombre" name="txt_nombre" placeholder='Nombre'>
                                            </div>
                                        </div>
                                        <div class="col-sm-12 area" style="display:none">
                                            <div class="col-sm-3">
                                                <label class="control-label"> Area Interna:</label>
                                                <select class="form-control" type="text" id="slct_area_p_id" name="slct_area_p_id">
                                                <option value="">.:Seleccione:.</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="col-sm-6">
                                                <label class="control-label"> Ingresar Sumilla:</label>
                                                <textarea class="form-control" id="txt_sumilla" name="txt_sumilla"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row form-group" id="tabla_relacion" style="display:none;">
                                        <div class="col-sm-12">
                                            <div class="box-body table-responsive">
                                                <table id="t_tablarelacion" class="table table-bordered table-striped">
                                                    <thead>
                                                        <tr>
                                                            <th>Software</th>
                                                            <th>Código</th>
                                                            <th> [ ] </th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="tb_tablarelacion">
                                                        
                                                    </tbody>
                                                    <tfoot>
                                                        <tr>
                                                            <th>Software</th>
                                                            <th>Código</th>
                                                            <th> [ ] </th>
                                                        </tr>
                                                    </tfoot>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <a class="btn btn-primary btn-sm" onclick="CerrarTablaRelacion();" id="btn_cerrar_tabla_relacion">
                                                <i class="fa fa-remove fa-lg"></i>&nbsp;Cerrar
                                            </a>
                                            <a class="btn btn-primary btn-sm" data-toggle="modal" data-target="#asignarModal">
                                                <i class="fa fa-save fa-lg"></i>&nbsp;Nuevo
                                            </a>
                                        </div>
                                    </div>
                                    <div class="row form-group" id="tabla_ruta_flujo" style="display:none;">
                                        <div class="col-sm-12">
                                            <div class="box-body table-responsive">
                                                <table id="t_ruta_flujo" class="table table-bordered table-hover">
                                                    <thead>
                                                        <tr>
                                                            <th>#</th>
                                                            <th>Proceso</th>
                                                            <th>Area</th>
                                                            <th>Dueño del Proceso</th>
                                                            <th>Nro Trámite Ok</th>
                                                            <th>Nro Trámite Error</th>
                                                            <th>Fecha Creación</th>
                                                            <th> [ ] </th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="tb_ruta_flujo">
                                                        
                                                    </tbody>
                                                    <tfoot>
                                                        <tr>
                                                            <th>#</th>
                                                            <th>Proceso</th>
                                                            <th>Area</th>
                                                            <th>Dueño del Proceso</th>
                                                            <th>Nro Trámite Ok</th>
                                                            <th>Nro Trámite Error</th>
                                                            <th>Fecha Creación</th>
                                                            <th> [ ] </th>
                                                        </tr>
                                                    </tfoot>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <a class="btn btn-primary btn-sm" id="btn_guardar_todo">
                                                <i class="fa fa-save fa-lg"></i>&nbsp;Guardar
                                            </a>
                                        </div>
                                    </div>
                                </form>

                                <form name="form_ruta_flujo" id="form_ruta_flujo" method="POST" action="">
                                    <div class="row form-group" style="display:none">
                                        <div class="col-sm-12">
                                            <h1><span id="txt_titulo">Nueva Ruta</span>
                                            <small>
                                                <i class="fa fa-angle-double-right fa-lg"></i>
                                                <span id="texto_fecha_creacion">Fecha Creación:</span>
                                                <span id="fecha_creacion"></span>
                                            </small>
                                            </h1>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="col-sm-4">
                                                <label class="control-label">Dueño del Proceso:</label>
                                                <input class="form-control" type="text" id="txt_persona" name="txt_persona" readonly>
                                            </div>
                                            <div class="col-sm-3">
                                                <label class="control-label">Proceso:</label>
                                                <select class="form-control" name="slct_flujo_id" id="slct_flujo_id">
                                                </select>
                                            </div>
                                            <div class="col-sm-3">
                                                <label class="control-label">Area del Dueño del Proceso:</label>
                                                <select class="form-control" name="slct_area_id" id="slct_area_id">
                                                </select>
                                            </div>
                                            <!--div class="col-sm-2">
                                                <label class="control-label"># Ok:</label>
                                                <input class="form-control" type="text" id="txt_ok" name="txt_ok" readonly>
                                            </div>
                                            <div class="col-sm-2">
                                                <label class="control-label"># Error:</label>
                                                <input class="form-control" type="text" id="txt_error" name="txt_error" readonly>
                                            </div-->
                                        </div>                                        
                                    </div>
                                    <div class="row form-group" style="display:none">
                                        <div class="col-sm-12">
                                            <div class="box-body table-responsive">
                                                <table id="areasasignacion" class="table table-bordered" style="min-height:300px">
                                                    <thead> 
                                                        <tr class="head">
                                                            <th style="width:250px !important;min-width: 200px !important;" >
                                                            </th>
                                                            <th class="eliminadetalleg" style="min-width:1000px important!;">[]</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr class="body">
                                                            <td>
                                                                <table class="table table-bordered">
                                                                    <thead>
                                                                        <tr><th colspan="2">
                                                                        </th></tr>
                                                                        <tr class="head">
                                                                            <th>#</th>
                                                                            <th>Area</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody id="tb_rutaflujodetalleAreas">
                                                                    </tbody>
                                                                </table>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                    <tfoot>
                                                        <tr class="head">
                                                            <th>#</th>
                                                        </tr>
                                                    </tfoot>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <a class="btn btn-default btn-sm btn-sm" id="btn_close">
                                                <i class="fa fa-remove fa-lg"></i>&nbsp;Close
                                            </a>
                                        </div>
                                    </div>
                                </form>
                            </div><!-- /.box -->
                            <!-- Finaliza contenido -->
                        </div>
                    </div>

                </section><!-- /.content -->
@stop

@section('formulario')
     @include( 'admin.ruta.form.asignar' )
     @include( 'admin.ruta.form.ruta' )
@stop