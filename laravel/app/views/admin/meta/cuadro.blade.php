<!DOCTYPE html>
@extends('layouts.master')  

@section('includes')
    @parent
    {{ HTML::style('lib/daterangepicker/css/daterangepicker-bs3.css') }}
    {{ HTML::style('lib/bootstrap-multiselect/dist/css/bootstrap-multiselect.css') }}
    {{ HTML::script('lib/daterangepicker/js/daterangepicker.js') }}
    {{ HTML::script('lib/bootstrap-multiselect/dist/js/bootstrap-multiselect.js') }}

    @include( 'admin.js.slct_global_ajax' )
    @include( 'admin.js.slct_global' )
    @include( 'admin.meta.js.cuadro_ajax' )
    @include( 'admin.meta.js.cuadro' )
@stop
<!-- Right side column. Contains the navbar and content of the page -->
@section('contenido')
            <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Producciòn de Usuario
            <small> </small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Admin</a></li>
            <li><a href="#">Reporte</a></li>
            <li class="active">Usuarios</li>
        </ol>
    </section>

        <!-- Main content -->
        <section class="content">
            <!-- Inicia contenido -->
            <div class="box">
                <fieldset>
                    <div class="row form-group" >
                        <div class="col-sm-12">
                            <div class="col-sm-4">
                                <label class="control-label">Meta:</label>
                                <select class="form-control" name="slct_meta" id="slct_meta"multiple="">
                                </select>
                            </div>
                            <div class="col-sm-2">
                                <label class="control-label"></label>
                                <input type="button" class="form-control btn btn-primary" id="generar_area" name="generar_area" value="Mostrar">
                            </div>
                        </div>
                    </div>
                </fieldset>
            <div class="box-body table-responsive">
                <div class="row form-group" id="reporte" >
                    <div class="col-sm-12">
                        <div class="box-body table-responsive">
                            <table id="t_reporte" class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th colspan="4" style="text-align:center">Meta</th>
                                        <th colspan="2" style="text-align:center">Plan de Trabajo</th>
                                    </tr>
                                    <tr>
                                        <th style="text-align:center">Meta</th>
                                        <th style="text-align:center">Actividad</th>
                                        <th style="text-align:center">Descripción</th>
                                        <th style="text-align:center">Fecha</th>
                                        <th style="text-align:center">Paso</th>
                                        <th style="text-align:center">Fecha</th>
                                      
                                    </tr>
                                </thead>
                                <tbody id="tb_reporte">
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
              
               
                
                
                
            </div><!-- /.box -->
            </div><!-- /.box -->


            <!-- Finaliza contenido -->
        </div>
    </section><!-- /.content -->
    

@stop