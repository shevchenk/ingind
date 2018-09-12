<script type="text/javascript">
$(document).ready(function() {

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

    $('#btnempty').click(function() {
        $('input[type="text"]').not('.data_fija').val('');
    });

});


Agregar = function(){
    if(validaCampos()){

        sweetalertG.confirm("Confirmación!", "Desea guardar la resolución?", function(){
            Data.AgregarEditarRol();
        });        
        //alert('llego');
    }
};
validaCampos = function(){
    var r=true;

    if( $("#txt_expediente").val()=='' ){
        $("#txt_expediente").focus();
        swal("Mensaje", "Ingrese Expediente!");
        r=false;
    }    
    else if( $("#fecha_vence").val()=='' ){
        $("#fecha_vence").focus();
        swal("Mensaje", "Ingrese la Fecha Vencimiento!");
        r=false;
    }
    else if( $("#txt_licencia_edifica").val()=='' ){
        $("#txt_licencia_edifica").focus();
        swal("Mensaje", "Ingrese Licencia de Edificación!");
        r=false;
    }
    else if( $("#txt_modalidad").val()=='' ){
        $("#txt_modalidad").focus();
        swal("Mensaje", "Ingrese Modalidad!");
        r=false;
    }
    else if( $("#txt_uso").val()=='' ){
        $("#txt_uso").focus();
        swal("Mensaje", "Ingrese Uso!");
        r=false;
    }
    else if( $("#txt_zonifica").val()=='' ){
        $("#txt_zonifica").focus();
        swal("Mensaje", "Ingrese Zonificación!");
        r=false;
    }
    else if( $("#txt_altura").val()=='' ){
        $("#txt_altura").focus();
        swal("Mensaje", "Ingrese Altura!");
        r=false;
    }
    else if( $("#txt_propietario").val()=='' ){
        $("#txt_propietario").focus();
        swal("Mensaje", "Ingrese Propietario!");
        r=false;
    }
    else if( $("#txt_dir_urbaniza").val()=='' ){
        $("#txt_altura").focus();
        swal("Mensaje", "Ingrese Dirección!");
        r=false;
    }
    else if( $("#txt_area_terreno").val()=='' ){
        $("#txt_area_terreno").focus();
        swal("Mensaje", "Ingrese Area Terreno!");
        r=false;
    }
    return r;
};
</script>
