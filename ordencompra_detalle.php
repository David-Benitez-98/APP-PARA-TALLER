<!DOCTYPE html>
<html>
    <head>
        <link rel="shortcut icon"  href=" images/mauro"/>  
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <title>DETALLE ORDEN COMPRA</title>

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
                        <h3 class="page-header">DATOS DE ORDEN DE COMPRA

                            <a href="ordencompra_index.php" 
                               class="btn btn-primary btn-circle pull-right" 
                               rel="tooltip" data-title="Atras" >
                                <i class="glyphicon glyphicon-arrow-left"></i>
                            </a>                    
                        </h3>
                    </div>     

                </div>
                <!-- /.row -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                DATOS CABECERA
                            </div>
                            <?php
                            $ordens = consultas::get_datos("select * from  v_ordencompra"
                                            . " where cod_ord_compra=" . $_REQUEST['vdetorden'] .
                                            "order by cod_ord_compra asc");
                            ?>                         
                            <!-- /.panel-heading -->
                            <div class="panel-body">
                                <div class="table-responsive">
                                    <table width="100%"
                                           class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th class="text-center">#</th>
                                                <th class="text-center">FECHA. PRESU</th>  
                                                <th class="text-center">PROVEEDOR</th>                                      
                                                <th class="text-center">TOTAL</th>                                          
                                                <th class="text-center">USUARIO</th>                                   
                                                <th class="text-center">ESTADO</th>                                   
                                                <th class="text-center">FECHA ORDEN</th>                                   
                                                <th class="text-center">FECHA. PEDIDO</th>  
                                            </tr>
                                        </thead>

                                        <?php foreach ($ordens as $orden) { ?> 
                                            <tr>
                                                <td class="text-center"><?php echo $orden['cod_ord_compra']; ?></td>
                                                 <td class="text-center"><?php echo $orden['cod_presu_com'] . " - " . $orden['fecha_presu_com']; ?></td>
                                                <td class="text-center"><?php echo $orden['cod_provee']; ?></td>
                                                <td class="text-center"><?php echo number_format($orden['total_orden'], 0, ',', '.'); ?></td>
                                                <td class="text-center"><?php echo $orden['usu_nick']; ?></td>
                                                <td class="text-center"><?php echo $orden['orden_estado']; ?></td>
                                                <td class="text-center"><?php echo $orden['orden_fecha']; ?></td>
                                               <td class="text-center"><?php echo $orden['cod_pedido_com'] . " - " . $orden['fecha_pedi']; ?></td>

                                            </tr>
                                        <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <!-- COMIENZO PARA EL DETALLE-->
                        <?php
                        $ordencompdetas = consultas::get_datos
                                        ("select * from  v_ordencompdetalle"
                                        . " where cod_ord_compra=" . $_REQUEST['vdetorden'] .
                                        "order by cod_ord_compra asc");
                        ?>
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                DETALLE DE LA ORDEN 
                            </div>
                            <?php if (!empty($ordencompdetas)) { ?>
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th class="text-center">#</th>
                                                <th class="text-center"> ARTICULO</th>
                                                <th class="text-center"> CANTIDAD</th>
                                                <th class="text-center"> PRECIO</th>
                                                <th class="text-center"> SUBTOTAL</th>
                                                <th class="text-center"> ESTADO</th>
                                                <?php if ($orden['orden_estado'] == 'REGISTRADO') { ?>
                                                    <th class="text-center"> ACCION</th>
                                                <?php } else { ?>
                                                <?php } ?>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($ordencompdetas as $ordencompdeta) { ?>
                                                <tr>
                                                    <td class="text-center"><?php echo $ordencompdeta['cod_ord_compra']; ?></td>
                                                    <td class="text-center"><?php echo $ordencompdeta['arti_descrip']; ?></td>
                                                    <td class="text-center"><?php echo $ordencompdeta['orde_cant']; ?></td>
                                                    <td class="text-center"><?php echo number_format($ordencompdeta['orden_precio'], 0, ',', '.'); ?></td>
                                                    <td class="text-center"><?php echo number_format($ordencompdeta['detalle_ord_subt'], 0, ',', '.'); ?></td>
                                                    <td class="text-center"><?php echo $ordencompdeta['orden_estado']; ?></td>
                                                    <?php if ($orden['orden_estado'] == 'REGISTRADO') { ?>
                                                        <td class="text-center"> <a onclick="borrar(<?php
                                                            echo "'" . $ordencompdeta['cod_ord_compra'] . "_" .
                                                            $_REQUEST['vdetorden'] . "_" .
                                                            $_REQUEST['vped'] . "_" .
                                                            $_REQUEST['vpresu'] . "_" .
                                                            $ordencompdeta['cod_arti'] . "_" .
                                                            $ordencompdeta['orde_cant'] . "_" .
                                                            $ordencompdeta['orden_precio'] . "_" .
                                                            $ordencompdeta['orden_estado'] . "'";
                                                            ?>)"
                                                                                    class="btn btn-xs btn-danger"
                                                                                    ret='tooltip' data-title="Borrar"
                                                                                    data-toggle='modal'
                                                                                    data-target='#delete'>
                                                                <span class="glyphicon glyphicon-trash">
                                                                </span></a>
                                                        <?php } else { ?>
                                                        <?php } ?>
                                                    </td>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                <?php } else { ?>
                                    <div class="col-md-12">
                                        <div class="alert alert-info alert-dismissable">
                                            <button type="button" class="close"
                                                    data-dismiss="alert" aria-hidden="true">&times;
                                            </button>
                                            <strong>No se encontraron detalles de la orden....!</strong>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                    </div>

                    <?php if (isset($ordens[0]['cod_pedido_com'])) { ?>
                        <?php $pedidosdetas = consultas::get_datos("select * from v_pedidodetalle where ped_estado='PENDIENTE' and cod_pedido_com= " . $_REQUEST ['vped']); ?>

                    <?php } ?> 


                    <div class="panel-body">



                        <?php if (!empty($pedidosdetas)) {
                            ?>   
                            <div class="panel-heading">
                                DETALLE DEL PEDIDO 
                            </div>
                            <!-- /.panel-heading -->
                            <div class="table-responsive">
                                <!--                                    <div>-->
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th class="text-center">#</th>
                                            <th class="text-center"> ARTICULO</th>
                                            <th class="text-center"> CANTIDAD</th>
                                            <th class="text-center"> ESTADO</th>
                                            <?php if ($orden['orden_estado'] == 'REGISTRADO') { ?>
                                                <th class="text-center"> ACCION</th>
                                            <?php } else { ?>
                                            <?php } ?>
                                        </tr>
                                    </thead>
                                    <tbody class="buscar">
                                        <?php foreach ($pedidosdetas as $pedidosdeta) { ?> 
                                            <tr>
                                                <td class="text-center"><?php echo $pedidosdeta['cod_pedido_com']; ?></td>
                                                <td class="text-center"><?php echo $pedidosdeta['arti_descrip']; ?></td>
                                                <td class="text-center"><?php echo $pedidosdeta['ped_cant']; ?></td>
                                                <td class="text-center"><?php echo $pedidosdeta['ped_estado']; ?></td>
                                                <td class="text-center">
                                                    <?php if ($orden['orden_estado'] == 'REGISTRADO') { ?>
                                                        <a onclick="editar(<?php
                                                        echo "'" . $pedidosdeta['cod_pedido_com'] . "_" .
                                                        $pedidosdeta['cod_arti'] . "_" . $pedidosdeta['arti_descrip'] . "_" . $pedidosdeta['ped_cant'] . "'";
                                                        ?>)" 
                                                           class="btn btn-xs btn-primary" rel='tooltip' data-title="Confirmar" 
                                                           data-toggle="modal" data-target="#editar">
                                                            <span class="glyphicon glyphicon-ok-sign"></span></a>
                                                    <?php } else { ?>
                                                    <?php } ?>

                                                </td>
                                            </tr>

                                        <?php } ?>
                                    </tbody>
                                </table>                         

                            <?php } else { ?>

                            <?php } ?>

                        </div>



                        <!--                    COMIENZO DEL PRESUPUESTO-->

                        <?php if (isset($ordens[0]['cod_presu_com'])) { ?>

                            <?php $detpresus = consultas::get_datos("select * from v_presucompdetalle where presu_estado='PENDIENTE' and cod_presu_com=" . $_REQUEST ['vpresu']); ?> 

                        <?php } ?>


                        <?php if (!empty($detpresus)) { ?>
                            <div class="panel-heading">
                                DETALLE DEL PRESUPUESTO 
                            </div>
                            <div class="table-responsive">

                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th class="text-center">#</th>
                                            <th class="text-center"> ARTICULO</th>
                                            <th class="text-center"> CANTIDAD</th>
                                            <th class="text-center"> PRECIO</th>
                                            <th class="text-center"> SUBTOTAL</th>
                                            <th class="text-center"> ESTADO</th>
                                             <?php if ($orden['orden_estado'] == 'REGISTRADO') { ?>
                                            <th class="text-center"> ACCION</th>
                                              <?php } else { ?>
                                                    <?php } ?>
                                        </tr>
                                    </thead>
                                    <tbody class="buscar">
                                        <?php foreach ($detpresus as $detpresu) { ?> 
                                            <tr>
                                                <td class="text-center"><?php echo $detpresu['cod_presu_com']; ?></td>
                                                <td class="text-center"><?php echo $detpresu['arti_descrip']; ?></td>
                                                <td class="text-center"><?php echo $detpresu['presu_cant']; ?></td>
                                                <td class="text-center"><?php echo number_format($detpresu['presu_precio'], 0, ',', '.'); ?></td>
                                                <td class="text-center"><?php echo number_format($detpresu['det_presu_subtotal'], 0, ',', '.'); ?></td>
                                                <td class="text-center"><?php echo $detpresu['presu_estado']; ?></td>

                                                <td class="text-center">

                                                    <?php if ($orden['orden_estado'] == 'REGISTRADO') { ?>

                                                        <a onclick="confirmar(<?php
                                                        echo "'" . $_REQUEST['vdetorden'] . "_" .
                                                        $detpresu['cod_arti'] . "_" .
                                                        $detpresu['presu_cant'] . "_" .
                                                        $detpresu['presu_precio'] . "_" .
                                                        $detpresu['det_presu_subtotal'] . "_" .
                                                        $detpresu['presu_estado'] . "_" .
                                                        $_REQUEST ['vpresu'] . "'"
                                                        ?>)"
                                                           class="btn btn-xs btn-success" rel='tooltip' data-title="Confirmar"
                                                           data-toggle="modal"
                                                           data-target="#delete">
                                                            <span class="glyphicon glyphicon-ok-sign"></span></a>
                                                            <?php } else { ?>
                                                    <?php } ?>


                                                    </td>
                                                </tr>
                                           
                                        <?php } ?>
                                    </tbody>
                                </table>                         

                            <?php } else { ?>

                            <?php } ?>

                        </div>


                        <!--FIN DEL PRESUPUSTO-->



                    </div>

                </div>
            </div>
        </div>
        <!--confirmar-->

        <div id="editar" class="modal fade" role="dialog">
            <div class="modal-dialog modal-lg ">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" 
                                data-dismiss="modal" arial-label="Close">x</button>
                        <h4 class="modal-title"><strong>REGISTRAR PRECIO </strong></h4>
                    </div>
                    <form action="ordencompra_detalle_control.php" method="post" accept-charset="utf-8" class="form-horizontal">
                        <div class="panel-body">
                            <input name="accion" value="1" type="hidden"/>
                            <input type="hidden" name="pagina" value="ordencompra_detalle.php">
                            <input type="hidden" name="vdetorden" value="<?php echo $_REQUEST['vdetorden'] ?>">
                            <input type="hidden" name="vped" value="<?php echo $_REQUEST['vped'] ?>">
                            <input type="hidden" name="vpresu" value="<?php echo $_REQUEST['vpresu'] ?>">
                            <input type="hidden" name="vestado" value="ACTIVO">
                            <input type="hidden"  id="art" name="varti" value="0">
                            <input type="hidden"  id="subtotal" name="vsubt" value="0">

                            <span class="col-md-1"></span>
                            <div class="form-group">


                                <div class="col-md-5">
                                    <label class="col-md-2 control-label"><h3>ARTICULO</h3></label>
                                    <input  type="text" required="" readonly=""
                                            placeholder="Especifique articulo"
                                            class="form-control" id="artic">

                                </div>


                                <div class="col-md-3">
                                    <label class="col-md-2 control-label"><h3>Cantidad</h3></label>
                                    <input  id="canti" type="number" required="" readonly=""
                                            placeholder="Especifique Cantidad"
                                            class="form-control" min="1" 
                                            required  name="vcant"
                                            value="0" >

                                </div>
                                <br>


                            </div>
                            <BR>

                            <div class="form-group">
                                <label class="col-md-2 control-label">PRECIO:</label>
                                <div class="col-md-6"> 

                                    <input   type="number" required=""
                                             placeholder="Especifique precio"
                                             class="form-control"
                                             required min="100"  name="vprecio" id="prec"
                                             value="0">
                                </div>
                            </div>



                            <div class="modal-footer">
                                <button type="reset" data-dismiss="modal" class="btn btn-default pull-left">
                                    <i class="fa fa-close"></i> CERRAR</button>
                                <button type="submit" class="btn btn-primary pull-right">
                                    <i class="fa fa-refresh"></i> REGISTRAR</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>


        <!--fin de confirmar-->


        <!--            sino-->
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
        <!--            sino fin-->



    </div>

    <!--archivos js-->  
    <?php require 'menu/js.ctp'; ?>




    <script>
        function editar(datos) {
            var dat = datos.split("_");
            $('#cod').val(dat[0]);
            $('#art').val(dat[1]);
            $('#artic').val(dat[2]);
            $('#canti').val(dat[3]);
            console.log(dat[2]);


        }


        function confirmar(datos) {
            var dat = datos.split("_");
            $('#si').attr('href',
                    'ordencompra_detalle_control.php?vdetorden=' + dat[0] +
                    '&varti=' + dat[1] +
                    '&vcant=' + dat[2] +
                    '&vprecio=' + dat[3] +
                    '&vestado=' + dat[5] +
                    '&vpresu=' + dat[6] +
                    '&accion=1' +
                    '&pagina=ordencompra_detalle.php');
            $('#confirmacion').html
                    ('<span class="glyphicon glyphicon-warning-sign"></span>\n\
                Desea Confirmar este Articulo del Detalle de Orden?');

        }

        function borrar(datos) {
            var dat = datos.split("_");
            $('#si').attr('href',
                    'ordencompra_detalle_control.php?vdetorden=' + dat[1] +
                    '&vped=' + dat[2] +
                    '&vpresu=' + dat[3] +
                    '&vdetorden=' + dat[0] +
                    '&varti=' + dat[4] +
                    '&vcant=' + dat[5] +
                    '&vprecio=' + dat[6] +
                    '&vestado=' + dat[7] +
                    '&accion=3' +
                    '&pagina=ordencompra_detalle.php');
            $('#confirmacion').html
                    ('<span class="glyphicon glyphicon-warning-sign"></span>\n\
               Desea borrar el detalle?');
        }


    </script>

</body>
</html>

