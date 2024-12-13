<!DOCTYPE html>
<html>
    <head>
        <link rel="shortcut icon"  href=" images/mauro"/>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <title>DETALLE PEDIDOS</title>

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
                        <h3 class="page-header">DATOS DE PEDIDO 
                            <a href="pedido_index.php" 
                               class="btn btn-primary btn-circle pull-right" 
                               rel='tooltip' title="Atras">
                                <i class="glyphicon glyphicon-arrow-left"></i>
                            </a> 

                        </h3>
                    </div>     
                    <!--Buscador-->

                </div>
                <!-- /.row -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                CABECERA
                            </div>


                            <?php
                            $pedidos = consultas::get_datos("select * from  v_pedido"
                                            . " where cod_pedido_com =" . $_REQUEST['vdetped'] .
                                            "order by cod_pedido_com asc");
                            ?>                         
                            <!-- /.panel-heading -->
                            <div class="panel-body">
                                <div class="table-responsive">
                                    <table width="100%"
                                           class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th class="text-center">#</th>
                                                <th class="text-center">FECHA</th>                                        
                                                <th class="text-center">ESTADO</th>                                                                               
                                                <th class="text-center">USUARIO</th> 
                                            </tr>
                                        </thead>

                                        <?php foreach ($pedidos as $pedido) { ?> 
                                            <tr>
                                                <td class="text-center"><?php echo $pedido['cod_pedido_com']; ?></td>
                                                <td class="text-center"><?php echo $pedido['fecha_pedi']; ?></td>
                                                <td class="text-center"><?php echo $pedido['ped_estado']; ?></td>
                                                <td class="text-center"><?php echo $pedido['usu_nick']; ?></td>

                                            </tr>

                                            </tr>
                                        <?php } ?>
                                        </tbody>
                                    </table>                         
                                </div>
                            </div>
                        </div>
                        <!-- comienzo para el detalle-->
                        <?php
                        $pedidosdetas = consultas::get_datos
                                        ("select * from  v_pedidodetalle"
                                        . " where cod_pedido_com=" . $_REQUEST['vdetped'] .
                                        "order by cod_pedido_com asc");
                        ?>
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                Detalle de Pedido
                            </div>
                            <?php if (!empty($pedidosdetas)) { ?>
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th class="text-center">#</th>
                                                <th class="text-center"> ARTICULO</th>
                                                <th class="text-center"> CANTIDAD</th>
                                                <th class="text-center"> ESTADO</th>
                                                <?php if ($pedido['ped_estado'] == 'ACTIVO' || ($pedido['ped_estado'] == 'PENDIENTE')) { ?>  
                                                <?php } else { ?>
                                                    <th class="text-center"> ACCION</th>

                                                <?php } ?>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($pedidosdetas as $pedidosdeta) { ?>
                                                <tr>
                                                    <td class="text-center"><?php echo $pedidosdeta['cod_pedido_com']; ?></td>
                                                    <td class="text-center"><?php echo $pedidosdeta['arti_descrip']; ?></td>
                                                    <td class="text-center"><?php echo $pedidosdeta['ped_cant']; ?></td>
                                                    <td class="text-center"><?php echo $pedidosdeta['ped_estado']; ?></td>
                                                    <?php if ($pedido['ped_estado'] == 'ACTIVO' || ($pedido['ped_estado'] == 'PENDIENTE')) { ?>  
                                                    <?php } else { ?>
                                                        <td class="text-center">
                                                            <a onclick="borrar(<?php
                                                            echo "'" . $pedidosdeta['cod_pedido_com'] . "_" .
                                                            $_REQUEST['vdetped'] . "_" .
                                                            $pedidosdeta['cod_arti'] . "_" .
                                                            $pedidosdeta['ped_cant'] . "_" .
                                                            $pedidosdeta['ped_estado'] . "'";
                                                            ?>)"
                                                               class="btn btn-xs btn-danger"
                                                               ret='tooltip' data-title="Borrar"
                                                               data-toggle='modal'
                                                               data-target='#delete'>
                                                                <span class="glyphicon glyphicon-trash">
                                                                </span></a>

                                                        <?php } ?>
                                                    </td>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                <?php } else { ?>
                                    <div class="col-md-12">
                                        <div class="alert alert-info
                                             alert-dismissable">
                                            <button type="button" class="close"
                                                    data-dismiss="alert" aria-hideden="true">&times;
                                            </button>
                                            <strong>No se encontraron detalles para el pedido....!</strong>
                                        </div>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>

                        <div class="col-lg-12">
                            <?php if ($pedido['ped_estado'] == 'REGISTRADO') { ?>  


                                <div class="panel-body">

                                    <form action="pedido_detalle_control.php" method="get"
                                          role="form" class="form-horizontal">
                                        <input type="hidden" name="accion" value="1">
                                        <input type="hidden" name="vdetped"
                                               value="<?php echo $_REQUEST['vdetped'] ?>">
                                        <input type="hidden" name="vestado" value="PENDIENTE">
                                        <input type="hidden" name="pagina"
                                               value="pedido_detalle_agregar.php">

                                        <div class="form-group">
                                            <label class="col-md-2 control-label">ARTICULO:</label>
                                            <div class="col-md-4">
                                                <?php
                                                $articulos = consultas::get_datos("select * from v_articulo "
                                                                . " order by cod_arti");
                                                ?>                                 
                                                <select name="varti" required="" class="form-control select2">
                                                    <option value="">Seleccione un articulo</option>
                                                    <?php
                                                    if (!empty($articulos)) {
                                                        foreach ($articulos as $articulo) {
                                                            ?>
                                                            <option value="<?php echo $articulo['cod_arti']; ?>">
                                                                <?php echo $articulo['arti_descrip']; ?></option>
                                                            <?php
                                                        }
                                                    } else {
                                                        ?>

                                                    <?php } ?>
                                                </select>
                                            </div>   


                                            <label class="col-md-2 control-label">Cantidad:</label>
                                            <div class="col-md-4">
                                                <input type="number" required=""
                                                       placeholder="Especifique Cantidad"
                                                       class="form-control"
                                                       required min="1"  name="vcant"
                                                       value="0"
                                                       >

                                            </div>


                                        </div>

                                        <br>
                                        <div class="form-group">
                                            <div class="col-md-offset-5 col-md-10">
                                                <button class="btn btn-success"
                                                        type="submi"><i class=" fa fa-floppy-o">
                                                    </i>Grabar</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            <?php } else { ?>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>


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
        <!--archivos js-->  
        <?php require 'menu/js.ctp'; ?>


        <script>


            function borrar(datos) {
                var dat = datos.split("_");
                $('#si').attr('href',
                        'pedido_detalle_control.php?vdetped=' + dat[1] +
                        '&varti=' + dat[2] +
                        '&vcant=' + dat[3] +
                        '&vestado=' + dat[4] +
                        '&accion=3' +
                        '&pagina=pedido_detalle_agregar.php');
                $('#confirmacion').html
                        ('<span class="glyphicon glyphicon-warning-sign"></span>\n\
               Desea borrar el detalle?');
            }
        </script>




    </body>
</html>
