<!DOCTYPE html>
<html>
    <head>
        <link rel="shortcut icon"  href=" img/blackbulls.ico"/>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <title>DETALLES NOTAS REMISION</title>

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
                        <h3 class="page-header">Datos de Nota de Remision
                            <a href="nota_remi_com.php" 
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
                                Datos Cabecera
                            </div>
                            <?php
                            $remisions = consultas::get_datos("select * from v_notaremisioncompras where cod_nota_remision=" .
                                            $_REQUEST ['vdetremi'] . " order by cod_nota_remision asc ");
                            if (!empty($remisions)) {
                            ?>                         
                            <!-- /.panel-heading -->
                            <div class="panel-body">
                                <div class="table-responsive">
                                    <table width="100%"
                                           class="table table-bordered">
                                        <thead>
                                            <tr class="primary-font">
                                                    <th class="text-center">#</th>                                       
                                                    <th class="text-center">USUARIOS</th>                                        
                                                    <th class="text-center">NRO. FACTURA</th>
                                                    <th class="text-center">NRO. REMISION</th>
                                                    <th class="text-center">PROVEEDOR</th>
                                                    <th class="text-center">FECHA</th>
                                                    <th class="text-center">MOTIVO</th>
                                                    <th class="text-center">CONDUCTOR</th>
                                                    <th class="text-center">FECHA SALIDA</th>
                                                    <th class="text-center">FECHA LLEGADA</th>
                                                    <th class="text-center">ESTADO</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($remisions as $remision) { ?> 
                                                <tr>
                                                  
                                                    <td class="text-center"><?php echo $remision['cod_nota_remision']; ?></td>
                                                        <td class="text-center"><?php echo $remision['usu_nick']; ?></td>
                                                        <td class="text-center"><?php echo $remision['cod_compra'] . "-" . $remision['fac_compra']; ?></td>
                                                        <td class="text-center"><?php echo $remision['remi_ref_factura']; ?></td>
                                                        <td class="text-center"><?php echo $remision['provee_nomb']; ?></td>
                                                        <td class="text-center"><?php echo $remision['remi_fecha']; ?></td>
                                                        <td class="text-center"><?php echo $remision['remi_motivo']; ?></td>
                                                        <td class="text-center"><?php echo $remision['remi_conductor']; ?></td>
                                                        <td class="text-center"><?php echo $remision['remi_fecha_salida']; ?></td>
                                                        <td class="text-center"><?php echo $remision['remi_fecha_llegada']; ?></td>
                                                        <td class="text-center"><?php echo $remision['remi_estado']; ?></td>
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
                                            <strong>Numero de nota de Remision repetido, favor verificar....!</strong>
                                        </div>
                                    </div>
                                <?php } ?> 
                        </div>

                        <!-- comienzo para el detalle de COMPRA-->
<!--
<?php
                        $detanotas = consultas::get_datos
                                        ("select * from  v_detalle_remision"
                                        . " where cod_nota_remision=" . $_REQUEST['vdetremi'] .
                                        "order by cod_nota_remision asc");
                        ?>


                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                DETALLE DE LA NOTA DE REMISION 
                            </div>
                            <?php if (!empty($detanotas)) { ?>
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th class="text-center">#</th>
                                                <th class="text-center"> ARTICULO</th>
                                                <th class="text-center"> CANTIDAD</th>
                                                <th class="text-center"> ESTADO</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($detanotas as $detanota) { ?>
                                                <tr>
                                                    <td class="text-center"><?php echo $detanota['cod_nota_remision']; ?></td>
                                                    <td class="text-center"><?php echo $detanota['arti_descrip']; ?></td>
                                                    <td class="text-center"><?php echo number_format($detanota['det_remi_det_cant'], 0, ',', '.'); ?></td>
                                                    <td class="text-center"><?php echo $detanota['det_estado']; ?></td>
                                                        
                                                    <th class="text-center">
                                                        <a onclick="borrar(<?php
                                                        echo "'" . $detanota['cod_nota_remision'] . "_" .
                                                                  $_REQUEST['vdetremi'] . "_" .
                                                                  $_REQUEST['vcompr'] . "_" .
                                                        $detanota['cod_arti'] . "_" .
                                                        $detanota['det_remi_det_cant'] . "_" .
                                                        $detanota['det_estado'] . "'";
                                                        ?>)"
                                                           class="btn btn-xs btn-danger"
                                                           ret='tooltip' data-title="Borrar"
                                                           data-toggle='modal'
                                                           data-target='#delete'>
                                                            <span class="glyphicon glyphicon-trash">
                                                            </span></a>
                                                    </th>

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
                                            <strong>No se encontraron detalles de la nota....!</strong>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                    </div>-->

                    <?php if (isset($_REQUEST['vcompr'])) { ?>
                        <?php $detacompras = consultas::get_datos("select * from v_compdetalle where cod_arti NOT IN(select cod_arti from detalle_nota_remi_compra)"
                                . "and  cod_compra= " . $_REQUEST ['vcompr']); ?>

                    <?php } ?> 

                    <div class="panel-body">

            <?php if (isset($remisions[0]['cod_nota_remision'])) { ?>

                <?php if (!empty($detacompras)) {
                    ?>   
                    <div class="panel-heading">
            
                            DETALLE DE LA COMPRA 
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
                             
                                </tr>
                            </thead>
                            <tbody class="buscar">
                                <?php foreach ($detacompras as $detacompra) { ?> 
                                    <tr>
                                    
                                            <td class="text-center"><?php echo $detacompra['cod_compra']; ?></td>
                                            <td class="text-center"><?php echo $detacompra['arti_descrip']; ?></td>
                                            
                                            <td class="text-center"><?php echo number_format($detacompra['det_comp_cant'], 0, ',', '.'); ?></td>
                                            
                                            <td class="text-center"><?php echo $detacompra['det_comp_estado']; ?></td>
                                        
                                    

                                        </td>
                                    </tr>

                                <?php } ?>
                            </tbody>
                        </table>  

                    <?php } else { ?>

                    <?php } ?>

                </div>
            <?php } else { ?>
            <?php } ?>

            <div id="editar" class="modal fade" role="dialog">
                            <div class="modal-dialog modal-lg ">
                                <!-- Modal content-->
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" 
                                                data-dismiss="modal" arial-label="Close">x</button>
                                        <h4 class="modal-title"><strong>REGISTRAR NOTA DE REMISION </strong></h4>
                                    </div>
                                    <form action="notaremision_det_control.php" method="post" accept-charset="utf-8" class="form-horizontal">
                                        <div class="panel-body">
                                            <input name="accion" value="1" type="hidden"/>
                                            <input type="hidden" name="pagina" value="notaremision_detalle.php">
                                            <input type="hidden" name="vdetremi" value="<?php echo $_REQUEST['vdetremi'] ?>">
                                            <input type="hidden" name="vcompr" value="<?php echo $_REQUEST['vcompr'] ?>">
                                            <input type="hidden" name="vestado" value="ACTIVO">
                                           <input type="hidden"  id="articod" name="varti" value="0">
                                            


                                            <span class="col-md-1"></span>
                                            <div class="form-group">

                                                <div class="col-md-5">
                                                    <label class="col-md-2 control-label"><h3>ARTICULO</h3></label>
                                                    <input  type="text" required="" readonly=""
                                                            placeholder="Especifique articulo"
                                                            class="form-control" id="art">

                                                </div>


                                                <div class="col-md-3">
                                                    <label class="col-md-2 control-label"><h3>Cantidad</h3></label>
                                                    <input  type="number" required="" 
                                                            placeholder="Especifique Cantidad"
                                                            class="form-control" id="cant" 
                                                            min="1" name="vcant"
                                                           
                                                            value ="0" >

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



        </div> 


        <!--archivos js-->  
        <?php require 'menu/js.ctp'; ?>
        <script>
            function notacredi(datos) {
                var dat = datos.split("_");
                $('#cod').val(dat[0]);
                $('#art').val(dat[1]);
                $('#depocod').val(dat[2]);
                $('#depo').val(dat[3]);
                $('#articod').val(dat[4]);
                $('#cant').val(dat[5]);
                $('#prec').val(dat[6]);
                calsubtotal();
            }

     

            function borrar(datos) {
                var dat = datos.split("_");
                $('#si').attr('href',
                        'notaremision_det_control.php?vdetremi=' + dat[1] +
                        '&vcompr=' + dat[2] +
                        '&varti=' + dat[3] +
                        
                        '&vcant=null'  +
                       
                        '&vestado=null' +
                       
                        '&accion=3' +
                        '&pagina=notaremision_detalle.php');
                $('#confirmacion').html
                        ('<span class="glyphicon glyphicon-warning-sign"></span>\n\
               Desea borrar el detalle?');
            }
                  function confirmar(datos) {
            var dat = datos.split("_");
            $('#si').attr('href',
                    'notaremision_det_control.php?vdetremi=' + dat[0] +
                    '&varti=' + dat[1] +
                 
                    '&vcant=' + dat[2] +
                 
                    '&vestado=ACTIVO'+
                    '&vcompr=' + dat[4] +
                    '&accion=1' +
                    '&pagina=notaremision_detalle.php');
            $('#confirmacion').html
                    ('<span class="glyphicon glyphicon-warning-sign"></span>\n\
               Desea confirmar este item del Detalle de Compra?');

        }


        </script>



    </body>
</html>
