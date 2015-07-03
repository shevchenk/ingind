<script type="text/javascript">
$(document).ready(function() {

    $('#fecha').daterangepicker({
        format: 'YYYY-MM-DD',
        singleDatePicker: false
    });
    var data = {estado:1};
    var ids = [];
    slctGlobal.listarSlct('flujo','slct_flujos','multiple',ids,data);
    slctGlobalHtml('slct_estado_id','multiple');
    //Mostrar 
    $("#generar").click(function (){
        flujo_id = $('#slct_flujos').val();
        var fecha=$("#fecha").val();
        estado_id=$("#slct_estado_id").val();
        if ( fecha!==""){
            if ($.trim(flujo_id)!=='') {
                if($.trim(estado_id)!=''){
                data = {flujo_id:flujo_id,fecha:fecha,estado_id:estado_id};
                //data = {area_id:area_id,fecha:fecha};
                Rutas.mostrar_t(data);
                }
                else{
                    alert("Seleccione Estado");
                }
            } else {
                alert("Seleccione Proceso");
            }
        } else {
            alert("Seleccione Fecha");
        }
    });

});
HTMLreporte_t=function(datos){
    var html="";
    
    var alerta_tipo= '';
    $.each(datos,function(index,data){
        alerta_tipo = '';
        
        if (data.alerta=='Alerta' || data.alerta=='Alerta Validada') {
            if (data.alerta_tipo==1) {
                alerta_tipo = 'Tiempo asignado';
            } else if (data.alerta_tipo==2) {
                alerta_tipo = 'Tiempo de respuesta';
            } else if (data.alerta_tipo==3) {
                alerta_tipo = 'Tiempo aceptado';
            }
        }
        html+="<tr>"+
            "<td>"+data.proceso+"</td>"+
            "<td>"+data.duenio+"</td>"+
            "<td>"+data.area_duenio+"</td>"+
            "<td>"+data.n_areas+"</td>"+
            "<td>"+data.n_pasos+"</td>"+
            "<td>"+data.tiempo+"</td>"+
            "<td>"+data.fecha_creacion+"</td>";

            if(data.estado_final==1){
        html+="<td>"+data.fecha_produccion+"</td>";
        html+="<td>"+data.ntramites+"</td>";
        html+='<td><a onClick="detalletra('+data.ruta_flujo_id+',this)" class="btn btn-primary btn-sm"><i class="fa fa-search fa-lg"></i> </a></td>';
            }
            else{
        html+="<td>&nbsp;</td>";
        html+="<td>0</td>";
        html+="<td>&nbsp;</td>";
            }
            //'<td><a onClick="detalle('+data.ruta_flujo_id+',this)" class="btn btn-primary btn-sm" data-id="'+data.ruta_flujo_id+'" data-titulo="Editar"><i class="fa fa-search fa-lg"></i> </a></td>';
        html+="</tr>";
    });
    $("#tb_reporte_t").html(html);
    //$("#tb_reporteDetalle").html('');
    //$("#tb_reporteDetalle2").html('');
    //activarTabla();
    $("#reporte_t").show();
};

detalletra=function(ruta_flujo_id, boton){
    var tr = boton.parentNode.parentNode;
    var trs = tr.parentNode.children;
    for(var i =0;i<trs.length;i++)
        trs[i].style.backgroundColor="#f9f9f9";
    tr.style.backgroundColor = "#9CD9DE";
    var data={id:ruta_flujo_id};
    Rutas.mostrar(data);
}

