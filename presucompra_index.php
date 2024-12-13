
<!DOCTYPE html>
<html>
    <head>
        <link rel="shortcut icon"  href="images/mauro"/>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <title>PRESUPUESTO</title>

        <?php
        require './session_start.php';
        require 'menu/css.ctp';
        ?>
    <link href="assets/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
    </head>
    <body>
        <div id="wrapper">
            <?php require 'menu/navbar.php'; ?><!--BARRA DE HERRAMIENTAS-->
            <div id="page-wrapper">
                <div class="row">
                    <!--impresion del titulo de la pagina-->
                    <div class="col-lg-12">
                        <h3 class="page-header">LISTADO DE PRESUPUESTO 

                            <a data-toggle="modal" data-target="#registrar" 
                               class="btn btn-primary btn-circle pull-right" 
                               rel="tooltip" data-title="Registrar">
                                <i class="fa fa-plus"></i>
                            </a>                      
                        </h3>
                    </div>     
                    <!--Buscador-->
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
                <!-- /.row -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                Datos
                            </div>
                            <?php
                            $presupuestos = consultas::get_datos("select * from v_presucompra
                                                   order by cod_presu_com asc");
                            if (!empty($presupuestos)) {
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
                                                    <th class="text-center">FECHA. PEDIDO</th>                                   
                                                    <th class="text-center">ACCIONES</th>
                                                </tr>
                                            </thead>
                                            <tbody class="buscar">
                                                <?php foreach ($presupuestos as $presupuesto) { ?> 
                                                    <tr>
                                                        <td class="text-center"><?php echo $presupuesto['cod_presu_com']; ?></td>
                                                        <td class="text-center"><?php echo $presupuesto['fecha_presu_com']; ?></td>
                                                        <td class="text-center"><?php echo $presupuesto['provee_nomb']; ?></td>
                                                        <td class="text-center"><?php echo $presupuesto['presu_estado']; ?></td>
                                                        <td class="text-center"><?php echo number_format($presupuesto['total_presu_comp'], 0, ',', '.'); ?></td>
                                                        <td class="text-center"><?php echo $presupuesto['usu_nick']; ?></td>
                                                        <td class="text-center"><?php echo $presupuesto['cod_presu_com']." - ".$presupuesto['fecha_pedi']; ?></td>
                                                        <td class="text-center">
                                                            <a  
                                                                href="presucompra_detalle.php?vdetpresu=<?php echo $presupuesto['cod_presu_com']; ?><?= "&vped=" . $presupuesto['cod_pedido_com'] ?>"
                                                                class="btn btn-xs btn-primary" rel='tooltip' data-title="Detalles" >
                                                                <span class="fa fa-th-list"></span></a>
                                                                
                                                                 <?php if ($presupuesto['total_presu_comp'] > 0 ) { ?> 
                                                                    <a href="imprimir_presupuesto.php?vcod=<?php echo $presupuesto['cod_presu_com']; ?>"
                                                            target="_blank"
                                                            class="btn btn-xs btn-success"
                                                            rel="tooltip" data-title="imprimir">
                                                                <span class="glyphicon glyphicon-print"></span></a>
                                                            <?php } else { ?>
                                                                     <?php } ?>
                                                                
                                                                   <?php if ($presupuesto['total_presu_comp'] > 0 && $presupuesto['presu_estado'] == 'REGISTRADO') { ?>   
                                                         
                                                                
                                                                      <a onclick="confirmar(<?php
                                                                echo "'" . $presupuesto['cod_presu_com'] . "_" .
                                                                $presupuesto['cod_usu'] . "_" .
                                                                $presupuesto['cod_pedido_com'] . "_" . $presupuesto['cod_provee'] . "_" .
                                                                $presupuesto['fecha_presu_com'] . "_" .$presupuesto['vigencia_presu_comp'] . "_" .
                                                                        $presupuesto['presu_estado'] . "_" . $presupuesto['total_presu_comp'] . "'";
                                                                ?>)"
                                                                    class="btn btn-xs btn-primary" rel='tooltip' data-title="Confirmar"
                                                           data-toggle="modal"
                                                           data-target="#delete">
                                                            <span class="glyphicon glyphicon-ok-sign"></span></a>
                                                                
                                                                    <?php } else { ?>
                                                                     <?php } ?>
                                                                
                                                            <?php if ($presupuesto['presu_estado'] == 'PENDIENTE' || ($presupuesto['presu_estado'] == 'REGISTRADO')) { ?>  
                                                            
                                                                <a onclick="anular(<?php
                                                                echo "'" . $presupuesto['cod_presu_com'] . "_" .
                                                                $presupuesto['cod_usu'] . "_" .
                                                                $presupuesto['cod_pedido_com'] . "_" . $presupuesto['cod_provee'] . "_" .
                                                                $presupuesto['fecha_presu_com'] . "_" .$presupuesto['vigencia_presu_comp'] . "_" .
                                                                        $presupuesto['presu_estado'] . "_" . $presupuesto['total_presu_comp'] . "'";
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

                    <!--registrar-->
                    <div id="registrar" class="modal fade" role="dialog">
                        <div class=" modal-dialog modal-lg ">
                            <!-- Modal content-->
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" 
                                            data-dismiss="modal" arial-label="Close">x</button>
                                    <h4 class="modal-title"><strong>REGISTRAR PRESUPUESTO</strong></h4>
                                </div>
                                <?php $fecha = consultas::get_datos("select * from v_fecha"); ?>
                                <form action="presucompra_control.php" method="post" accept-charset="utf-8" class="form-horizontal">
                                    <div class="panel-body ">
                                        <input type="hidden" name="accion"  value="1">
                                        <input type="hidden" name="vpresu" value="0"/> 
                                        <input type="hidden" name="vusuario" 
                                               value="<?php echo $_SESSION['cod_usu']; ?>">
                                        <input type="hidden" name="vestado" value="REGISTRADO">
                                        <input type="hidden" name="vtotal" value="0">
                                        <input type="hidden" name="pagina" value="presucompra_detalle.php">

                                        <span class="col-md-1"></span>
                                        <div class="form-group">
                                            <div class="col-md-4 " >
                                                <label  class="control-label col-md-2"><h3>FECHA</h3></label>
                                                <input type="date" required="" placeholder="Ingrese fecha" readonly="" id="fechapresu"
                                                       class="form-control" name="vfecha" value="<?php echo $fecha[0]['fecha'] ?>">
                                            </div>

                                            <div class="col-md-4 " >
                                            <label  class="control-label col-md-3"><h3>PEDIDO</h3></label>
                                                <select class="form-control"  required="" name="vped"  >
                                                    <option value="">Seleccione un codigo</option>
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


                                        </div>
                                        <span class="col-md-1"></span>
                                        <div class="form-group">
                                            <div class="col-md-4">
                                            <label  class="control-label col-md-3"><h3>PROVEEDOR</h3></label>
                                                <select class="form-control"  required="" name="vprov"  >
                                                    <option value="">Seleccione un proveedor</option>
                                                    <?php $proveedors = consultas::get_datos("select * from proveedor "); ?> 
                                                    <?php foreach ($proveedors as $proveedor) { ?>
                                                        <option value="<?php echo $proveedor['cod_provee']; ?>"><?php echo $proveedor['provee_nomb']; ?></option>
    <?php } ?>
                                                </select>
                                            </div>


                                            <div class="col-md-4">
                                            <label  class="control-label col-md-2"><h3>VIGENCIA</h3></label>
                                            <input type="date" required="" placeholder="Ingrese fecha" id="fec"  onchange="validar()"
                                                   class="form-control" name="vvigen" >
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
                    <!--editar-->
                    <!--fin editar-->
                    <!--borrar-->
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


            <script>
                function anular(datos) {
                    var dat = datos.split("_");
                    $('#si').attr('href'
                            , 'presucompra_control.php?vpresu=' + dat[0] +
                            '&vusuario=' + dat[1] +
                            '&vped=' + dat[2] +
                            '&vprov=' + dat[3] +
                            '&vfecha=' + dat[4] +
                            '&vvigen=' + dat[5] +
                            '&vestado=ANULADO' +
                            '&vtotal=' + dat[7] +
                            '&accion=2' +
                            '&pagina=presucompra_index.php');
                    $('#confirmacion').html('<span class="glyphicon glyphicon-warning-sign"></span>\n\
                Desea Anular el presupuesto?');
                }
                function confirmar(datos) {                                                                         
                    var dat = datos.split("_");
                    $('#si').attr('href'
                            , 'presucompra_control.php?vpresu=' + dat[0] +
                            '&vusuario=' + dat[1] +
                            '&vped=' + dat[2] +
                            '&vprov=' + dat[3] +
                            '&vfecha=' + dat[4] +
                            '&vvigen=' + dat[5] +
                            '&vestado=PENDIENTE' +
                            '&vtotal=' + dat[7] +
                            '&accion=4' +
                            '&pagina=presucompra_index.php');
                    $('#confirmacion').html('<span class="glyphicon glyphicon-warning-sign"></span>\n\
                Desea Confirmar el presupuesto?');
                }
                

       function validar() {
                var hoy = new Date($('#fechapresu').val());
                var fechaFormulario = new Date($('#fec').val());
                if (fechaFormulario < hoy) {
                     notificacion('Atencion', 'Fecha inferior a la fecha del presupuesto!!!', 'window.alert(message);');
                  
                    $('#fec').val(hoy);
                }
                else {

                }
            }

            </script>


    </body>
</html>
