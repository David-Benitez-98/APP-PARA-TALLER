<!DOCTYPE html>
<html>
    <head>
        <link rel="shortcut icon"  href=" img/blackbulls.ico"/>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <title>DETALLES NOTAS DEBITO</title>

        <?php
        require './session_start.php';
        require 'menu/css.ctp';
        ?>
    </head>
    <body>
        <div id="wrapper">
            <?php require 'menu/navbar.php'; ?><!--BARRA DE HERRAMIENTAS-->
            <div id="page-wrapper">
                <div class="row">
                    <!--impresion del titulo de la pagina-->
                    <div class="col-lg-12">
                        <h3 class="page-header">Datos de Nota de Debito
                            <a href="nota_debito.php" 
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
                            $debitos = consultas::get_datos("select * from v_notadebitocompra  where cod_nota_deb=" .
                                            $_REQUEST ['vdetdebi'] . " order by cod_nota_deb asc ");
                           if (!empty($debitos)) {
                            ?>  
                            
                            <!-- /.panel-heading -->
                            <div class="panel-body">
                                <div class="table-responsive">
                                    <table width="100%"
                                           class="table table-bordered">
                                        <thead>
                                            <tr class="primary-font">
                                                <th class="text-center">#</th>
                                                <th class="text-center"># COMPRA</th>                                        
                                                <th class="text-center">FECHA</th>                                        
                                                <th class="text-center">MOTIVO</th>                                        
                                                <th class="text-center">INTERES</th>                                        
                                                <th class="text-center">TRANSPORTE</th>                                        
                                                <th class="text-center">TOTAL</th>
                                                <th class="text-center">USUARIO</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($debitos as $debito) { ?> 
                                                <tr>
                                                    <td class="text-center">
                                                        <?php echo $debito['cod_nota_deb']; ?></td>
                                                    <td class="text-center"><?php echo $debito['cod_compra'] . " - " . $debito['fac_compra']; ?></td>
                                                    <td class="text-center"><?php echo $debito['debi_fecha']; ?></td>
                                                    <td class="text-center"><?php echo $debito['debi_moti']; ?></td>
                                                    <td class="text-center"><?php echo $debito['debi_interes']; ?></td>
                                                    <td class="text-center"><?php echo number_format($debito['debi_transporte'], 0, ',', '.'); ?></td>
                                                    <td class="text-center"><?php echo number_format($debito['debi_total'], 0, ',', '.'); ?></td>
                                                    <td class="text-center"><?php echo $debito['usu_nick']; ?></td>
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
                                            <strong>Numero de nota de debito repetido, favor verificar....!</strong>
                                        </div>
                                    </div>
                                <?php } ?> 
                        </div>

                        <!-- comienzo para el detalle de COMPRA-->

<!--                        <?php
                        $detanotas = consultas::get_datos
                                        ("select * from  v_notacreditocompradetalle"
                                        . " where cod_nota_comp=" . $_REQUEST['vdetdebi'] .
                                        "order by cod_nota_comp asc");
                        ?>


                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                DETALLE DE LA NOTA DE CREDITO 
                            </div>
                            <?php if (!empty($detanotas)) { ?>
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th class="text-center">#</th>
                                                <th class="text-center"> arti_descrip</th>
                                                <th class="text-center"> CANTIDAD</th>
                                                <th class="text-center"> PRECIO</th>
                                                <th class="text-center"> DEVOLUCION</th>
                                                <th class="text-center"> TOTAL DEVO.</th>
                                                <th class="text-center"> SOBRANTE</th>
                                                <th class="text-center"> SUBTOTAL</th>
                                                <th class="text-center"> IVA 5</th>
                                                <th class="text-center"> GRABADA 5</th>
                                                <th class="text-center"> IVA 10</th>
                                                <th class="text-center"> GRABADA 10</th>
                                                <th class="text-center"> ESTADO</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($detanotas as $detanota) { ?>
                                                <tr>
                                                    <td class="text-center"><?php echo $detanota['cod_nota_comp']; ?></td>
                                                    <td class="text-center"><?php echo $detanota['arti_descrip']; ?></td>
                                                    <td class="text-center"><?php echo number_format($detanota['det_not_cred_ptecio'], 0, ',', '.'); ?></td>
                                                    <td class="text-center"><?php echo number_format($detanota['det_not_cred_devolucion'], 0, ',', '.'); ?></td>
                                                    <td class="text-center"><?php echo number_format($detanota['det_nota_cred_subt'], 0, ',', '.'); ?></td>
                                                    <td class="text-center"><?php echo number_format($detanota['cant_total_sobrante'], 0, ',', '.'); ?></td>
                                                    <td class="text-center"><?php echo number_format($detanota['iva_5'], 0, ',', '.'); ?></td>
                                                    <td class="text-center"><?php echo number_format($detanota['gravada_5'], 0, ',', '.'); ?></td>
                                                    <td class="text-center"><?php echo number_format($detanota['iva_10'], 0, ',', '.'); ?></td>
                                                    <td class="text-center"><?php echo number_format($detanota['gravada_10'], 0, ',', '.'); ?></td>
                                                    <td class="text-center"><?php echo $detanota['det_nota_cred_estado']; ?></td>
                                                    <th class="text-center">
                                                        <a onclick="borrar(<?php
                                                        echo "'" . $detanota['id_nota_credito'] . "_" .
                                                                  $_REQUEST['vdetcred'] . "_" .
                                                                  $_REQUEST['vcompr'] . "_" .
                                                        $detanota['cod_arti'] . "_" .
                                                        $detanota['det_not_cred_ptecio'] . "_" .
                                                        $detanota['det_nota_cred_subt'] . "_" .
                                                        $detanota['det_not_cred_devolucion'] . "_" .
                                                        $detanota['det_nota_cred_estado'] . "_" .
                                                        $detanota['cant_total_sobrante'] . "'";
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
                    </div>

                    <?php if (isset($_REQUEST['vcompr'])) { ?>
                        <?php $detacompras = consultas::get_datos("select * from v_compdetalle where det_comp_estado='CONFIRMADO' and cod_compra= " . $_REQUEST ['vcompr']); ?>

                    <?php } ?> 


                    <div class="panel-body">


                        <?php if ($debito['debi_estado'] == 'ACTIVO') { ?> 
                            <?php if (!empty($detacompras)) {
                                ?>   
                                <div class="panel-heading">
                                    <?php if ($debito['debi_moti'] == 'DEVOLUCION') { ?>
                                        DETALLE DE LA COMPRA 
                                    </div>
                                     /.panel-heading 

                                    <div class="table-responsive">
                                                                            <div>
                                        <table class="table table-striped">
                                            <thead>
                                                <tr>
                                                    <th class="text-center">#</th>
                                                    <th class="text-center"> arti_descrip</th>
                                                    <th class="text-center"> DEPOSITO</th>
                                                    <th class="text-center"> CANTIDAD</th>
                                                    <th class="text-center"> PRECIO</th>
                                                    <th class="text-center"> SUBTOTAL</th>
                                                    <th class="text-center"> ESTADO</th>

                                                    <th class="text-center"> ACCION</th>


                                                <?php } else { ?>
                                                <?php } ?>
                                            </tr>
                                        </thead>
                                        <tbody class="buscar">
                                            <?php foreach ($detacompras as $detacompra) { ?> 
                                                <tr>
                                                    <?php if ($debito['debi_mot'] == 'DEVOLUCION') { ?>
                                                        <td class="text-center"><?php echo $detacompra['cod_compra']; ?></td>
                                                        <td class="text-center"><?php echo $detacompra['arti_descrip']; ?></td>
                                                        <td class="text-center"><?php echo number_format($detacompra['det_comp_cant'], 0, ',', '.'); ?></td>
                                                        <td class="text-center"><?php echo number_format($detacompra['det_comp_precio'], 0, ',', '.'); ?></td>
                                                        <td class="text-center"><?php echo number_format($detacompra['det_comp_subt'], 0, ',', '.'); ?></td>
                                                        <td class="text-center"><?php echo $detacompra['det_comp_estado']; ?></td>
                                                        <td class="text-center">
                                                            <?php if ($debito['debi_estado'] == 'ACTIVO') { ?>  
                                                                <a onclick="notacredi(<?php
                                                                echo "'" . $detacompra['cod_compra'] . "_" . $detacompra['arti_descrip'] . "_" .
                                                                $detacompra['arti_descrip'] . "_" . $detacompra['det_comp_cant'] . "_" . $detacompra['det_comp_precio'] . "'";
                                                                ?>);" 
                                                                   class="btn btn-xs btn-primary" rel='tooltip' data-title="Confirmar" 
                                                                   data-toggle="modal" data-target="#editar">
                                                                    <span class="glyphicon glyphicon-ok-sign"></span></a>
                                                                    
                                                                        <a onclick="confirmar(<?php
                                                        echo "'" . $_REQUEST['vdetcred'] . "_" .
                                                        $detacompra['arti_descrip'] . "_" .
                                                        $detacompra['det_comp_precio'] . "_" .
                                                        $detacompra['det_comp_cant'] . "_" .
                                                        $detacompra['det_comp_subt'] . "_" .
                                                        $detacompra['det_comp_estado'] . "_" .
                                                        $_REQUEST ['vcompr'] . "'"
                                                        ?>)"
                                                           class="btn btn-xs btn-danger" rel='tooltip' data-title="RECHAZAR"
                                                           data-toggle="modal"
                                                           data-target="#delete">
                                                            <span class="glyphicon glyphicon-remove-sign"></span></a>
                                                       
                                                                    
                                                            <?php } else { ?>
                                                            <?php } ?>


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
                        <?php } else { ?>
                        <?php } ?>


                        <?php if (isset($_REQUEST['vdetcred'])) { ?>
                            <?php $detanotas = consultas::get_datos("select * from v_nota_cre_compdet_iva where  cod_nota_comp= " . $_REQUEST ['vdetcred']); ?>

                        <?php } ?> 

                        <div class="panel-body">

                            <?php if (!empty($detanotas)) {
                                ?>   
                                <div class="panel-heading">
                                    DETALLE DEL IVA
                                </div>
                                 /.panel-heading 

                                <div class="table-responsive">
                                                                        <div>
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
                                            <?php foreach ($detanotas as $detanota) { ?> 
                                                <tr>
                                                    <td class="text-center"><?php echo number_format($detanota['total_iva5'], 0, ',', '.'); ?></td>
                                                    <td class="text-center"><?php echo number_format($detanota['total_iva10'], 0, ',', '.'); ?></td>
                                                    <td class="text-center"><?php echo number_format($detanota['total_exenta'], 0, ',', '.'); ?></td>
                                                    <td class="text-center"><?php echo number_format($detanota['total_ivas'], 0, ',', '.'); ?></td>


                                                </tr>

                                            <?php } ?>
                                        </tbody>
                                    </table>  

                                <?php } else { ?>

                                <?php } ?>

                            </div>
                        </div>-->


                        <div id="editar" class="modal fade" role="dialog">
                            <div class="modal-dialog modal-lg ">
                                <!-- Modal content-->
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" 
                                                data-dismiss="modal" arial-label="Close">x</button>
                                        <h4 class="modal-title"><strong>REGISTRAR NOTA DE CREDITO </strong></h4>
                                    </div>
                                    <form action="notacred_det_control.php" method="post" accept-charset="utf-8" class="form-horizontal">
                                        <div class="panel-body">
                                            <input name="accion" value="1" type="hidden"/>
                                            <input type="hidden" name="pagina" value="notcredito_detalle.php">
                                            <input type="hidden" name="vdetcred" value="<?php echo $_REQUEST['vdetcred'] ?>">
                                            <input type="hidden" name="vcompr" value="<?php echo $_REQUEST['vcompr'] ?>">
                                            <input type="hidden" name="vestado" value="ACTIVO">
                                            <input type="hidden"  id="subtotal" name="vsubt" value="0">
                                            <input type="hidden"  id="articod" name="varti" value="0">
                                            <input type="hidden"  id="depocod" name="vdepo" value="0">


                                            <span class="col-md-1"></span>
                                            <div class="form-group">

                                                <div class="col-md-5">
                                                    <label class="col-md-2 control-label"><h3>arti_descrip</h3></label>
                                                    <input  type="text" required="" readonly=""
                                                            placeholder="Especifique arti_descrip"
                                                            class="form-control" id="art">

                                                </div>

                                             

                                                <br>


                                            </div>
                                            <BR>
                                            <span class="col-md-1"></span>
                                            <div class="form-group">
                                                <div class="col-md-5"> 
                                                    <label class="col-md-2 control-label"><h3>PRECIO:</h3></label>
                                                    <input   type="number" required=""readonly=""
                                                             placeholder="Especifique precio"
                                                             class="form-control" id="prec"
                                                             min="100"  name="vprecio"
                                                             value="0">
                                                </div>





                                                <div class="col-md-3">
                                                    <label class="col-md-2 control-label"><h3>Cantidad</h3></label>
                                                    <input  type="number" required="" readonly=""
                                                            placeholder="Especifique Cantidad"
                                                            class="form-control" id="cant" 
                                                            min="1" name="vcant"
                                                            onchange="calsubtotal(), stock()"
                                                            onkeyup="calsubtotal(), stock()"

                                                            value ="0" >

                                                </div>


                                            </div>

                                            <div class="form-group">
                                                <span class="col-md-1"></span>

                                                <div class="col-md-5">
                                                    <label class="col-md-2 control-label"><h3>DEVOLUCION</h3></label>
                                                    <input   type="number" required=""
                                                             placeholder="Especifique devolucion"
                                                             class="form-control"  
                                                             required  id="devolu"
                                                             onchange="calsubtotal(), stock()"
                                                             onkeyup="calsubtotal(), stock()"
                                                             onmouseup="calsubtotal()"

                                                             name="vdevol"
                                                             value="0" >

                                                </div>

                                                <div class="col-md-5">
                                                    <label class="col-md-2 control-label"><h3>TOTAL</h3></label>
                                                    <input   type="number" required=""
                                                             placeholder="Especifique devolucion"
                                                             class="form-control" min="1" 
                                                             required  name="vsobrante" readonly=""

                                                             value="0"  id="total">

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

            function calsubtotal() {
                $('#total').val(parseInt($('#cant').val()) - parseInt($('#devolu').val()));
            }


            function stock() {
                var cant = parseInt($('#cant').val());
                if (cant > 0) {
                    if (parseInt($('#devolu').val()) > cant) {
                        alert('SOLO HAY ' + cant +
                                ' EN ESTA NOTA DE CREDITO');
                        $('#devolu').val(cant);

                    }
                } else {
                    $('#devolu').val('0');
                    {
                        alert('ESTA VACIO ');
                    }

                }
            }


            $("document").ready(function () {
                calsubtotal;
            });


            function borrar(datos) {
                var dat = datos.split("_");
                $('#si').attr('href',
                        'notacred_det_control.php?vdetcred=' + dat[1] +
                        '&vcompr=' + dat[2] +
                        '&varti=' + dat[3] +
                        '&vprecio=null' +
                        '&vcant=null'  +
                        '&vdevol=null' +
                        '&vestado=null' +
                        '&vsobrante=null'+
                        '&accion=3' +
                        '&pagina=notcredito_detalle.php');
                $('#confirmacion').html
                        ('<span class="glyphicon glyphicon-warning-sign"></span>\n\
               Desea borrar el detalle?');
            }
                  function confirmar(datos) {
            var dat = datos.split("_");
            $('#si').attr('href',
                    'notacred_det_control.php?vdetcred=' + dat[0] +
                    '&varti=' + dat[1] +
                    '&vdepo=' + dat[2] +
                    '&vprecio=' + dat[3] +
                    '&vcant=' + dat[4] +
                    '&vdevol=0'+ 
                    '&vsobrante=' + dat[4] +
                    '&vestado=ACTIVO'+
                    '&vcompr=' + dat[7] +
                    '&accion=1' +
                    '&pagina=notcredito_detalle.php');
            $('#confirmacion').html
                    ('<span class="glyphicon glyphicon-warning-sign"></span>\n\
                No desea devolver este item del Detalle de Compra?');

        }


        </script>



    </body>
</html>
s