HTMLreporte=function(datos){
    var html="";
    $('#t_reporte').dataTable().fnDestroy();
    $("#reporte_detalle").hide();
    $.each(datos,function(index,data){
        /*html+="<tr>"+
            "<td>"+data.id_union+"</td>"+
            "<td>"+data.fecha_inicio+"</td>"+
            "<td>"+data.software+"</td>"+
            "<td>"+data.persona+"</td>"+
            "<td>"+data.area+"</td>"+
            "<td>"+data.ok+"</td>"+
            "<td>"+data.error+"</td>"+
            "<td>"+data.corregido+"</td>"+
            '<td><a onClick="detalle('+data.id+',this)" class="btn btn-primary btn-sm" data-id="'+data.id+'" data-titulo="Editar"><i class="fa fa-search fa-lg"></i> </a></td>';
        html+="</tr>";*/
        html+="<tr>"+
            "<td>"+data.tramite+"</td>"+
            "<td>"+data.tipo_persona+"</td>"+
            "<td>"+data.persona+"</td>"+
            "<td>"+data.sumilla+"</td>"+
            "<td>"+data.estado+"</td>"+
            "<td>"+data.ultimo_paso_area+"</td>"+
            "<td>"+data.total_pasos+"</td>"+
            "<td>"+data.fecha_tramite+"</td>"+
            "<td>"+data.fecha_fin+"</td>"+
            "<td>"+data.ok+"</td>"+
            "<td>"+data.errorr+"</td>"+
            "<td>"+data.corregido+"</td>"+
            '<td><a onClick="detalle('+data.id+',this)" class="btn btn-primary btn-sm" data-id="'+data.id+'" data-titulo="Editar"><i class="fa fa-search fa-lg"></i> </a></td>';
        html+="</tr>";
    });
    $("#tb_reporte").html(html);
    $("#tb_reporteDetalle").html('');
    activarTabla();
    $("#reporte").show();

};
HTMLreporteDetalle=function(datos){
    var html="";
    var alertOk ='success';//verde
    var alertError ='danger';//ambar
    var alertCorregido ='warning';//rojo
    var alert='', i;
    $.each(datos,function(index,data){
        if (data.alerta=='0') alert=alertOk;
        if (data.alerta=='1') alert=alertError;
        if (data.alerta=='2') alert=alertCorregido;

        alerta_tipo = '';
        observacion = data.observacion.split(",");
        descripcion_v = data.descripcion_v.split(",");
        documento = data.documento.split(",");
        estado_accion = data.estado_accion.split(",");
        rol = data.rol.split(",");
        verbo = data.verbo.split(",");
        verbo_finalizo = data.verbo_finalizo.split(",");

        html+="<tr class='"+alert+"'>"+
                "<td>"+data.norden+"</td>"+
                "<td>"+data.area+"</td>"+
                "<td>"+data.tiempo+': '+data.dtiempo+"</td>"+
                "<td>"+data.fecha_inicio+"</td>"+
                "<td>"+data.dtiempo_final+"</td>"+
                //"<td>"+data.verbo_finalizo+"</td>";
                "<td>"+data.alerta+"</td>";

        html+=  "<td><ul>";
        for (i = rol.length - 1; i >= 0; i--) 
            html+= "<li>"+rol[i]+"</li>";
        html+=  "</ul></td><td><ul>";
        for (i = verbo.length - 1; i >= 0; i--) 
            html+= "<li>"+verbo[i]+"</li>";
        html+=  "</ul></td><td><ul>";
        for (i = documento.length - 1; i >= 0; i--) 
            html+= "<li>"+documento[i]+"</li>";
        html+=  "</ul></td><td><ul>";
        for (i = descripcion_v.length - 1; i >= 0; i--) 
            html+= "<li>"+descripcion_v[i]+"</li>";
        html+=  "</ul></td><td><ul>";
        for (i = verbo.length - 1; i >= 0; i--) //n_doc
            html+=      "<li></li>";
        html+=  "</ul></td><td><ul>";
        for (i = observacion.length - 1; i >= 0; i--) 
            html+= "<li>"+observacion[i]+"</li>";
        html+=  "</ul></td><td><ul>";
        for (i = estado_accion.length - 1; i >= 0; i--) 
            html+= "<li>"+estado_accion[i]+"</li>";
        html+=  "</ul></td>";
        html+=  "</tr>";

    });
    $("#tb_reporteDetalle").html(html);
    //$("#t_reporteDetalle2").dataTable();
    $("#reporte_detalle").show();
};
activarTabla=function(){
    $("#t_reporte").dataTable();
};
detalle=function(ruta_id, boton){
    var tr = boton.parentNode.parentNode;
    var trs = tr.parentNode.children;
    for(var i =0;i<trs.length;i++)
        trs[i].style.backgroundColor="#f9f9f9";
    tr.style.backgroundColor = "#9CD9DE";
    Rutas.mostrarDetalle(ruta_id);
};
eventoSlctGlobalSimple=function(slct,valores){
};
</script>
