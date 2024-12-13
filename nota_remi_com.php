<!DOCTYPE html>
<html lang="en">
<head>
<link rel="shortcut icon"  href=" images/mauro"/>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
    <title>NOTA DE REMISION</title>
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
                        <h3 class="page-header">Listado de Nota de Remision

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
                            $remisions = consultas::get_datos("select * from v_notaremisioncompras
                            order by cod_nota_remision asc");
                            if (!empty($remisions)) {
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
                                                    <th class="text-center">NRO. REMISION</th>
                                                    <th class="text-center">PROVEEDOR</th>
                                                    <th class="text-center">FECHA</th>
                                                    <th class="text-center">MOTIVO</th>
                                                    <th class="text-center">CONDUCTOR</th>
                                                    <th class="text-center">FECHA SALIDA</th>
                                                    <th class="text-center">FECHA LLEGADA</th>

                                                    <th class="text-center">ESTADO</th>
                                                    <th class="text-center">ACCIONES</th>
                                                </tr>
                                            </thead>
                                            <tbody class="buscar">
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
                                                        <td class="text-center">
                                                            <a  
                                                                href="notaremision_detalle.php?vdetremi=<?php echo $remision['cod_nota_remision']; ?>&vcompr=<?php echo $remision['cod_compra']; ?>"
                                                                class="btn btn-xs btn-primary" rel='tooltip' data-title="Detalles" >
                                                                <span class="fa fa-th-list"></span></a>

                                                            <a href="imprimir_notaremision.php?vcod=<?php echo $remision['cod_nota_remision']; ?>"
                                                               target="_blank"
                                                               class="btn btn-xs btn-success"
                                                               rel="tooltip" data-title="imprimir">
                                                                <span class="glyphicon glyphicon-print"></span></a>
                                                            <?php if ($remision['remi_estado'] == 'ACTIVO') { ?>  
                                                                <a onclick="anular(<?php
                                                                echo "'" . $remision['cod_nota_remision'] . "_" .
//                                                                $remision['cod_usu'] . "_" .
//                                                                $remision['cod_compra'] . "_" .
//                                                                $remision['provee_nomb'] . "_" .
//                                                                $remision['cod_tipo_comprobante'] . "_" .
//                                                                $remision['remi_fecha'] . "_" .
//                                                                $remision['remi_motivo'] . "_" .
//                                                                $remision['remi_conductor'] . "_" .
//                                                                $remision['remi_feha_salida'] . "_" .
//                                                                $remision['remi_fecha_llegada'] . "_" .
//                                                                $remision['nro_timbrado'] . "_" .
                                                                $remision['remi_estado'] . "'";
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
                                <h4 class="modal-title"><strong>REGISTRAR NOTA REMISION</strong></h4>
                            </div>
                            <?php $fecha = consultas::get_datos("select * from v_fecha"); ?>
                            <form action="nota_remision_control.php" method="post" accept-charset="utf-8" class="form-horizontal">
                                <div class="panel-body se">
                                    <input type="hidden" name="accion"  value="1">
                                    <input type="hidden" name="vremi" value="0"/> 
                                    <input type="hidden" name="vusu" 
                                           value="<?php echo $_SESSION['cod_usu']; ?>">
                                    <input type="hidden" name="vestado" value="ACTIVO">
                                    <input type="hidden"id="fechasis" name="vfechasis" value="<?php echo $fecha[0]['fecha'] ?>">
                                    <input type="hidden" name="pagina" value="notaremision_detalle.php">

                                    <span class="col-md-1"></span>
                                    <div class="form-group">
                                        <div class="col-md-3 " >
                                            <label  class="control-label col-md-2"><h3>FECHA</h3></label>
                                            <input type="date" required="" placeholder="Ingrese fecha" id="desde"onchange="validarvigencia()" onkeyup="validarsalida()"
                                                   class="form-control" name="vfecharemi" value="<?php echo $fecha[0]['fecha'] ?>">
                                        </div>
                                        <div class="col-md-3 " >
                                            <label  class="control-label col-md-1"><h3>VIGENCIA</h3></label>
                                            <input type="date" required="" placeholder="Ingrese fecha" id="vigencia"  onchange="validarvigencia()"
                                                   class="form-control" name="vvigen" value="<?php echo $fecha[0]['fecha'] ?>">
                                        </div>
                                
                                        <div class="col-md-4" >
                                            <label  class="control-label col-md-2"><h3>COMPRA:</h3></label>
                                            <select  required="" class="form-control"   name="vcompr" id="compra" 
                                                    onchange="proveedor(), costo()"
                                                    onkeyup="proveedor(), costo()"> 
                                                <!--                                                <option  value="0">Seleccione una compra</option>-->

                                                <?php
                                                $compras = consultas::get_datos("SELECT * FROM v_compras WHERE cod_compra NOT IN (SELECT cod_compra FROM nota_remi_compra WHERE remi_estado != 'ANULADO') AND "
                                                . "comp_estado = 'CONFIRMADO' "
                                                . "ORDER BY cod_compra");
                                                
                                                ?> 
                                                <?php
                                                if (!empty($compras)) {
                                                    foreach ($compras as $compra) {
                                                        ?>
                                                        <option  value="<?php echo $compra['cod_compra']; ?>">
                                                            <?php echo $compra['cod_compra'] . " - " . $compra['fac_compra']; ?></option>
                                                        <?php
                                                    }
                                                } else {
                                                    ?>
                                                    <option value="0">No hay facturas compras confirmadas</option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                        </div>

                                        <span class="col-md-1"></span>

                                            <div class="form-group">
                                                <div class="col-md-3" >
                                            <label  class="control-label col-md-3"><h3>TIMBRADO</h3></label>

                                            <input type="text" required=""
                                                   placeholder="Especifique timbrado"
                                                   class="form-control"
                                                   name="vtimb" id="timbrad"
                                                   onchange="solo_timbrado()" onkeyup="solo_timbrado()"
                                                   pattern="[0-9]{8,8}"title="SOLO SE PERMITEN 8 DIGITOS" autofocus="">

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

                                        <div class="col-md-3">
                                            <label control-label class="col-md-3 "><h3>TIPO</h3></label>
                                            <select required="" name="vtip" class="form-control select"  >
                                            <?php
                                                $tipocomprobantess = consultas::get_datos("select * from tipo_comrprobante where cod_tipo_comprobante = 4"
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
                                                
                                     </div>
                                     <span class="col-md-1"></span>

                                            <div class="form-group">
                                                <div class="col-md-3" >
                                            <label  class="control-label col-md-2"><h3>NRO/REMISION</h3></label>

                                            <input type="text" required=""
                                                   placeholder="Especifique numero remision"
                                                   class="form-control"
                                                   name="vref" id="remisi" value="000-000-0000000"
                                                   onchange="solo_remision()" onkeyup="solo_remision()"
                                                   pattern="{15,15}"title="SOLO SE PERMITEN 15 DIGITOS" autofocus="">

                                        </div>
                                        <span class="col-md-1"></span>
                                      
                                      <div class="col-md-4"style="display: none" id="oculdescuento">
                                          <label class="col-md-2 control-label"><h3>MOTI.DESCRIPCION</h3></label>
                                          <input type="text"  id="descrip" onkeyup="sololetras()" onchange="sololetras()"
                                                 placeholder="Ingrese descripcion"
                                                 class="form-control" 
                                                name="vmotivo" pattern="[A-Za-z #SPACE]{4,30}" >

                                      </div>
                                      <BR>
                                        <BR>
                                        <BR>
                                       
                                        </div>      
                                     </div>
                                     <div class="row">
                                            <div seclass="radio col-md-12">
                                                <label class="col-md-2 control-label" >MOTIVO:</label>
                                                
                                                <input  required="" type="radio"  name="vmotiv"  value="COMPRA" checked=""id="check"  > COMPRA

                                                <BR>
                                                <input  required="" type="radio"  name="vmotiv" value="0" id="check_1"> OTROS

                                            </div>
                                     <span class="col-md-1"></span>
                                    

                                    </div>
                                    <HR>
                                        <div class="form-group">
                                        <span class="col-md-1"></span>
                                      
                                        <div class="col-md-4">
                                            <label class="col-md-2 control-label"><h3>CONDUCTOR</h3></label>
                                            <input type="text" required="" id="conduc"
                                                   placeholder="Ingrese descripcion"
                                                   class="form-control" 
                                                   onchange="solo_conduc()" onkeyup="solo_conduc()"
                                                   name="vcond">

                                        </div>  
                                        <div class="col-md-3">
                                            <label  class="control-label col-md-2"><h3>CI</h3></label>

                                            <input type="text" 
                                                   placeholder="Especifique ci"
                                                   class="form-control"
                                                   name="vci" id="cii" onchange="solo_cii()" onkeyup="solo_cii()"
                                                    pattern="[0-9]{7,7}"title="SOLO SE PERMITEN 8 DIGITOS" autofocus="">

                                        </div>
                                        <div class="col-md-3">
                                            <label  class="control-label col-md-2"><h3>TELEFONO</h3></label>

                                            <input type="text" 
                                                   placeholder="Especifique telefono"
                                                   class="form-control"
                                                   name="vtel" id="tel"
                                                   onchange="solo_telefo()" onkeyup="solo_telefo()"
                                                   pattern="[0-9]{9,10}"title="SOLO SE PERMITEN 10 DIGITOS" autofocus="">

                                        </div>
                                        </div>  
                                             <HR>
                                        <div class="form-group">
                                        <span class="col-md-1"></span>
                                      
                                        <div class="col-md-4">
                                            <label class="col-md-2 control-label"><h3>CHAPA</h3></label>
                                            <input type="text" required="" id="chap"
                                                   placeholder="Ingrese numero de chapa"
                                                   class="form-control"  onchange="solo_chapa()" onkeyup="solo_chapa()"
                                                   name="vchap">

                                        </div>  

                                        <div class="col-md-5">
                                            <label control-label class="col-md-3 "><h3>VEHICULO</h3></label>
                                            <select required="" name="vmarc" class="form-control select"  >
                                                <option value="">Seleccione una marca de vehiculo</option>
                                                <?php
                                                $marcas = consultas::get_datos("select * from marca_vehiculo "
                                                                . " order by cod_mar_vehi");
                                                ?>                                 

                                                <?php
                                                if (!empty($marcas)) {
                                                    foreach ($marcas as $marca) {
                                                        ?>
                                                        <option  value="<?php echo $marca['cod_mar_vehi']; ?>">
                                                            <?php echo $marca['descrip_mar_vehi']; ?> </option>
                                                        <?php
                                                    }
                                                } else {
                                                    ?>
                                                    <option value="">Debe insertar una marca de vehiculo</option>
                                                <?php } ?>
                                            </select>
                                        </div> 
                                        </div> 
                                        <span class="col-md-1"></span>
                                    <div class="form-group">
                                        <div class="col-md-4 " >
                                            <label  class="control-label col-md-2"><h3>SALIDA</h3></label>
                                            <input type="date" required="" placeholder="Ingrese fecha" id="fechasalida" onchange="validarsalida(),validarllegada()" onkeyup="validarsalida(),validarllegada()"
                                                   class="form-control" name="vsali" value="<?php echo $fecha[0]['fecha'] ?>">
                                        </div>
                                        <div class="col-md-4 " >
                                            <label  class="control-label col-md-1"><h3>LLEGADA</h3></label>
                                            <input type="date" required="" placeholder="Ingrese fecha" id="fechallegada" onkeyup="validarllegada()" onchange="validarllegada()"
                                                   class="form-control" name="vllega" value="<?php echo $fecha[0]['fecha'] ?>">
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
                                    </div>
                            </form>
                        
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

        function anular(datos) {
            var dat = datos.split("_");
            $('#si').attr('href',
                    'nota_remision_control.php?vremi=' + dat[0] +
                    '&vcompr=null' +
                    '&vusu=null' +
                    '&vtip=null' +
                    '&vref= null' +
                    '&vfecharemi=1900-01-01' +
                    '&vmotiv=null' +
                    '&vcond=null' +
                    '&vci=null' +
                    '&vtel=null' +
                     '&vsali=1900-01-01' +
                     '&vllega=1900-01-01' +
                    '&vestado=ANULADO' +
                    '&vmarc=null' +
                    '&vprov=null' +
                    '&vtimb=null' +
                    '&vvigen=1900-01-01' +
                    '&vfechasis=1900-01-01' +
                    '&vchap=null' +
                    '&accion=2' +
                    '&pagina=nota_remi_com.php');
            $('#confirmacion').html('<span class="glyphicon glyphicon-warning-sign"></span>\n\
       Desea anular la nota de remision');
        }
                 function validarvigencia() {
            
                var hoyy = new Date($('#fechasis').val());
                var hoy = new Date($('#desde').val());
                var fechaFormulario = new Date($('#vigencia').val());
                if (fechaFormulario < hoy) {
                    
                     notificacion('Atencion', 'Fecha inferior a la fecha !!!', 'window.alert(message);');
//                    $('#desde').val(hoyy);
                    $('#vigencia').val(hoy);
                }
                else {

                }
            }
                 function validarsalida() {
            
                var hoy = new Date($('#desde').val());
                var fechaFormulario = new Date($('#fechasalida').val());
                if (fechaFormulario < hoy) {
                    
                     notificacion('Atencion', 'Fecha inferior a la fecha !!!', 'window.alert(message);');
//                    $('#desde').val(hoy);
                    $('#fechasalida').val(hoy);
                }
                else {

                }
            }
                 function validarllegada() {
            
                var hoy = new Date($('#fechasalida').val());
                var fechaFormulario = new Date($('#fechallegada').val());
                if (fechaFormulario < hoy) {
                    
                     notificacion('Atencion', 'Fecha inferior a la fecha !!!', 'window.alert(message);');
//                    $('#desde').val(hoy);
                    $('#fechallegada').val(hoy);
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
                       function solo_cii() {
                var numero = document.getElementById("cii").value;
                if (numero.match(/^-?[0-9]+(\.[0-9](1,2))?$/))
                {

                } else {
                    notificacion('Atencion', 'No se permiten letras o espacios ', 'window.alert(message);');
//                    notificacion("Solo numeros");
                    document.getElementById("cii").value = "";

                }
            }
                      function solo_telefo() {
                var numero = document.getElementById("tel").value;
                if (numero.match(/^-?[0-9]+(\.[0-9](1,2))?$/))
                {

                } else {
                    notificacion('Atencion', 'No se permiten letras o espacios ', 'window.alert(message);');
//                    notificacion("Solo numeros");
                    document.getElementById("tel").value = "";

                }
            }
         function solo_chapa() {
//                      var numero = trim(numero);
                var numero = document.getElementById("chap").value;
                if (numero.length === 0 || numero === " ") {
                    notificacion('Atencion', 'No se permiten campos vacios', 'window.alert(message);');
                   
                    document.getElementById("chap").value = "Sin Chapa";
                    
                    
                } else {

                }
            }
         function solo_conduc() {
//                      var numero = trim(numero);
                var numero = document.getElementById("conduc").value;
                if (numero.length === 0 || numero === " ") {
                    notificacion('Atencion', 'No se permiten campos vacios', 'window.alert(message);');
                   
                    document.getElementById("conduc").value = "Sin Nombre";
                    
                    
                } else {

                }
            }
                      function solo_remision() {
                var numero = document.getElementById("remisi").value;
                if (numero.match(/^-?[0-9--]+(\.[0-9--](1,2))?$/))
                {

                } else {
                    notificacion('Atencion', 'No se permiten letras o espacios ', 'window.alert(message);');
//                    notificacion("Solo numeros");
                    document.getElementById("remisi").value = "";

                }
            }
      function sololetras() {
//                      var numero = trim(numero);
                var numero = document.getElementById("descrip").value;
                if (numero.length === 0 || numero === " ") {
                    notificacion('Atencion', 'No se permiten campos vacios', 'window.alert(message);');
                    document.getElementById("descrip").value = "";
                    
                    
                } else {

                }
            }
        function proveedor() {

            if ((parseInt($('#compra').val()) > 0) || ($('#compra').val() == "") || ($('#compra').val() !== "")) {
                $.ajax({
                    type: "GET",
                    url: "/bulls/lista_proveedor_2.php?vcompr=" + $('#compra').val(),
                    cache: false,
                    beforeSend: function () {
                        $('#detalles').html('<img src="/bulls/img/cargando.GIF">  \n\
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

        $("#check").click(function () {
            $("#oculdescuento").css("display", "none");
            $("#descrip").val('');

        });


        $("#check_1").click(function () {
            $("#oculdescuento").css("display", "block");
        });



    </script>
</body>
</html>