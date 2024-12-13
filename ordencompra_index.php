
<!DOCTYPE html>
<html>
    <head>
        <link rel="shortcut icon"  href=" images/mauro"/>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <title>ORDEN COMPRA</title>

        <?php
        require './session_start.php';
        require 'menu/css.ctp';
        ?>
    <link href="assets/plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
    <link href="assets/plugins/datepicker/datepicker.min.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" type="text/css" href="assets/plugins/chosen/css/chosen.min.css" />
    <link href="assets/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/skins/skin-blue.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/plugins/datepicker/datepicker3.css" rel="stylesheet" type="text/css" />
    </head>
    <body>
    <div id="wrapper">
            <?php require 'menu/navbar.php'; ?><!--BARRA DE HERRAMIENTAS-->
            <div id="page-wrapper">
                <div class="row">
                    <!--impresion del titulo de la pagina-->
                    <div class="col-lg-12">
                        <h3 class="page-header">LISTADO DE ORDEN DE COMPRA 

                            <a data-toggle="modal" data-target="#registrar" 
                               class="btn btn-primary btn-circle pull-right" 
                               rel="tooltip" data-title="Registrar">
                                <i class="fa fa-plus"></i>
                            </a>                      
                        </h3>
                    </div>  
                    <div class="col-lg-12">
                        <div class="panel-heading">
                            <div class="input-group custom-search-form">
                                <input id="filtrar" type="text" class="form-control" placeholder="Buscar...">
                                <span class="input-group-btn">
                                    <button class="btn btn-default" type="button" rel="tooltip" title="Buscar">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </span>
                            </div>
                        </div>                      
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                Datos
                            </div>
                            <?php
                            $ordens = consultas::get_datos("select * from v_ordencompra
                            order by cod_ord_compra asc");
                            if (!empty($ordens)) {
                                ?>                         
                                <!-- /.panel-heading -->
                                <div class="panel-body">
                                    <div>
                                        <table id="example1" width="100%" class="table table-striped table-bordered table-hover">
                                            <thead>
                                                <tr>
                                                    <th class="text-center">#</th>
                                                    <th class="text-center">FECHA. PRESU</th>  
                                                    <th class="text-center">PROVEEDOR</th>     
                                                    <th class="text-center">ESTADO</th>                                        
                                                    <th class="text-center">TOTAL</th>                                                                               
                                                    <th class="text-center">USUARIO</th>                                   
                                                    <th class="text-center">FECHA.ORDEN</th>                                   
                                                    <th class="text-center">FECHA. PEDIDO</th>                                   
                                                    <th class="text-center">ACCIONES</th>
                                                </tr>
                                            </thead>
                                            <tbody class="buscar">
                                                <?php foreach ($ordens as $orden) { ?> 
                                                    <tr>
                                                        <td class="text-center"><?php echo $orden['cod_ord_compra']; ?></td>
                                                        <td class="text-center"><?php echo $orden['cod_presu_com'] . " - " . $orden['fecha_presu_com']; ?></td>
                                                        <td class="text-center"><?php echo $orden['provee_nomb']; ?></td>
                                                        <td class="text-center"><?php echo $orden['orden_estado']; ?></td>
                                                        <td class="text-center"><?php echo number_format($orden['total_orden'], 0, ',', '.'); ?></td>
                                                        <td class="text-center"><?php echo $orden['usu_nick']; ?></td>
                                                        <td class="text-center"><?php echo $orden['orden_fecha']; ?></td>
                                                        <td class="text-center"><?php echo $orden['cod_pedido_com'] . " - " . $orden['fecha_pedi']; ?></td>
                                                        <td class="text-center">
                                                            <a  
                                                                href="ordencompra_detalle.php?vdetorden=<?php echo $orden['cod_ord_compra']; ?>&vped=<?php echo $orden['cod_pedido_com']; ?>&vpresu=<?php echo $orden['cod_presu_com']; ?>"
                                                                class="btn btn-xs btn-primary" rel='tooltip' data-title="Detalles" >
                                                                <span class="fa fa-th-list"></span></a>
                                                            <?php if ($orden['total_orden'] > 0) { ?>   

                                                                <a href="imprimir_ordencompra.php?vcod=<?php echo $orden['cod_ord_compra']; ?>"
                                                                   target="_blank"
                                                                   class="btn btn-xs btn-success"
                                                                   rel="tooltip" data-title="imprimir">
                                                                    <span class="glyphicon glyphicon-print"></span></a>

                                                            <?php } else { ?>
                                                            <?php } ?>
                                                             <?php if ($orden['total_orden'] > 0 && $orden['orden_estado'] == 'REGISTRADO') { ?>  
                                                                <a onclick="confirmar(<?php
                                                                echo "'" . $orden['cod_ord_compra'] . "_" .
                                                                $orden['cod_usu'] . "_" .
                                                                $orden['cod_provee'] . "_" .
                                                                $orden['orden_fecha'] . "_" . $orden['orden_estado'] . "_" . $orden['total_orden'] . "'";
                                                                ?>)"
                                                              class="btn btn-xs btn-primary" rel='tooltip' data-title="Confirmar"
                                                           data-toggle="modal"
                                                           data-target="#delete">
                                                            <span class="glyphicon glyphicon-ok-sign"></span></a>
                                                            <?php } else { ?>
                                                            <?php } ?>


                                                            <?php if ($orden['orden_estado'] == 'PENDIENTE' && $orden['total_orden'] > 0) { ?> 

                                                                <a onclick="anular(<?php
                                                                echo "'" . $orden['cod_ord_compra'] . "_" .
                                                                $orden['cod_usu'] . "_" .
                                                                $orden['cod_provee'] . "_" .
                                                                $orden['orden_fecha'] . "_" . $orden['orden_estado'] . "_" . $orden['total_orden'] . "'";
                                                                ?>)"
                                                                   class="btn btn-xs btn-danger" rel='tooltip' data-title="Anular"
                                                                   data-toggle="modal"
                                                                   data-target="#delete">
                                                                    <span class="glyphicon glyphicon-ban-circle"></span></a>
                                                            <?php } else { ?>
                                                            <?php } ?>

                                                        </td>
                                                    </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>                         
                                    </div>
                                <?php } else { ?>
                                    <div class="alert alert-info alert-dismissable">
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                        <strong>No se encontraron registro....!</strong>
                                    </div>
                                <?php } ?>  
                                <!-- /.panel-body -->
                            </div>
                        </div>
                        <!-- /.panel -->

                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <div id="registrar" class="modal fade" role="dialog">
                    <div class=" modal-dialog modal-lg ">
                        <!-- Modal content-->
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" 
                                        data-dismiss="modal" arial-label="Close">x</button>
                                <h4 class="modal-title"><strong>REGISTRAR ORDEN DE COMPRA</strong></h4>
                            </div>
                            <?php $fecha = consultas::get_datos("select * from v_fecha"); ?>
                            <form action="ordencompra_control.php" method="post" accept-charset="utf-8" class="form-horizontal">
                                <div class="panel-body ">
                                    <input type="hidden" name="accion"  value="1">
                                    <input type="hidden" name="vorden" value="0"/> 
                                    <input type="hidden" name="vusuario" 
                                           value="<?php echo $_SESSION['cod_usu']; ?>">
                                    <input type="hidden" name="vestad" value="REGISTRADO">
                                    <input type="hidden" name="vtotal" value="0">
                                    <input type="hidden" name="pagina" value="ordencompra_detalle.php">

                                    <span class="col-md-1"></span>
                                    <div class="form-group">
                                        <div class="col-md-4 " >
                                            <label  class="control-label col-md-2"><h3>FECHA</h3></label>
                                            <input type="date" required="" placeholder="Ingrese fecha" readonly=""
                                                   class="form-control" name="vfecha" value="<?php echo $fecha[0]['fecha'] ?>">
                                        </div>
                                     </div>

                                    <span class="col-md-1"></span>
                                    <div class="form-group">
                                        <div class="col-md-4">
                                            <label class="control-label col-md-3"><H3>SELECION</h3></label>
                                            <select  class="form-control" required="" id="LISTA" onChange="tiposelect(),proveedorpedi(),proveedor()" onclick="tiposelect()" >
                                                <option value="" >Seleccione.. </option>
                                                <option value="1" >PEDIDO </option>
                                                <option value="2" >PRESUPUESTO</option>



                                            </select>
                                        </div>

                                        <div class="col-md-4">
                                            <label  class="control-label col-md-3"><h3>PROVEEDOR</h3></label>
                                            <select class="form-control"  required="" name="vprov" id="detalles" >
                                                <option value="">Seleccione un proveedor</option>
                                                <?php $proveedors = consultas::get_datos("select * from proveedor "); ?> 
                                                <?php foreach ($proveedors as $proveedor) { ?>
                                                    <option value="<?php echo $proveedor['cod_provee']; ?>"><?php echo $proveedor['provee_nomb']; ?></option>
                                                <?php } ?>
                                            </select>
                                            <a   href="proveedor_index.php"  class=" col-md-2 btn btn-xs btn- pull-right" rel='tooltip' data-title="REGISTRAR PROVEEDOR" >
                                            <span class="fa fa-plus col-md-3"></span></a>
                                        </div>
                                        
                                    </div>
                                    
                                    <span class="col-md-1"></span>
                                    <div class="form-group">
                                        <div class="col-md-4">
                                            <label  class="control-label col-md-3"><h3>PEDIDO</h3></label>
                                            <select required="" class="form-control"   name="vped"id="pedido" onchange="proveedorpedi()"
                                                    onkeyup="proveedorpedi()"   >
                                                <option value="">Seleccione un Pedido</option>
                                                <?php
                                                $pedidos = consultas::get_datos("SELECT * FROM pedido_compra 
                                                WHERE ped_estado = 'PENDIENTE'
                                                ORDER BY cod_pedido_com;");
                                                ?> 
                                                <?php foreach ($pedidos as $pedido) { ?>
                                                    <option value="<?php echo $pedido['cod_pedido_com']; ?>"><?php echo $pedido['cod_pedido_com'] . " - " . $pedido['fecha_pedi']; ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>

                                        <div class="col-md-4">
                                            <label  class="control-label col-md-3"><h3>PRESUPUESTO</h3></label>
                                            <select  required="" class="form-control"   name="vpresu" id="presupuesto" onchange="proveedor()"
                                                     onkeyup="proveedor()"   >
                                                <option value="0">Seleccione un Presupuesto</option>
                                                <?php
                                                $presus = consultas::get_datos("SELECT * FROM presupuesto_compra 
                                                WHERE presu_estado = 'PENDIENTE'
                                                ORDER BY cod_presu_com;");
                                                ?> 
                                                <?php foreach ($presus as $presu) { ?>
                                                    <option value="<?php echo $presu['cod_presu_com']; ?>"><?php echo $presu['cod_presu_com'] . " - " . $presu['fecha_presu_com']; ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>

                                    </div>

                                    <div class="modal-footer">
                                        <button type="reset" data-dismiss="modal" class="btn btn-default pull-left">
                                            <i class="fa fa-close"></i> Cerrar</button>
                                        <button type="submit" class="btn btn-primary pull-right">
                                            <i class="fa fa-floppy-o"></i> Registrar</button>


                                    </div>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
                <!--fin-->
                <div class="modal fade" id="delete" tabindex="-1" role="dialog">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                <h4 class="modal-title custom_align" id="Heading">Atenci&oacute;n!!!</h4>
                            </div>
                            <div class="modal-body">

                                <div class="alert alert-warning" id="confirmacion"></div>

                            </div>
                            <div class="modal-footer">
                                <a id="si" role="button" class="btn btn-primary" ><span class="glyphicon glyphicon-ok-sign"></span> Si</a>
                                <button type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> No</button>
                            </div>
                        </div>
                    </div>
                </div> 
                <!--fin-->
            </div>

    
            <!--archivos js-->  
            <?php require 'menu/js.ctp'; ?>

            <script language="JavaScript">
                $("document").ready(function () {
                    tiposelect();
                });
                function tiposelect() {
                    if ($("#LISTA"))
                        switch ($("#LISTA").val()) {
                            case "1":
                                $("#pedido").removeAttr("disabled");
                                $("#presupuesto").attr("disabled", "disabled");
                                $("#presupuesto").val('0');


                                break;
                            case "2":
                                $("#presupuesto").removeAttr("disabled");
                                $("#pedido").attr("disabled", "disabled");
                                $("#pedido").val('');
                                break;
                            case "":
                                $("#pedido").attr("disabled", "disabled");
                                $("#pedido").val('');
                                $("#presupuesto").attr("disabled", "disabled");
                                $("#presupuesto").val('0');
                                break;


                        }
                }
                </script>

                <script>
                function borrar(datos) {
                    var dat = datos.split("_");
                    $('#si').attr('href', 'presucompra_control.php?vpresu=' + dat[0] 
                     + '&vusuario=' + dat[1] + '&vped=' + dat[2] + '&vprov=' + dat[3] + '&vfecha=' + dat[4] + '&vestad=' + dat[5] + '&vtotal=' + dat[6] + '&accion=3&pagina=presucompra_index.php');
                    $('#confirmacion').html('<span class="glyphicon glyphicon-warning-sign"></span>\n\
                      Desea Borrar el presupuesto <i><strong>' + dat[0] + '</strong></i>?');
                }


                function proveedor() {

                    if ((parseInt($('#presupuesto').val()) > 0) || ($('#presupuesto').val() == "") || ($('#presupuesto').val() !== "")) {
                        $.ajax({
                            type: "GET",
                            url: "/mauro/lista_proveedor_orden.php?vpresu=" + $('#presupuesto').val(),
                            cache: false,
                            beforeSend: function () {
                                $('#detalles').html('<img src="/mauro/images/cargando.GIF">  \n\
                          <strong><i>Cargando...</i></strong>');
                            },
                            success: function (msg) {
                                $('#detalles').html(msg);

                            }
                        });
                    }
                    else {
                        $("#presupuesto").val('');
                    }
                }


                function proveedorpedi() {

                    if ((parseInt($('#pedido').val()) > 0) || ($('#pedido').val() == "") || ($('#pedido').val() !== "")) {
                        $.ajax({
                            type: "GET",
                            url: "/mauro/lista_proveedor_1.php?vprov=" + $('#pedido').val(),
                            cache: false,
                            beforeSend: function () {
                                $('#detalles').html('<img src="/mauro/images/cargando.GIF">  \n\
                          <strong><i>Cargando...</i></strong>');
                            },
                            success: function (msg) {
                                $('#detalles').html(msg);

                            }
                        });
                    }
                    else {
                        $("#presupuesto").val('');
                    }
                }
                function anular(datos) {
                    var dat = datos.split("_");
                    $('#si').attr('href'
                            , 'ordencompra_control.php?vorden=' + dat[0] +
                            '&vusuario=' + dat[1] +
                            '&vprov=' + dat[2] +
                            '&vfecha=' + dat[3] +
                            '&vestad=ANULADO' +
                            '&vtotal=' + dat[5] +
                            '&accion=2' +
                            '&pagina=ordencompra_index.php');
                    $('#confirmacion').html('<span class="glyphicon glyphicon-warning-sign"></span>\n\
                Desea Anular la orden?');
                }
                function confirmar(datos) {
                    var dat = datos.split("_");
                    $('#si').attr('href'
                            , 'ordencompra_control.php?vorden=' + dat[0] +
                            '&vusuario=' + dat[1] +
                            '&vprov=' + dat[2] +
                            '&vfecha=' + dat[3] +
                            '&vestad=PENDIENTE' +
                            '&vtotal=' + dat[5] +
                            '&accion=4' +
                            '&pagina=ordencompra_index.php');
                    $('#confirmacion').html('<span class="glyphicon glyphicon-warning-sign"></span>\n\
                Desea Confirmar la orden?');
                }
            </script>


    </body>
</html>
