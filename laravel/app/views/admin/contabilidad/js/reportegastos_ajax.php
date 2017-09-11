<script type="text/javascript">
//var Consulta, ConsultaDetalle, ConsultaDetalle2;
var Reporte={
    MostrarReporte:function( dataG){

        $.ajax({
            url         : 'reportegastos/reportedetallegastos',
            type        : 'POST',
            cache       : false,
            dataType    : 'json',
            data        : dataG,
            beforeSend : function() {
                $("body").append('<div class="overlay"></div><div class="loading-img"></div>');
            },
            success : function(obj) {
                $(".overlay,.loading-img").remove();
                if(obj.rst==1){  
                    //console.log(obj.datos);
                    HTMLMostrarReporte(obj.datos);
                }
            },
            error: function(){
                $(".overlay,.loading-img").remove();
                $("#msj").html('<div class="alert alert-dismissable alert-danger">'+
                                    '<i class="fa fa-ban"></i>'+
                                    '<button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>'+
                                    '<b>Ocurrio una interrupción en el proceso, Favor de intentar nuevamente.'+
                                '</div>');
            }
        });
    },
    MostrarReporteDetalle:function( dataG){

        $.ajax({
            url         : 'reportegastos/reportedetallegastostotales',
            type        : 'POST',
            cache       : false,
            dataType    : 'json',
            data        : dataG,
            beforeSend : function() {
                //$("body").append('<div class="overlay"></div><div class="loading-img"></div>');
                $("#tb_deta").html("<tr><td colspan='8' style='text-align: center;'>Cargando Registros..</td></tr>");
            },
            success : function(obj) {
                $(".overlay,.loading-img").remove();
                if(obj.rst==1){  
                    HTMLMostrarReporteDetalle(obj.datos);
                }
            },
            error: function(){
                $(".overlay,.loading-img").remove();
                $("#msj").html('<div class="alert alert-dismissable alert-danger">'+
                                    '<i class="fa fa-ban"></i>'+
                                    '<button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>'+
                                    '<b>Ocurrio una interrupción en el proceso, Favor de intentar nuevamente.'+
                                '</div>');
            }
        });
    },
    export:function(dataG){
        $.ajax({
            url         : 'reportegastos/exportdetallegastos',
            type        : 'GET',
            cache       : false,
            dataType    : 'json',
            data        : dataG,
            beforeSend : function() {
                $("body").append('<div class="overlay"></div><div class="loading-img"></div>');
            },
            success : function(obj) {
                $(".overlay,.loading-img").remove();
                if(obj.rst==1){
                  /*  HTMLreporte(obj.datos);
                    Consulta=obj;*/
                }
            },
            error: function(){
                $(".overlay,.loading-img").remove();
                $("#msj").html('<div class="alert alert-dismissable alert-danger">'+
                                    '<i class="fa fa-ban"></i>'+
                                    '<button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>'+
                                    '<b>Ocurrio una interrupción en el proceso,Favor de intentar nuevamente.'+
                                '</div>');
            }
        });
    }

};
</script>
