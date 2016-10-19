<script type="text/javascript">
var cabeceraG=[]; // Cabecera del Datatable
var columnDefsG=[]; // Columnas de la BD del datatable
var targetsG=-1; // Posiciones de las columnas del datatable
//var RolsG={id:0,nombre:"",estado:1}; // Datos Globales
$(document).ready(function() {
    $('#plataformaModal').on('show.bs.modal', function (event) {
      var button = $(event.relatedTarget); // captura al boton
      var modal = $(this); //captura el modal
      //Asignar.Plataforma(PlataformaHTML);
      //$('#t_tramites_plataforma').dataTable().fnDestroy();
        var idG={   tramite        :'onBlur|Tramite|#DCE6F1', //#DCE6F1
                    fecha_inicio   :'onBlur|Fecha Inicio|#DCE6F1', //#DCE6F1
                    proceso        :'onBlur|Proceso|#DCE6F1', //#DCE6F1
                 };

        var resG=dataTableG.CargarCab(idG);
        cabeceraG=resG; // registra la cabecera
        var resG=dataTableG.CargarCol(cabeceraG,columnDefsG,targetsG,1,'plataforma','t_plataforma');
        columnDefsG=resG[0]; // registra las columnas del datatable
        targetsG=resG[1]; // registra los contadores
        var resG=dataTableG.CargarBtn(columnDefsG,targetsG,1,'BtnEditar','t_plataforma','fa-edit');
        columnDefsG=resG[0]; // registra la colunmna adiciona con boton
        targetsG=resG[1]; // registra el contador actualizado
        MostrarAjax('plataforma');
    });

    $('#plataformaModal').on('hide.bs.modal', function (event) {
      var modal = $(this); //captura el modal
    });
    $("#t_tramites_plataforma").dataTable();
});

MostrarAjax=function(t){
    if( t=="plataforma" ){
        if( columnDefsG.length>0 ){
            dataTableG.CargarDatos(t,'tabla_relacion','plataforma',columnDefsG);
        }
        else{
            alert('Faltas datos');
        }
    }
}

/*PlataformaHTML=function(datos){
    var html="";
    var cont=0;
    var botton="";
     $('#t_tramites_plataforma').dataTable().fnDestroy();

    $.each(datos,function(index,data){
    cont++;
    html+="<tr>"+
        "<td>"+data.tramite+"</td>"+
        "<td>"+data.fecha_inicio+"</td>"+
        "<td>"+data.proceso+"</td>"+
        '<td>'+
            '<a onclick="CargarTramitePlataforma('+"'"+data.tramite+"'"+');" class="btn btn-success btn-sm"><i class="fa fa-check-square fa-lg"></i> </a>'+
        '</td>';
    html+="</tr>";

    });
    $("#t_tramites_plataforma tbody").html(html); 
    $("#t_tramites_plataforma").dataTable();
}*/

CargarTramitePlataforma=function(id){
    $("#txt_codigo").val(id);
    $("#plataformaModal .modal-footer>button").click();
    alert('Si modifica el trámite de plataforma seleccionado será considerado como un trámite nuevo');
}

</script>
