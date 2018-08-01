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
@include( 'admin.reporte.js.actiasignada_ajax' )
@include( 'admin.reporte.js.actiasignada' )
@stop
<!-- Right side column. Contains the navbar and content of the page -->
@section('contenido')
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Actividades Asignadas
        <small> </small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Admin</a></li>
        <li><a href="#">Reporte</a></li>
        <li class="active">Actividades Asignadas</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <!-- Inicia contenido -->
    <div class="box">
        <fieldset>
            <div class="row form-group" >
                <div class="col-sm-12">
                    <div class="col-sm-4"><input type="hidden" id="area_id" name="area_id"> 
                        <label class="control-label">Area:</label>
                        <select class="form-control" name="slct_area_id[]" id="slct_area_id" multiple>
                        </select>
                    </div>
                    <div class="col-md-4 col-sm-4">
                        <label class="control-label">Rango de Fechas:</label>
                        <input type="text" class="form-control" placeholder="AAAA-MM-DD - AAAA-MM-DD" id="fecha" name="fecha" onfocus="blur()"/>
                    </div>
                    <div class="col-md-1 col-sm-1">                            
                        <label class="control-label" style="color: white">aaaaa</label>
                        <input type="button" class="btn btn-info" id="generar" name="generar" value="Productividad">
                    </div>
                    <div class="col-md-1 col-sm-1">                            
                        <label class="control-label" style="color: white">aaaaa</label>
                        <input type="button" class="btn btn-info" id="exportar" name="exportar" onclick="exportar();" value="Exportar">
                    </div>
                    <!--                                            <div class="col-md-1 col-sm-2" style="padding:24px">
                                                                    <a class='btn btn-success btn-md' id="btnexport" name="btnexport"><i class="glyphicon glyphicon-download-alt"></i> Export Actividades</i></a>
                                                                </div>-->
                    <!--                            <div class="col-sm-2">
                                                    <label class="control-label"></label>
                                                    <input type="button" class="form-control btn btn-primary" id="generar_area" name="generar_area" value="Mostrar">
                                                </div>-->
                </div>
            </div>
        </fieldset>









        <form id="form_3" name="form_3" method="post">
            <div class="row form-group" id="tramite_asignado" >

                <div class="col-sm-12">
                    <div class="col-sm-2" style="padding-top: 5px">
                        <span>Tiempo Total: </span>
                    </div>
                    <div class="col-sm-3">
                        <input type="text" class="form-control" id="txt_totalh" name="txt_totalh" readonly="readonly">
                    </div>
                    <br>
                </div>
                <div class="col-sm-12">
                    <div class="box-body table-responsive">
                        <table id="t_ordenest" class="table table-bordered">
                            <thead>
                                <tr>
                                    <th colspan="5">Asignada</th>
                                    <th colspan="3">Respuesta</th>
                                    <th colspan="2">Proceso</th>
                                </tr>
                                <tr>
                                    <th>Área</th>
                                    <th>Actividad</th>
                                    <th>Fecha Inicio - Fin<br>Asignación</th>
                                    <th>Formato de<br> Hora : Minuto</th>
                                    <th>Documentos<br>Asignados</th>
                                    <th>Persona</th>
                                    <th>Respuesta de<br>Actividad</th>
                                    <th>Documentos<br>Respuesta</th>
                                    <th>Proceso</th>
                                    <th>Cargo</th>
                                    
                                </tr>
                            </thead>
                            <tbody id="tb_ordenest">
                            </tbody>
                        </table>
                    </div>
                </div>






                <!-- Finaliza contenido -->
            </div>
            </section><!-- /.content -->

<script type="text/javascript">

          $("#generar").click(function (){});


    function exportar(){

        area_id = $('#slct_area_id').val();
        $('#area_id').val(area_id);
        var fecha=$("#fecha").val();
        if($.trim(area_id)!==''){
        if ( fecha!=="") {
                dataG = {area_id:area_id.join(','),fecha:fecha,distinto:'|',exportar:'1'};
                post("",{dataG},"POST");
        } else {
            alert("Seleccione Fecha");
        }}
        else {  alert("Seleccione Área"); }
    

    }
    function post(path, params, method) {
    method = method || "post"; // Set method to post by default if not specified.

    // The rest of this code assumes you are not using a library.
    // It can be made less wordy if you use one.
    var form = document.createElement("form");
    form.setAttribute("method", method);
    form.setAttribute("action", path);

    for(var key in params) {
        if(params.hasOwnProperty(key)) {
            var hiddenField = document.createElement("input");
            hiddenField.setAttribute("type", "hidden");
            hiddenField.setAttribute("name", key);
            hiddenField.setAttribute("value", params[key]);

            form.appendChild(hiddenField);
        }
    }

    document.body.appendChild(form);
    form.submit();
}


</script>
            @stop
            @section('formulario')
            @include( 'admin.reporte.form.produccionperxarea' )
            @include( 'admin.produccion.form.modalFile' )
            @stop
