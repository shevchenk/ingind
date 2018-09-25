<script type="text/javascript">
$(document).ready(function() {  
    Cargos.CargarCargos(activarTabla);

    $(".fechas").datetimepicker({
        format: "yyyy-mm-dd",
        language: 'es',
        showMeridian: false,
        time: false,
        minView: 3,
        startView: 2,
        autoclose: true,
        todayBtn: false
    });

    $('#cargoModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget); // captura al boton
        var titulo = button.data('titulo'); // extrae del atributo data-
        cargo_id = button.data('id'); //extrae el id del atributo data
        //var data = {cargo_id: cargo_id};
        // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
        // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
        var modal = $(this); //captura el modal
        modal.find('.modal-title').text('Nuevo Registro Carnet');
        $('#form_cargos [data-toggle="tooltip"]').css("display","none");
        $("#form_cargos input[type='hidden']").remove();


        slctGlobal.listarSlct('menu','slct_menus','simple');
        if(titulo=='Nuevo'){
            modal.find('.modal-footer .btn-primary').text('Guardar');
            modal.find('.modal-footer .btn-primary').attr('onClick','Agregar();');
            $('#form_cargos #slct_estado').val(1); 
            $('#form_cargos #txt_nombre').focus();
        }

        $( "#form_cargos #slct_estado" ).trigger('change');
        $( "#form_cargos #slct_estado" ).change(function() {
            if ($( "#form_cargos #slct_estado" ).val()==1) {
                $('fieldset').removeAttr('disabled');
            }
            else {
                $('fieldset').attr('disabled', 'disabled');
            }
        });

    });

    $('#btn_nuevo').on('click', function(){
        var modal = $('#cargoModal'); //captura el modal
        modal.find('.modal-body input').val(''); // busca un input para copiarle texto
        $("#t_opcionCargo").html('');
    });

    /*
    $('#cargoModal').on('hide.bs.modal', function (event) {
        var modal = $(this); //captura el modal
        modal.find('.modal-body input').val(''); // busca un input para copiarle texto
        $("#slct_menus").multiselect('destroy');
        $("#t_opcionCargo").html('');
        menus_selec=[];
    });
    */
});

activarTabla=function(){
    $("#t_cargos").dataTable(); // inicializo el datatable    
};

Editar=function(){
    if(validaCargos()){
        Cargos.AgregarEditarCargo(1);
    }
};

activar=function(id){
    Cargos.CambiarEstadoCargos(id,1);
};
desactivar=function(id){
    Cargos.CambiarEstadoCargos(id,0);
};

Agregar=function(){
    if(validaCargos()){
        Cargos.AgregarEditarCargo(0);
    }
};

validaCargos=function(){
    $('#form_cargos [data-toggle="tooltip"]').css("display","none");
    var a=[];
    a[0]=valida("txt","nombre","");
    a[1]=valida("txt","paterno","");
    a[2]=valida("txt","materno","");
    var rpta=true;

    for(i=0;i<a.length;i++){
        if(a[i]===false){
            rpta=false;
            break;
        }
    }
    return rpta;
};

valida=function(inicial,id,v_default){
    var texto="Seleccione";
    if(inicial=="txt"){
        texto="Ingrese";
    }

    if( $.trim($("#"+inicial+"_"+id).val())==v_default ){
        $('#error_'+id).attr('data-original-title',texto+' '+id);
        $('#error_'+id).css('display','');
        return false;
    }   
};
HTMLCargarCargo=function(datos){
    var html="";
    $('#t_cargos').dataTable().fnDestroy();

    $.each(datos,function(index,data){
        estadohtml='<span id="'+data.id+'" onClick="activar('+data.id+')" class="btn btn-danger">Inactivo</span>';
        if(data.estado==1){
            estadohtml='<span id="'+data.id+'" onClick="desactivar('+data.id+')" class="btn btn-success">Activo</span>';
        }

        html+="<tr>"+
            "<td >"+data.serie+"</td>"+
            "<td >"+data.nombre+"</td>"+
            "<td >"+data.paterno+"</td>"+
            "<td >"+data.fecha_nace+"</td>"+
            "<td >"+data.sexo+"</td>"+
            "<td id='estado_"+data.id+"' data-estado='"+data.estado+"'>"+estadohtml+"</td>";

        //html+='<td><a class="btn btn-primary btn-sm" data-toggle="modal" data-target="#cargoModal" data-id="'+data.id+'" data-titulo="Editar"><i class="fa fa-edit fa-lg"></i> </a></td>';

        html+='<td>'+
                '<p>'+
                '<a class="btn btn-primary active btn-xs" href="#" onclick="openImagen('+data.id+',\''+data.serie+'\',4,0); return false;" data-titulo="Previsualizar"><i class="fa fa-print"></i>&nbsp;Print</a></p>';
        html+="</td>";

        /*
        html+='<td>'+
                '<p><a class="btn btn-default btn-xs" href="#" onclick="openPlantilla('+data.id+',\''+data.serie+'\',4,0); return false;" data-titulo="Previsualizar"><i class="fa fa-print"></i>&nbsp;Ver</a>&nbsp;'+
                '<a class="btn btn-danger btn-xs" href="#" onclick="openImagen('+data.id+',\''+data.serie+'\',4,0); return false;" data-titulo="Previsualizar"><i class="fa fa-print"></i>&nbsp;Print</a></p>';
        html+="</td>";
        */

        html+="</tr>";
    });
    $("#tb_cargos").html(html); 
    activarTabla();
};

openImagen=function(id,serie,tamano,tipo){    
    window.open("carnetcanes/crearcarnetqr/"+id+"/"+serie+"/"+tamano+"/"+tipo,
                "PrevisualizarCarnet",
                "toolbar=no,menubar=no,resizable,scrollbars,status,width=700,height=400");
    //popup = window.open();
    //popup.document.write("<img src='documentodig/crearcarnetqr/"+area_id+"/"+dni+"/"+tamano+"/"+tipo>"'>");
    
    //popup.document.write("<img src='http://proceso.munindependencia.pe/documentodig/crearcarnetqr/"+area_id+"/"+dni+"/"+tamano+"/"+tipo+"'>")    
    /*popup.document.write("<img src='http://localhost/ingind/public/documentodig/crearcarnetqr/"+area_id+"/"+dni+"/"+tamano+"/"+tipo+"'>")    
    popup.focus(); //required for IE
    popup.print();*/
};
</script>

