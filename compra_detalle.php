<!DOCTYPE html>
<html lang="en">
<head>
        <link rel="shortcut icon"  href=" images/mauro."/>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
    <title>DETALLE DE COMPRAS</title>

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
                        <h3 class="page-header">DATOS DE COMPRA

                            <a href="compra_index.php" 
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
                            <?php $compras = consultas::get_datos("select * from  v_compras"
                                            . " where cod_compra=" . $_REQUEST['vdetcompra'] .
                                            "order by cod_compra asc");    
                            if (!empty($compras)) {
                                ?> 
                           
                            <div class="panel-body">
                                <div class="table-responsive">
                                    <table width="100%"
                                           class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th class="text-center">#</th>
                                                <th class="text-center">FECHA. COMPRA</th>  
                                                <th class="text-center">NRO. FACTURA</th>  
                                                <th class="text-center">PROVEEDOR</th>     
                                                <th class="text-center">ESTADO</th>                                        
                                                <th class="text-center">TOTAL</th>                                          
                                                <th class="text-center">USUARIO</th>
                                                <th class="text-center">CONDICION</th>
                                                <th class="text-center">CUOTA</th>

                                            </tr>
                                        </thead>

                                        <?php foreach ($compras as $compra) { ?> 
                                            <tr>
                                                <td class="text-center"><?php echo $compra['cod_compra']; ?></td>
                                                <td class="text-center"><?php echo $compra['fecha_compra']; ?></td>
                                                <td class="text-center"><?php echo $compra['fac_compra']; ?></td>
                                                <td class="text-center"><?php echo $compra['provee_nomb']; ?></td>
                                                <td class="text-center"><?php echo $compra['comp_estado']; ?></td>
                                                <td class="text-center"><?php echo number_format($compra['total_comp'], 0, ',', '.'); ?></td>
                                                <td class="text-center"><?php echo $compra['usu_nick']; ?></td>
                                                <td class="text-center"><?php echo $compra['compra_cond']; ?></td>
                                                <td class="text-center"><?php echo $compra['cant_cuota_comp']; ?></td>

                                            </tr>
                                        <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                              
                            </div>
                              <?php } else { ?>
                                      <div class="col-md-12">
                                    <div class="alert alert-info alert-dismissable">
                                        <button type="button" class="close"
                                                data-dismiss="alert" aria-hidden="true">&times;
                                        </button>
                                        <strong>Numero de factura repetido del mismo proveedor, favor verificar....!</strong>
                                    </div>
                                </div>
                                <?php } ?> 
                                
                        </div>
                        
                        <!-- COMIENZO PARA EL DETALLE-->

                        <?php
                        $detacompras = consultas::get_datos
                                        ("select * from  v_compdetalle"
                                        . " where cod_compra=" . $_REQUEST['vdetcompra'] .
                                        "order by cod_compra asc");
                        ?>


                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                DETALLE DE LA COMPRA 
                            </div>
                            <?php if (!empty($detacompras)) { ?>
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th class="text-center">#</th>
                                                <th class="text-center"> ARTICULO</th>
                                                <th class="text-center"> CANTIDAD</th>
                                                <th class="text-center"> PRECIO</th>
                                                <th class="text-center"> SUBTOTAL</th>
                                                <th class="text-center"> IVA 5</th>
                                                <th class="text-center"> GRABADA 5</th>
                                                <th class="text-center"> IVA 10</th>
                                                <th class="text-center"> GRABADA 10</th>
                                                <th class="text-center"> ESTADO</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($detacompras as $detacompra) { ?>
                                                <tr>
                                                    <td class="text-center"><?php echo $detacompra['cod_compra']; ?></td>
                                                    <td class="text-center"><?php echo $detacompra['arti_descrip']; ?></td>
                                                    <td class="text-center"><?php echo number_format($detacompra['det_comp_cant'], 0, ',', '.'); ?></td>
                                                    <td class="text-center"><?php echo number_format($detacompra['det_comp_precio'], 0, ',', '.'); ?></td>
                                                    <td class="text-center"><?php echo number_format($detacompra['det_comp_subt'], 0, ',', '.'); ?></td>
                                                    <td class="text-center"><?php echo number_format($detacompra['iva_5'], 0, ',', '.'); ?></td>
                                                    <td class="text-center"><?php echo number_format($detacompra['gravada_5'], 0, ',', '.'); ?></td>
                                                    <td class="text-center"><?php echo number_format($detacompra['iva_10'], 0, ',', '.'); ?></td>
                                                    <td class="text-center"><?php echo number_format($detacompra['gravada_10'], 0, ',', '.'); ?></td>
                                                    <td class="text-center"><?php echo $detacompra['det_comp_estado']; ?></td>
                                                      <?php if ($compra['comp_estado'] == 'ACTIVO') { ?> 
                                                    <td class="text-center"> <a onclick="borrar(<?php
                                                            echo "'" . $detacompra['cod_compra'] . "_" .
                                                            $_REQUEST['vdetcompra'] . "_" .
                                                            $_REQUEST['vped'] . "_" .
                                                            $_REQUEST['vorden'] . "_" .
                                                            $detacompra['cod_arti'] . "_" .
                                                            $detacompra['det_comp_cant'] . "_" .
                                                            $detacompra['det_comp_precio'] . "_" .
                                                            $detacompra['det_comp_estado'] . "'";
                                                            ?>)"
                                                                                    class="btn btn-xs btn-danger"
                                                                                    ret='tooltip' data-title="Borrar"
                                                                                    data-toggle='modal'
                                                                                    data-target='#delete'>
                                                                <span class="glyphicon glyphicon-trash">
                                                                </span></a></td>
                                                                  <?php } else { ?>
                                                                     <?php } ?>

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
                                            <strong>No se encontraron detalles de la compra....!</strong>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                    </div>

                    <?php if (isset($compras[0]['cod_pedido_como'])) { ?>
                        <?php $pedidosdetas = consultas::get_datos("select * from v_pedidodetalle where ped_estado='PENDIENTE' and cod_pedido_como= " . $_REQUEST ['vped']); ?>

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
                                              <?php if ($compra['comp_estado'] == 'ACTIVO') { ?> 
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
                                                      <?php if ($compra['comp_estado'] == 'ACTIVO') { ?> 
                                                    <a onclick="editar(<?php
                                                    echo "'" . $pedidosdeta['cod_pedido_com'] . "_" .
                                                    $pedidosdeta['cod_arti'] . "_" . $pedidosdeta['ped_cant'] . "'";
                                                    ?>); 
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

                        <?php if (isset($compras[0]['cod_ord_compra'])) { ?>

<?php $ordencompdetas = consultas::get_datos("select * from v_ordencompdetalle where orden_estado='ACTIVO' and cod_ord_compra=" . $_REQUEST ['vorden']); ?> 

<?php } ?>


<?php if (!empty($ordencompdetas)) { ?>
<div class="panel-heading">
    DETALLE DE LA ORDEN 
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
            </tr>
        </thead>
        <tbody class="buscar">
            <?php foreach ($ordencompdetas as $ordencompdeta) { ?> 
                <tr>
                    <td class="text-center"><?php echo $ordencompdeta['cod_ord_compra']; ?></td>
                    <td class="text-center"><?php echo $ordencompdeta['arti_descrip']; ?></td>
                  <td class="text-center"><?php echo number_format($ordencompdeta['orde_cant'], 0, ',', '.'); ?></td>
                    <td class="text-center"><?php echo number_format($ordencompdeta['orden_precio'], 0, ',', '.'); ?></td>
                    <td class="text-center"><?php echo number_format($ordencompdeta['detalle_ord_subt'], 0, ',', '.'); ?></td>
                    <td class="text-center"><?php echo $ordencompdeta['orden_estado']; ?></td>
                     <?php if ($compra['comp_estado'] == 'ACTIVO') { ?> 

                    <td class="text-center">

                        <a onclick="editarORDEN(<?php
                        echo "'" . $ordencompdeta['cod_ord_compra'] . "_" .
                        $ordencompdeta['cod_arti'] . "_" . $ordencompdeta['orde_cant'] .  "_" . $ordencompdeta['orden_precio'] ."'";
                        ?>);" 
                           class="btn btn-xs btn-primary" rel='tooltip' data-title="Confirmar" 
                           data-toggle="modal" data-target="#ordenconf">
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

</div>

                                        <!--IVA-->
                    
   <?php if (isset($_REQUEST['vdetcompra'])) { ?>
                        <?php $detacompras = consultas::get_datos("select * from v_compradet_iva where  cod_compra= " . $_REQUEST ['vdetcompra']); ?>

                    <?php } ?> 

                    <div class="panel-body">

                        <?php if (!empty($detacompras)) {
                            ?>   
                            <div class="panel-heading">
                                DETALLE DEL IVA
                            </div>
                            <!-- /.panel-heading -->

                            <div class="table-responsive">
                                <!--                                    <div>-->
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th class="text-center"> TOTAL IVA 5</th>
                                            <th class="text-center">TOTAL  IVA 10</th>
                                            <th class="text-center"> TOTAL EXENTA</th>
                                            <th class="text-center">TOTAL IVA</th>

                                        </tr>
                                    </thead>
                                    <tbody class="buscar">
                                        <?php foreach ($detacompras as $detacompra) { ?> 
                                            <tr>
                                                 <td class="text-center"><?php echo number_format($detacompra['total_iva5'], 0, ',', '.'); ?></td>
                                                 <td class="text-center"><?php echo number_format($detacompra['total_iva10'], 0, ',', '.'); ?></td>
                                                 <td class="text-center"><?php echo number_format($detacompra['total_exenta'], 0, ',', '.'); ?></td>
                                                 <td class="text-center"><?php echo number_format($detacompra['total_ivas'], 0, ',', '.'); ?></td>
                                  

                                            </tr>

                                        <?php } ?>
                                    </tbody>
                                </table>  

                            <?php } else { ?>

                            <?php } ?>

                        </div>
                    </div>

                    <!--IVA-->

                </div>
            </div>
        </div>          
                                         <!--confirmar-->

        <div id="ordenconf" class="modal fade" role="dialog">
            <div class="modal-dialog modal-lg ">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" 
                                data-dismiss="modal" arial-label="Close">x</button>
                        <h4 class="modal-title"><strong>REGISTRAR PRECIO </strong></h4>
                    </div>
                    <form action="compra_detalle_control.php" method="post" accept-charset="utf-8" class="form-horizontal">
                        <div class="panel-body">
                            <input name="accion" value="1" type="hidden"/>
                            <input type="hidden" name="pagina" value="compra_detalle.php">
                            <input type="hidden" name="vdetcompra" value="<?php echo $_REQUEST['vdetcompra'] ?>">
                            <input type="hidden" name="vped" value="<?php echo $_REQUEST['vped'] ?>">
                            <input type="hidden" name="vorden" value="<?php echo $_REQUEST['vorden'] ?>">
                            <input type="hidden" name="vestado" value="CONFIRMADO">
                            <input type="hidden"  id="art" name="varti" value="0">
                            <input type="hidden"  id="subtotal" name="vsubt" value="0">
                            <input type="hidden"  id="articuloocultoo" name="articuloocultoo" value="">

                            <span class="col-md-1"></span>
                            <div class="form-group">


                                <div class="col-md-5">
                                    <label class="col-md-2 control-label"><h3>ARTICULO</h3></label>
                                    <input  type="text" required="" readonly=""
                                            placeholder="Especifique articulo"
                                            class="form-control" id="arti"  name="varti">

                                </div>


                                <div class="col-md-3">
                                    <label class="col-md-2 control-label"><h3>Cantidad</h3></label>
                                    <input  id="cantid" type="number" required="" readonly=""
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

                                    <input   type="number" required="" readonly=""
                                             placeholder="Especifique precio"
                                             class="form-control"
                                             required min="100"  name="vprecio" id="preci"
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
                                     <!--            sino fin-->
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


    </div>

        <!--fin de confirmar-->
    <!--archivos js-->  
    <?php require 'menu/js.ctp'; ?>
<script>
  function editar(datos) {
            var dat = datos.split("_");
            $('#cod').val(dat[0]);
            $('#art').val(dat[1]);
            $('#canti').val(dat[2]);
            console.log(dat[2]);
        }
        function editarORDEN(datos) {
            var dat = datos.split("_");
            $('#codi').val(dat[0]);
            $('#arti').val(dat[1]);
            $('#cantid').val(dat[2]);
            $('#preci').val(dat[3]);
            console.log(dat[2]);
        }
        
        function borrar(datos) {
    var dat = datos.split("_");
    $('#si').attr('href',
        'compra_detalle_control.php?vdetcompra=' + dat[1] +
        '&vped=' + dat[2] +
        '&vorden=' + dat[3] +
        '&vdetcompra=' + dat[0] +
        '&varti=' + dat[4] +
        '&vcant=' + dat[5] +
        '&vprecio=' + dat[6] +
        '&vestado=' + dat[6] +
        '&accion=3' +
        '&pagina=compra_detalle.php');
    $('#confirmacion').html('<span class="glyphicon glyphicon-warning-sign"></span>\n\
        Desea borrar el detalle?');
}




</script>

</body>
</html>