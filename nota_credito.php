<!DOCTYPE html>
<html>
    <head>
        <link rel="shortcut icon"  href=" img/blackbulls.ico"/>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <title>NOTAS DE CREDITOS</title>

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
                        <h3 class="page-header">Listado de Nota de Credito

                            <a data-toggle="modal" data-target="#registrar" 
                               class="btn btn-primary btn-circle pull-right" 
                               rel="tooltip" data-title="Registrar" >
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
                            $creditos = consultas::get_datos("SELECT * FROM v_notacreditocompra ORDER BY cod_nota_comp ASC"
                        );
                            if (!empty($creditos)) {
                                ?>                         
                                <!-- /.panel-heading -->
                                <div class="panel-body">
                                    <div>
                                        <table id="example1" width="100%" class="table table-striped table-bordered table-hover">
                                            <thead>
                                                <tr>
                                                    <th class="text-center">#</th>                                      
                                                    <th class="text-center">USUARIOS</th>                                        
                                                    <th class="text-center">NRO. FACTURA</th>
                                                    <th class="text-center">PROVEEDOR</th>
                                                    <th class="text-center">NRO.CREDITO</th>
                                                    <th class="text-center">FECHA</th>
                                                    <th class="text-center">MOTIVO</th>
                                                    <th class="text-center">MOT. DESCRIP</th>
                                                    <th class="text-center">DESCUENTO</th>
                                                    <th class="text-center">TOTAL</th>
                                                    <th class="text-center">ESTADO</th>
                                                    <th class="text-center">ACCIONES</th>
                                                </tr>
                                            </thead>
                                            <tbody class="buscar">
                                                <?php foreach ($creditos as $credito) { ?> 
                                                    <tr>
                                                        <td class="text-center"><?php echo $credito['cod_nota_comp']; ?></td>
                                                        <td class="text-center"><?php echo $credito['usu_nick']; ?></td>
                                                        <td class="text-center"><?php echo $credito['cod_compra'] . "-" . $credito['fac_compra']; ?></td>
                                                        <td class="text-center"><?php echo $credito['provee_nomb']; ?></td>
                                                        <td class="text-center"><?php echo $credito['nro_nota_cred']; ?></td>
                                                        <td class="text-center"><?php echo $credito['nota_cred_fecha']; ?></td>
                                                        <td class="text-center"><?php echo $credito['cred_moti']; ?></td>
                                                        <td class="text-center"><?php echo $credito['cred_descrip']; ?></td>
                                                        <td class="text-center"><?php echo $credito['cred_descuento']; ?></td>
                                                        <td class="text-center"><?php echo number_format($credito['credi_total'], 0, ',', '.'); ?></td>

                                                        <td class="text-center"><?php echo $credito['nota_cred_estado']; ?></td>
                                                        <td class="text-center">
                                                              <?php if ($credito['nota_cred_estado'] == 'ANULADO') { ?> 
                                                            <a  
                                                                href="notcredito_detalle_1.php?vdetcred=<?php echo $credito['cod_nota_comp']; ?>&vcompr=<?php echo $credito['cod_compra']; ?>"
                                                                class="btn btn-xs btn-primary" rel='tooltip' data-title="Detalles" >
                                                                <span class="fa fa-th-list"></span></a>
                                                                 <?php } else { ?>
                                                            
                                                            <a  
                                                                href="notcredito_detalle.php?vdetcred=<?php echo $credito['cod_nota_comp']; ?>&vcompr=<?php echo $credito['cod_compra']; ?>"
                                                                class="btn btn-xs btn-primary" rel='tooltip' data-title="Detalles" >
                                                                <span class="fa fa-th-list"></span></a>
                                                                    <?php } ?>
                                                            <a href="imprimir_notacredito.php?vcod=<?php echo $credito['cod_nota_comp']; ?>"
                                                               target="_blank"
                                                               class="btn btn-xs btn-success"
                                                               rel="tooltip" data-title="imprimir">
                                                                <span class="glyphicon glyphicon-print"></span></a>
                                                            <?php if ($credito['nota_cred_estado'] == 'ACTIVO') { ?>  
                                                                <a onclick="anular(<?php
                                                                echo "'" . $credito['cod_nota_comp'] . "_" .
//                                                                $credito['cod_usu'] . "_" .
//                                                                $credito['cod_compra'] . "_" .
//                                                                $credito['provee_nomb'] . "_" .
//                                                                $credito['cod_tipo_comprobante'] . "_" .
//                                                                $credito['fecha_nota_cred'] . "_" .
//                                                                $credito['cred_moti'] . "_" .
//                                                                $credito['cred_descrip'] . "_" .
//                                                                $credito['cred_descuento'] . "_" .
//                                                                $credito['nota_cred_estado'] . "_" .
//                                                                $credito['credi_total'] . "_" .
//                                                                $credito['fecha_nota_cred'] . "_" .
//                                                                $credito['timb_nro'] . "_" .
                                                                $credito['nota_cred_estado'] . "'";
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
                    <div class="modal-dialog modal-lg">
                        <!-- Modal content-->
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" 
                                        data-dismiss="modal" arial-label="Close">x</button>
                                <h4 class="modal-title"><strong>REGISTRAR NOTA CREDITO</strong></h4>
                            </div>
                            <?php $fecha = consultas::get_datos("select * from v_fecha"); ?>
                            <form action="nota_credito_control.php" method="post" accept-charset="utf-8" class="form-horizontal">
                                <div class="panel-body se">
                                    <input type="hidden" name="accion"  value="1">
                                    <input type="hidden" name="vcred" value="0"/> 
                                    <input type="hidden" name="vusu" 
                                           value="<?php echo $_SESSION['cod_usu']; ?>">
                                    <input type="hidden" name="vestado" value="ACTIVO">
                                    <input type="hidden" name="vfechasis" value="<?php echo $fecha[0]['fecha'] ?>">
                                    <input type="hidden" name="pagina" value="notcredito_detalle.php">
                                    <span class="col-md-1"></span>
                                    
                                    <div class="form-group">
                                        <div class="col-md-3 " >
                                            <label  class="control-label col-md-2"><h3>FECHA</h3></label>
                                            <input type="date" required="" placeholder="Ingrese fecha" id="desde"
                                                   class="form-control" name="vfecha" value="<?php echo $fecha[0]['fecha'] ?>">
                                        </div>
                                        <div class="col-md-3 " >
                                            <label  class="control-label col-md-1"><h3>VIGENCIA</h3></label>
                                            <input type="date" required="" placeholder="Ingrese fecha" id="hasta"  onchange="validarvigencia()"
                                                   class="form-control" name="vvigen" value="<?php echo $fecha[0]['fecha'] ?>">
                                        </div>

                                      
                                    </div>

                                    <span class="col-md-1"></span>

                                    <div class="form-group">
                                        <div class="col-md-4" >
                                            <label  class="control-label col-md-2"><h3>COMPRA:</h3></label>
                                            <select  required="" class="form-control"   name="vcompr" id="compra" 
                                                     onchange="proveedor(), costo()"
                                                     onkeyup="proveedor(), costo()"> 
                                                <!--                                                <option  value="0">Seleccione una compra</option>-->

                                                <?php
                                                $compras = consultas::get_datos("SELECT * FROM v_compras WHERE cod_compra NOT IN (SELECT cod_compra FROM nota_credi_comp WHERE nota_cred_estado != 'ANULADO') "
                                                . "AND cod_compra NOT IN (SELECT cod_compra FROM nota_debi_compra WHERE debi_estado != 'ANULADO') "
                                                . "AND comp_estado = 'CONFIRMADO' "
                                                . "ORDER BY cod_compra"
                                                );
                                                ?> 
                                                <?php
                                                if (!empty($compras)) {
                                                    foreach ($compras as $compra) {
                                                        ?>
                                                        <option  value="<?php echo $compra['cod_compra']; ?>">
                                                            <?php echo $compra['cod_compra'] . " - " . $compra['fac_compra'] . " - " . $compra['total_comp']; ?></option>
                                                        <?php
                                                    }
                                                } else {
                                                    ?>
                                                    <option value="0">No hay facturas compras confirmadas</option>
                                                <?php } ?>
                                            </select>
                                        </div>

                                        <div class="col-md-3">
                                            <label control-label class="col-md-3 "><h3>TIPO</h3></label>
                                            <select required="" name="vtip" class="form-control select"  >
                                                <?php
                                                $tipocomprobantess = consultas::get_datos("select * from tipo_comrprobante where cod_tipo_comprobante = 3"
                                                                . " order by descrip_tip_com");
                                                ?>                                 

                                                <?php
                                                if (!empty($tipocomprobantess)) {
                                                    foreach ($tipocomprobantess as $tipocomprobantes) {
                                                        ?>
                                                        <option  value="<?php echo $tipocomprobantes['cod_tipo_comprobante']; ?>">
                                                            <?php echo $tipocomprobantes['descrip_tip_com']; ?> </option>
                                                        <?php
                                                    }
                                                } else {
                                                    ?>
                                                    <option value="">Debe insertar un tipo de comprobante</option>
                                                <?php } ?>
                                            </select>
                                        </div> 

                                        <div class="col-md-3">
                                            <label  class="control-label col-md-3"><h3>PROVEEDOR</h3></label>
                                            <select class="form-control"  required="" name="vprov" id="detalles" >
                                                <option  value="0">Seleccione un proveedor</option>
                                                <?php $proveedors = consultas::get_datos("select * from proveedor "); ?> 
                                                <?php foreach ($proveedors as $proveedor) { ?>
                                                    <option value="<?php echo $proveedor['cod_provee']; ?>"><?php echo $proveedor['provee_nomb']; ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                        </div>
                                    <br>
                                    <span class="col-md-1"></span>
                                    <div class="form-group">
                                        <div class="col-md-3">
                                            <label  class="control-label col-md-2"><h3>TIMBRADO</h3></label>

                                            <input type="text" required=""
                                                   placeholder="Especifique Cantidad"
                                                   class="form-control"
                                                   name="vtimb" id="timbrad"
                                                   onchange="solo_timbrado()" onkeyup="solo_timbrado()"
                                                   pattern="[0-9]{8,8}"title="SOLO SE PERMITEN 8 DIGITOS" autofocus="">

                                        </div>

                                        <span class="col-md-1"></span>
                                        <div class="col-md-3">
                                                        <label  class="control-label col-md-2"><h3>CREDITO</h3></label>

                                            <input type="text" required=""
                                                   placeholder="Numero de Nota credito"
                                                   class="form-control"
                                                   name="vnrocredi" id="credi"value="000-000-0000000"
                                                   onchange="solo_credi()" onkeyup="solo_credi()"
                                                   pattern="[0-9--]{15,15}"title="SOLO SE PERMITEN 15 DIGITOS" autofocus="">

                                        </div>
                                       
                                        <BR>
                                        <BR>
                                        <BR>
                                        
                                        <div class="row">
                                            <div seclass="radio col-md-12">
                                                <label class="col-md-2 control-label" >MOTIVO:</label>

                                                <input  required="" type="radio"  name="vmotiv"  value="DEVOLUCION" checked=""id="check"  > DEVOLUCION

                                                <BR>
                                                <input  required="" type="radio" name="vmotiv" value="DESCUENTO" id="check_1"> DESCUENTO

                                            </div>
                                        </div>                                  
                                    </div>



                                    <span class="col-md-1"></span>
                                    <div class="form-group">

                                        <div class="col-md-4">
                                            <label class="col-md-2 control-label"><h3>MOTI.DESCRIPCION</h3></label>
                                            <input type="text" required="" id="descrip"
                                                   placeholder="Ingrese descripcion"
                                                   class="form-control" onchange="solo_observacion()" onkeyup="solo_observacion()"
                                                   name="vdescrip">

                                        </div>
                                        <div class="form-group" style="display: none" id="oculdescuento">
                                            <div class="col-md-3">
                                                <label class="col-md-3 control-label"><h3>DESCUENTO:</h3></label>
                                                <input  type="number"  id="descuento"
                                                        placeholder="Especifique el descuento"
                                                        class="form-control" min="0" 
                                                        onchange="solo_descuento()"
                                                        onkeyup="calsubtotall(), solo_descuento()"
                                                        onmouseup="calsubtotall(),solo_descuento()"
                                                        max="100"
                                                        name="vdesc"
                                                        value="0">

                                            </div>
                                            <div class="col-md-3">
                                                <label class="col-md-4 control-label"><h3>SUBTOTAL:</h3></label>
                                                <input type="number" required=""
                                                       placeholder="Subtotal del producto"
                                                       class="form-control" value="0"
                                                       readonly="" name="vtotal" id="subtotal" >
                                            </div>
                                        </div>

                                        <span class="col-md-1"></span>
                                        <div class="col-md-4" id="detalless">
                                            <label class="col-md-5 control-label"><h3>TOTAL</h3></label>
                                            <input type="number" required="" readonly="" 
                                                   placeholder="Total" value="0"

                                                   class="form-control" >
                                            <!--                                            onkeyup="calsubtotall()" -->
                                        </div>

                                    </div>
                                    <br>
                                    <br>



                                    <div class="modal-footer">
                                        <button type="reset" data-dismiss="modal" class="btn btn-default pull-left">
                                            <i class="fa fa-close"></i> Cerrar</button>
                                        <button type="submit" class="btn btn-primary pull-right">
                                            <i class="fa fa-floppy-o"></i> Registrar</button>
                                    </div>
                            </form>
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
        $("document").ready(function () {
            proveedor();
            calsubtotall;
            costo();

        });

   function validarvigencia() {
            
              
                var hoy = new Date($('#desde').val());
                var fechaFormulario = new Date($('#hasta').val());
                if (fechaFormulario < hoy) {
                    
                     notificacion('Atencion', 'Fecha inferior a la fecha !!!', 'window.alert(message);');
//                    $('#desde').val(hoyy);
                    $('#hasta').val(hoy);
                }
                else {

                }
            }
                           function solo_timbrado() {
                var numero = document.getElementById("timbrad").value;
                if (numero.match(/^-?[0-9]+(\.[0-9](1,2))?$/))
                {

                } else {
                    notificacion('Atencion', 'No se permiten letras o espacios ', 'window.alert(message);');
//                    notificacion("Solo numeros");
                    document.getElementById("timbrad").value = "";

                }
            }
                           function solo_credi() {
                var numero = document.getElementById("credi").value;
                if (numero.match(/^-?[0-9--]+(\.[0-9--](1,2))?$/))
                {

                } else {
                    notificacion('Atencion', 'No se permiten letras o espacios ', 'window.alert(message);');
//                    notificacion("Solo numeros");
                    document.getElementById("credi").value = "000-000-0000000";

                }
            }
                           function solo_descuento() {
                var numero = document.getElementById("descuento").value;
                if (numero.match(/^-?[0-9]+(\.[0-9](1,2))?$/))
                {

                } else {
                    notificacion('Atencion', 'No se permiten letras o espacios ', 'window.alert(message);');
//                    notificacion("Solo numeros");
                    document.getElementById("descuento").value = "0";
                    calsubtotall();

                }
            }
                 function solo_observacion() {
//                      var numero = trim(numero);
                var numero = document.getElementById("descrip").value;
                if (numero.length === 0 || numero === " ") {
                    notificacion('Atencion', 'No se permiten campos vacios', 'window.alert(message);');
                   
                    document.getElementById("descrip").value = "";
                    
                    
                } else {

                }
            }
        function anular(datos) {
            var dat = datos.split("_");
            $('#si').attr('href',
                    'nota_credito_control.php?vcred=' + dat[0] +
                    '&vusu=null' +
                    '&vcompr=null' +
                    '&vprov= null' +
                    '&vtip= null' +
                    '&vfecha=1900-01-01' +
                    '&vmotiv=null' +
                    '&vdescrip=null' +
                    '&vdesc=null' +
                    '&vestado=ANULADO' +
                    '&vtotal=null' +
                    '&vfechasis=1900-01-01' +
                    '&vtimb=null' +
                    '&vvigen=1900-01-01' +
                    '&vnrocredi=null' +
                    '&accion=2' +
                    '&pagina=nota_credito.php');
            $('#confirmacion').html('<span class="glyphicon glyphicon-warning-sign"></span>\n\
       Desea anular la nota de credito');
        }

        function proveedor() {

            if ((parseInt($('#compra').val()) > 0) || ($('#compra').val() == "") || ($('#compra').val() !== "")) {
                $.ajax({
                    type: "GET",
                    url: "/mauro/lista_proveedor_2.php?vcompr=" + $('#compra').val(),
                    cache: false,
                    beforeSend: function () {
                        $('#detalles').html('<img src="/mauro/img/cargando.GIF">  \n\
                      <strong><i>Cargando...</i></strong>');
                    },
                    success: function (msg) {
                        $('#detalles').html(msg);

                    }
                });
            } else {
                $("#compra").val('');

            }
        }
        function costo() {
            if (parseInt($('#compra').val()) > 0) {
                $.ajax({
                    type: "GET",
                    url: "/mauro/lista_montos_comp.php?vcompr=" + $('#compra').val(),
                    cache: false,
                    beforeSend: function () {
                        $('#detalless').html('<img src="/mauro/img/ajax-loader.GIF">  \n\
                      <strong><i>Cargando...</i></strong>');
                    },
                    success: function (msg) {
                        $('#detalless').html(msg);
                        calsubtotall();

                    }
                });
            }
        }
//            console.log(subtotal);
        function calsubtotall() {

//            if($(("#compra").val()) !== 0){
            var subtotal = 0;
            var subtotal_fin = 0;
            var descuento = parseInt($('#descuento').val());
            var monto = parseInt($('#total').val());
            subtotal = (descuento * monto) / 100;
            subtotal_fin = monto - subtotal;

            console.log(descuento);
            console.log(monto);
            console.log(subtotal);

            $("#subtotal").val(subtotal_fin);
        }
//                  else  if($(("#compra").val()) == 0) 
//                  {
//                      $("#subtotal").val(monto); }
//              }



        $("#check").click(function () {
            var montoo = parseInt($('#total').val());
            $("#oculdescuento").css("display", "none");
            $("#descuento").val('0');
//                $("#subtotal").val(montoo);
            calsubtotall();

        });


        $("#check_1").click(function () {
            $("#oculdescuento").css("display", "block");
        });



    </script>
</body>
</html>