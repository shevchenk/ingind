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
                    //window.location='formatolicencia/verdoclicenciaconstruc/1';
                    window.open('formatolicencia/verdoclicenciaconstruc/'+obj.id+'/4/0','_blank');

                    swal({
                          title: "Excelente!",   
                          text: obj.msj,
                          type: "success",
                          closeOnConfirm: true
                          }, function(){
                             $('input[type="text"]').not('.data_fija').val('');                         
                      });                    
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
