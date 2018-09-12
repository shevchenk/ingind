<script type="text/javascript">

var Data = {
    AgregarEditarRol:function(AE){
        var datos = $("#form_forlic").serialize().split("txt_").join("").split("slct_").join("");
        //var accion = (AE==1) ? "actividadcategoria/editar" : "actividadcategoria/crear";

        $.ajax({
            url         : 'formatolicencia/crearliccontruc',
            type        : 'POST',
            cache       : false,
            dataType    : 'json',
            data        : datos,
            beforeSend : function() {
                $("body").append('<div class="overlay"></div><div class="loading-img"></div>');
            },
            success : function(obj) {
                $(".overlay, .loading-img").remove();
                if(obj.rst==1){
                    //MostrarAjax('rols');
                    //msjG.mensaje('success', obj.msj, 4000);

                    var html_text ='<span style="color: #3c8dbc; font-size:18px;">'+obj.msj+'<span>'+'</br><button type="button" id="btnadd" name="btnadd" onclick="Agregar();" class="btn btn-primary">Generar Licencia</button>';

                    swal({
                      title: "Mensaje!",
                      text: html_text,
                      html: true,
                      showConfirmButton: false
                    });
                    //$('#rolModal .modal-footer [data-dismiss="modal"]').click();
                } else {
                    swal("Mensaje!", "Debe ingresar el Expediente!", "error")
                }
            },
            error: function(){
                $(".overlay,.loading-img").remove();
                msjG.mensaje('danger','<b>Ocurrio una interrupción en el proceso,Favor de intentar nuevamente.',4000);
            }
        });
    }
};
</script>
