<script type="text/javascript">
var cargo_id, opcion_id, menus_selec=[];
$(document).ready(function() {  
    Cargos.CargarCargos(activarTabla);

    $('#cargoModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget); // captura al boton
        var titulo = button.data('titulo'); // extrae del atributo data-
        cargo_id = button.data('id'); //extrae el id del atributo data
        var data = {cargo_id: cargo_id};
        var ids = [1,2];//por ejemplo seleccionando 2 valores
        // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
        // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
        var modal = $(this); //captura el modal
        modal.find('.modal-title').text(titulo+' Cargo');
        $('#form_cargos [data-toggle="tooltip"]').css("display","none");
        $("#form_cargos input[type='hidden']").remove();

        slctGlobal.listarSlct('menu','slct_menus','simple');

        if(titulo=='Nuevo'){
            
            //slctGlobal.listarSlct('opcion','slct_opciones','simple',null,null);
            modal.find('.modal-footer .btn-primary').text('Guardar');
            modal.find('.modal-footer .btn-primary').attr('onClick','Agregar();');
            $('#form_cargos #slct_estado').val(1); 
            $('#form_cargos #txt_nombre').focus();
        }
        else{
            Cargos.CargarOpciones(cargo_id);
            //slctGlobal.listarSlct('menu','slct_menus','simple',null,null);//ids debe seleccionar algunos
            //slctGlobal.listarSlct('menu','slct_menus','simple',null,null,0,'#slct_opciones','M');//ids debe seleccionar algunos
            
            //slctGlobal.listarSlct('opcion','slct_opciones','simple',null,null,1);//ids debe seleccionar algunos
            modal.find('.modal-footer .btn-primary').text('Actualizar');
            modal.find('.modal-footer .btn-primary').attr('onClick','Editar();');
            $('#form_cargos #txt_nombre').val( $('#t_cargos #nombre_'+button.data('id') ).text() );
            $('#form_cargos #slct_estado').val( $('#t_cargos #estado_'+button.data('id') ).attr("data-estado") );
            $("#form_cargos").append("<input type='hidden' value='"+button.data('id')+"' name='id'>");
        }

    });

    $('#cargoModal').on('hide.bs.modal', function (event) {
        var modal = $(this); //captura el modal
        modal.find('.modal-body input').val(''); // busca un input para copiarle texto
        $("#slct_opciones,#slct_menus").multiselect('destroy');
        $("#t_opcionCargo").html('');
        menus_selec=[];
    });
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
Nuevo=function(){
    //añadir registro opcion por usuario
    //necesito el id de la opcion y del cargo
    var menu_id=$('#slct_menus option:selected').val();
    var menu=$('#slct_menus option:selected').text();
    //que haya seleccionado un menu y no este agregado
    var buscar_menu = $('#menu_'+menu_id).text();
    if (menu_id!=='') {
        if (buscar_menu==="") {

            var html='';
            html+="<li class='list-group-item'><div class='row'>"+
                "<div class='col-sm-4' id='menu_"+menu_id+"'><h5>"+menu+"</h5></div>";

            $("#opcion_"+menu_id+" option").attr("selected",false);

            html+="<div class='col-sm-6' opciones='' ><select class='form-control' multiple='multiple' name='slct_opciones"+menu_id+"[]' id='slct_opciones"+menu_id+"'></select></div>";
            var envio = {menu_id: menu_id};

            html+='<div class="col-sm-2"><button type="button" id="'+menu_id+'" Onclick="EliminarSubmodulo(this)" class="btn btn-danger btn-sm" ><i class="fa fa-minus fa-sm"></i> </button></div>';

            html+="</div></li>";

            $("#t_opcionCargo").append(html);
            slctGlobal.listarSlct('opcion','slct_opciones'+menu_id,'multiple',null,envio);
            menus_selec.push(menu_id);
        } else 
            alert("Ya se agrego este menu");
    } else 
        alert("Seleccione Menu");

};
EliminarSubmodulo=function(obj){
    console.log(obj);
    var valor= obj.id;
    obj.parentNode.parentNode.parentNode.remove();
    var index = menus_selec.indexOf(valor);
    menus_selec.splice( index, 1 );
};
validaCargos=function(){
    $('#form_cargos [data-toggle="tooltip"]').css("display","none");
    var a=[];
    a[0]=valida("txt","nombre","");
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
</script>