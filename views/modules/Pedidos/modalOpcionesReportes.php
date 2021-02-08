<!--=============================================
MODAL - REPORTES DE LOGISITICA
=============================================-->
<div class="modal fade" id="modalReportesLogistica" data-backdrop="static" style="overflow-y: scroll;">
    <!--=============================================
    OPCIONES - REPORTES DE LOGISITICA
    =============================================-->
    <div class="modal-dialog modal-dialog-centered modal-md">
        <div class="modal-content">

            <!-- HEADER
                -------------------------------------------------- -->
            <div class="modal-header" style="border-top: #001f3f 12px solid;">
                <h1 class="modal-title">Opciones de reporte</h1>
                <button type="button" class="close btn text-black" data-dismiss="modal">×</button>
            </div>
            <!-- FIN HEADER
                -------------------------------------------------- -->

            <!-- CUERPO DEL MODAL
                -------------------------------------------------- -->
            <div class="modal-body" style="border-top: #001f3f 1px solid;">

                <div class="mb-3">
                    <div class="alert alert-light"><i class="fas fa-info-circle"></i> A continuación se muestran las opciones para obtener un resumen o promedio de los tiempos que hubo entre los diferentes estados de todos los pedidos, con la finalidad de ver en que procesos hay retrasos y en cuales no. Escoge la opción que desees.</div>

                    <!-- MENU DE OPCIONES
                    -------------------------------------------------- -->
                    <div class="row">
                        <button type="button" class="col-12 btn bg-primary mb-1 btnReporteLogistica" meses="1">Reporte del último mes</button>
                        <button type="button" class="col-12 btn bg-warning mb-1 btnReporteLogistica" meses="6">Reporte de los últimos 6 meses</button>
                        <button type="button" class="col-12 btn bg-danger mb-1 btnReporteLogistica" meses="12">Reporte del último año</button>
                        <button type="button" class="col-12 btn bg-navy" data-toggle="modal" data-target="#modalReportePersonalizado">Personalizado</button>
                    </div>
                    <!-- FIN - MENU DE OPCIONES
                    -------------------------------------------------- -->
                </div>
            </div>
            <!-- FIN CUERPO DEL MODAL
                -------------------------------------------------- -->

            <!-- PIE DEL MODAL
                -------------------------------------------------- -->
            <div class="modal-footer" style="border-top: #001f3f 1px solid;">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar ventana</button>
            </div>
            <!-- FIN PIE DEL MODAL
                -------------------------------------------------- -->

        </div>
    </div>
    <!--============  FIN OPCIONES - REPORTES DE LOGISTICA =============-->
</div>
<!--============  FIN MODAL - REPORTES DE LOGISTICA =============-->

<!--**
*
* MODAL PARA COLOCAR RANGO DE FECHAS
*
*-->

<!--=============================================
MODAL - REPORTES DE LOGISITICA PERSONALIZADOS
=============================================-->
<div class="modal fade" id="modalReportePersonalizado" data-backdrop="static">
    <!--=============================================
    OPCIONES - REPORTES DE LOGISITICA
    =============================================-->
    <form class="modal-dialog modal-dialog-centered modal-md">
        <div class="modal-content">

            <!-- HEADER
                -------------------------------------------------- -->
            <div class="modal-header" style="border-top: #001f3f 12px solid;">
                <h1 class="modal-title">Fechas personalizadas</h1>
                <button type="button" class="close btn text-black btnCerrarModalReportePersonalizado" data-dismiss="modal">×</button>
            </div>
            <!-- FIN HEADER
                -------------------------------------------------- -->

            <!-- CUERPO DEL MODAL
                -------------------------------------------------- -->
            <div class="modal-body" style="border-top: #001f3f 1px solid;">

                <div class="mb-3">
                    <!-- INPUT DE FECHAS
                    -------------------------------------------------- -->
                    <!-- FECHA DE INICIO -->
                    <div class="form-group">
                        <label>Fecha de inicio:</label>

                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                            </div>
                            <input type="text" class="form-control" data-inputmask-alias="datetime" data-inputmask-inputformat="dd/mm/yyyy" data-mask placeholder="Fecha de inicio" id="ingFechaInicioPersonalizada">
                        </div>

                    </div>
                    <!-- /.FECHA DE INICIO -->

                    <!-- FECHA DE INICIO -->
                    <div class="form-group">
                        <label>Fecha de termino:</label>

                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                            </div>
                            <input type="text" class="form-control" data-inputmask-alias="datetime" data-inputmask-inputformat="dd/mm/yyyy" data-mask placeholder="Fecha de termino" id="ingFechaTerminoPersonalizada">
                        </div>

                    </div>

                    <div class="invalid-feedback" id="errorIncongruentDate">
                        La fecha de termino debe ser mayor a la de inicio.
                    </div>
                    <div class="invalid-feedback" id="errorIncongruentDate2">
                        La fecha de termino no puede ser mayor a la de hoy.
                    </div>
                    <!-- /.FECHA DE INICIO -->

                    <!-- FIN - INPUT DE FECHAS
                    -------------------------------------------------- -->
                </div>
            </div>
            <!-- FIN CUERPO DEL MODAL
                -------------------------------------------------- -->

            <!-- PIE DEL MODAL
                -------------------------------------------------- -->
            <div class="modal-footer" style="border-top: #001f3f 1px solid;">
                <button type="button" class="btn btn-danger btnCerrarModalReportePersonalizado" data-dismiss="modal">Cerrar ventana</button>
                <button type="button" class="btn btn-primary btnObtenerReportePersonalizado">Obtener reporte</button>
            </div>
            <!-- FIN PIE DEL MODAL
                -------------------------------------------------- -->

        </div>
    </form>
    <!--============  FIN OPCIONES - REPORTES DE LOGISTICA =============-->
</div>
<!--============  FIN MODAL - REPORTES DE LOGISTICA PERSONALIZADOS =============-->