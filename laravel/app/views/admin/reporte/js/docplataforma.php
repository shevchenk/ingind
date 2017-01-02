<script type="text/javascript">
$(document).ready(function() {
    $('#fecha').daterangepicker({
        format: 'YYYY-MM-DD',
        singleDatePicker: false,
        showDropdowns: true
    });
    var data = {estado:1};
    var ids = [];
    //slctGlobal.listarSlct('area','slct_area_id','multiple',ids,data);


    function DataToFilter(){
        var fecha=$("#fecha").val();
        area_id = $('#slct_area_id').val();
        var data = [];
        if (fecha!=="") { 
            if ($.trim(area_id)!=='') {
                data.push(
                    {
                        fecha:fecha,
                        area_id:area_id
                    }
                );          
            }else{
                alert('seleccione area');
            }          
        } else {
            alert("Seleccione Fecha");
        }
        return data;
    }


    $("#generar").click(function (){
       /* var data = DataToFilter();            
        if(data.length > 0){
            Accion.mostrar(data[0]);            
        }*/
        var fecha=$("#fecha").val();
        if ( fecha!=="") {
            data = {fecha:fecha,area_id:$("#slct_area_id").val()};
            Accion.mostrar(data);
        } else {
            alert("Seleccione Fecha");
        }
    });

    data = {estado:1};
    slctGlobal.listarSlct('area','slct_area_id','multiple',ids,data);

});

GeneraHref=function(){
    var fecha=$("#fecha").val();
    alert(fecha);
            data = {fecha:fecha,area_id:$("#slct_area_id").val().join(',')};
        if ( fecha!=="" && $("#slct_area_id").val().length()>0 ) {
            $("#btnexport").attr('href','reporte/exportdocplataforma'+'?fecha='+data.fecha+'&areaexport='+data.area_id);
        }
        else if ( fecha!=="" ) {
            $("#btnexport").attr('href','reporte/exportdocplataforma'+'?fecha='+data.fecha);
        } 
}

HTMLreporte=function(datos){
    var html="";
    
    var alerta_tipo= '';
    $('#t_reporte').dataTable().fnDestroy();

    $.each(datos,function(index,data){
        
        html+="<tr>"+
            "<td>"+$.trim(data.proceso_pla)+"</td>"+
            "<td>"+$.trim(data.plataforma)+"</td>"+
            "<td>"+$.trim(data.fecha_inicio)+"</td>"+
            "<td>"+$.trim(data.dtiempo_final)+"</td>"+
            "<td>"+$.trim(data.proceso)+"</td>"+
            "<td>"+$.trim(data.fecha_inicio_gestion)+"</td>"+
            "<td>"+$.trim(data.ult_paso)+"</td>"+
            "<td>"+$.trim(data.act_paso)+"</td>"+
            "<td>"+$.trim(data.fecha_fin)+"</td>"+
            "<td>"+$.trim(data.tiempo_realizado)+"</td>";
        html+="</tr>";
    });
    $("#tb_reporte").html(html);
    $("#t_reporte").dataTable(); 
    $("#reporte").show();
};

eventoSlctGlobalSimple=function(slct,valores){
};
</script>
