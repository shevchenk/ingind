
<!-- /.modal -->
<div class="modal fade" id="plantillaModal" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header logo">
        <button class="btn btn-sm btn-default pull-right" data-dismiss="modal">
            <i class="fa fa-close"></i>
        </button>
        <h4 class="modal-title">New message</h4>
      </div>
      <div class="modal-body">
        <form id="form_plantilla" name="form_plantilla" action="plantilla/editar" method="post">
          <div class="row">
            <div class="col-xs-4">
                <div class="form-group">
                    <label class="control-label">Seleccionar Plantilla:
                      <a id="error_plantilla" style="display:none" class="btn btn-sm btn-warning" data-toggle="tooltip" data-placement="bottom" title="Seleccionar Plantilla">
                            <i class="fa fa-exclamation"></i>
                      </a>
                      </label>
                    <select class="form-control" name="slct_plantilla" id="slct_plantilla" >
                    </select>
                </div>
            </div>
          </div>

          <div class="row" style="display: none;">
            <div class="col-xs-6">
                <div class="form-group">
                    <label class="control-label">Plantilla:</label>
                    <select class="form-control" name="slct_plantilla2" id="slct_plantilla2" >
                    </select>
                </div>
            </div>
          </div>
          <div class="row" style="display: none;">
            <div class="col-xs-6">
              <div class="form-group">
                  <label class="control-label">titulo
                      <a id="error_nombre" style="display:none" class="btn btn-sm btn-warning" data-toggle="tooltip" data-placement="bottom" title="Ingrese Nombre">
                          <i class="fa fa-exclamation"></i>
                      </a>
                  </label>
                  <input type="text" class="form-control" placeholder="Ingrese Titulo" name="txt_nombre" id="txt_nombre">
              </div>
            </div>
          </div>
          <div class="row" id="partesCabecera" style="display: none;">
            <div class="col-xs-12">
              <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                <div class="panel panel-default">
                  <div class="panel-heading" role="tab" id="headingOne">
                    <h4 class="panel-title">
                      <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                        Partes de la Cabecera
                      </a>
                    </h4>
                  </div>
                  <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                    <div class="panel-body">
                      <table class="tabla-cabecera">
                          <tr>
                              <td width='25%' class='text-negrita'>A</td>
                              <td width='5px' class='text-negrita'>:</td>
                              <td width='75%'>Nombre de Encargado <br>Nombre de Gerencia y/o Subgerencia</td>
                          </tr>
                          <tr>
                              <td width='25%' class='text-negrita'>DE</td>
                              <td width='5px' class='text-negrita'>:</td>
                              <td width='75%'>Nombre a quien va dirigido <br>Nombre de Gerencia y/o Subgerencia</td>
                          </tr>
                          <tr>
                              <td width='25%' class='text-negrita'>ASUNTO</td>
                              <td width='5px' class='text-negrita'>:</td>
                              <td width='75%'>Titulo, <i>Ejemplo:</i>  Invitación a la Inaguración del Palacio Municipal</td>
                          </tr>
                          <tr>
                              <td width='25%' class='text-negrita'>FECHA</td>
                              <td width='5px' class='text-negrita'>:</td>
                              <td width='75%'>Fecha, <i>Ejemplo:</i> Lima, 01 de diciembre del 2016</td>
                          </tr>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="row" style="display: none;">
            <div class="col-xs-12">
              <div class="form-group">
                  <textarea id="plantillaWord" name="word" class="form-control" rows="6"></textarea>
              </div>
            </div>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Guardar</button>
      </div>
    </div>
  </div>
</div>
<!-- /.modal -->