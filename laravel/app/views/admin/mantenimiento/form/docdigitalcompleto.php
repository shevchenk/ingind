<!-- /.modal -->
<div class="modal fade"  id="docdigitalModal" tabindex="-1" role="dialog" aria-hidden="true">
<!-- <div class="modal fade" id="areaModal" tabindex="-1" role="dialog" aria-hidden="true"> -->
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header logo">
        <button class="btn btn-sm btn-default pull-right" data-dismiss="modal">
            <i class="fa fa-close"></i>
        </button>
        <h4 class="modal-title">Documentos</h4>
      </div>
      <div class="modal-body">
        <div class="row">
            <div class="col-xs-12">
                <!-- Inicia contenido -->
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title"></h3>
                    </div><!-- /.box-header -->
                  <form id="form_docdigitales" name="form_docdigitales" method="POST" action="">
                      <input type="hidden" name="tipo" id="tipo" value="1">
                      <input type="hidden" name="solo_area" id="tipo" value="|">
                        <div class="box-body table-responsive">
                            <table id="t_docdigitales" class="table table-bordered table-striped">
                                <thead>
                                <tr><th colspan="10" style="text-align:center;background-color:#A7C0DC;"><h2>Documentos</h2></th></tr>
                                    <tr>
                                    
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                                <tfoot>
                                   
                                </tfoot>
                            </table>
                                                   </div><!-- /.box-body -->
                    </form>
                    <form id="form_docdigitales_relaciones" name="form_docdigitales_relaciones" method="POST" action="">
                      <input type="hidden" name="tipo" id="tipo" value="2">
                        <div class="box-body table-responsive">
                            <table id="t_docdigitales_relaciones" class="table table-bordered table-striped">
                                <thead>
                                <tr><th colspan="10" style="text-align:center;background-color:#A7C0DC;"><h2>Documentos</h2></th></tr>
                                    <tr>
                                    
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                                <tfoot>
                                   
                                </tfoot>
                            </table>
                                                   </div><!-- /.box-body -->
                    </form>
                </div><!-- /.box -->
                <!-- Finaliza contenido -->
            </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

      </div>
    </div>
  </div>
</div>
<!-- /.modal -->