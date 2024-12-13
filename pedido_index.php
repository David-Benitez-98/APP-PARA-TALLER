<!DOCTYPE html>
<html>
    <head>
        <link rel="shortcut icon"  href=" images/mauro"/>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <title>PEDIDOS</title>

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
                        <h3 class="page-header">LISTADO DE PEDIDO 

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
                            $pedidos = consultas::get_datos("select * from v_pedido "
                                         . " where cod_usu=".$_SESSION['cod_usu']. " order by cod_pedido_com asc ");
                            if (!empty($pedidos)) {
                                ?>                         
                                <!-- /.panel-heading -->
                                <div class="panel-body">
                                    <div>
                                        <table id="example1" width="100%" class="table table-striped table-bordered table-hover">
                                            <thead>
                                                <tr>
                                                    <th class="text-center">#</th>
                                                    <th class="text-center">FECHA</th>                                        
                                                    <th class="text-center">ESTADO</th>                                                                              
                                                    <th class="text-center">USUARIO</th>                                      
                                                    <th class="text-center">ACCIONES</th>
                                                </tr>
                                            </thead>
                                            <tbody class="buscar">
                                                <?php foreach ($pedidos as $pedido) { ?> 
                                                    <tr>
                                                        <td class="text-center"><?php echo $pedido['cod_pedido_com']; ?></td>
                                                        <td class="text-center"><?php echo $pedido['fecha_pedi']; ?></td>
                                                        <td class="text-center"><?php echo $pedido['ped_estado']; ?></td>
                                                        <td class="text-center"><?php echo $pedido['usu_nick']; ?></td>
                                                        <td class="text-center">
                                                                  <?php if ($pedido['ped_estado'] == 'REGISTRADO') { ?>  
                                                            <a onclick="confirmar(<?php
                                                        echo "'" .$pedido['cod_pedido_com'] . "_" .
//                                                              $compra['cod_ord_compra'] . "_" .
//                                                                  $compra['cod_pedido_com'] . "_" .
                                                                $pedido['ped_estado'] ."'"
                                                        ?>)"
                                                           class="btn btn-xs btn-primary" rel='tooltip' data-title="Confirmar"
                                                           data-toggle="modal"
                                                           data-target="#delete">
                                                            <span class="glyphicon glyphicon-ok-sign"></span></a>
                                                             <a  
                                                                href="pedido_detalle_agregar.php?vdetped=<?php echo $pedido['cod_pedido_com']; ?>"
                                                                class="btn btn-xs btn-primary" rel='tooltip' data-title="Detalles" >
                                                                <span class="fa fa-th-list"></span></a>
                                                                
                                                                
                                                                 <a href="imprimir_pedido.php?vcod=<?php echo $pedido['cod_pedido_com']; ?>"
                                                            target="_blank"
                                                            class="btn btn-xs btn-success"
                                                            rel="tooltip" data-title="imprimir">
                                                                <span class="glyphicon glyphicon-print"></span></a>
                                                        
                                                                <a onclick="borrar(<?php
                                                            echo "'" . $pedido['cod_pedido_com'] . "_" .
                                                            $pedido['fecha_pedi'] . "_" . $pedido['ped_estado'] . "_" .
                                                            $pedido['cod_usu'] . "'";
                                                            ?>)"
                                                               class="btn btn-xs btn-primary" rel='tooltip' data-title="Borrar"
                                                               data-toggle="modal"
                                                               data-target="#delete">
                                                                <span class="glyphicon glyphicon-trash"></span></a>
                                                                   <?php } else { ?>
                                                                     <a  
                                                                href="pedido_detalle_agregar.php?vdetped=<?php echo $pedido['cod_pedido_com']; ?>"
                                                                class="btn btn-xs btn-primary" rel='tooltip' data-title="Detalles" >
                                                                <span class="fa fa-th-list"></span></a>
                                                                
                                                                
                                                                 <a href="imprimir_pedido.php?vcod=<?php echo $pedido['cod_pedido_com']; ?>"
                                                            target="_blank"
                                                            class="btn btn-xs btn-success"
                                                            rel="tooltip" data-title="imprimir">
                                                                <span class="glyphicon glyphicon-print"></span></a>
                                                            
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
                    <div class=" modal-dialog  ">
                        <!-- Modal content-->
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" 
                                        data-dismiss="modal" arial-label="Close">x</button>
                                <h4 class="modal-title"><strong>REGISTRAR PEDIDO</strong></h4>
                            </div>
                           <?php $fecha = consultas::get_datos("select * from v_fecha"); ?>
                            <form action="pedido_control.php" method="post" accept-charset="utf-8" class="form-horizontal">
                                <div class="panel-body ">
                                    <input type="hidden" name="accion"  value="1">
                                    <input type="hidden" name="vpedido" value="0"/> 
                                    <input type="hidden" name="vusuario" 
                                           value="<?php echo $_SESSION['cod_usu']; ?>">
                                    <input type="hidden" name="vestado" value="REGISTRADO">
                                    <input type="hidden" name="pagina" value="pedido_detalle_agregar.php">
                                    <span class=" col-md-1"></span>

                                    <div class="form-group">
                                        <div class="col-md-4 " >
                                            <label  class="control-label col-md-2"><h3>FECHA</h3></label>


                                            <input type="date" required="" placeholder="Ingrese fecha" readonly=""
                                                   class="form-control" name="vfecha" value="<?php echo $fecha[0]['fecha'] ?>">
                                        </div>
                                        <div class="col-md-4 " >
                                            <label  class="control-label col-md-2"><h3>USUARIO</h3></label>
                                            <input type="text" required="" placeholder="Ingrese fecha" readonly=""
                                                   class="form-control" value="<?php echo $_SESSION['usu_nick'] ?>">
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


                function borrar(datos) {
                    var dat = datos.split("_");
                    $('#si').attr('href', 'pedido_control.php?vpedido=' + dat[0] + '&vfecha=' + dat[1]
                            + '&vestado=' + dat[2] + '&vusuario=' + dat[3] + '&accion=3&pagina=pedido_index.php');
                    $('#confirmacion').html('<span class="glyphicon glyphicon-warning-sign"></span>\n\
                Desea Borrar el pedido <i><strong>' + dat[0] + '</strong></i>?');
                }
                
                         function confirmar(datos) {
            var dat = datos.split("_");
            $('#si').attr('href',
                    'pedido_control.php?vpedido=' + dat[0] +
                     '&vfecha=1900-01-01'  +
                   '&vestado=PENDIENTE'  +
                     '&vusuario=null' +
                    '&accion=4' +
                    '&pagina=pedido_index.php');
              $('#confirmacion').html('<span class="glyphicon glyphicon-warning-sign"></span>\n\
                Desea confirmar el pedido?');
        }
            </script>


    </body>
</html>