
<!DOCTYPE html>
<html>
    <head>
        <link rel="shortcut icon"  href=" images/mauro"/>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <title>COMPRAS</title>

        <?php
        require './session_start.php';
//        require './anular_sesion.php';
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
                        <h3 class="page-header">LISTADO DE COMPRA 

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
                            $compras = consultas::get_datos("select * from v_compras
                            order by cod_compra  asc");
                            if (!empty($compras)) {
                                ?>                         
                                <!-- /.panel-heading -->
                                <div class="panel-body">
                                    <div>
                                        <table id="example1" width="100%" class="table table-striped table-bordered table-hover">
                                            <thead>
                                                <tr>
                                                    <th class="text-center">#</th>
                                                    <th class="text-center">FECHA. COMPRA</th>  
                                                    <th class="text-center">NRO FACTURA</th>  
                                                    <th class="text-center">PROVEEDOR</th>     
                                                    <th class="text-center">ESTADO</th>                                        
                                                    <th class="text-center">TOTAL</th>                                                                               
                                                    <th class="text-center">USUARIO</th>
                                                    <th class="text-center">CONDICION</th>
                                                    <th class="text-center">CUOTA</th>
                                                    
                                                    <th class="text-center">ACCIONES</th>
                                                </tr>
                                            </thead>
                                            <tbody class="buscar">
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
                                                        <td class="text-center">
                                                            <a  
                                                                href="compra_detalle.php?vdetcompra=<?php echo $compra['cod_compra'];?>&vorden=<?php echo $compra['cod_ord_compra'];  ?>&vped=<?php echo $compra['cod_pedido_com']; ?>"
                                                                class="btn btn-xs btn-primary" rel='tooltip' data-title="Detalles" >
                                                                <span class="fa fa-th-list"></span></a>
                                                         
                                                                  <a href="imprimir_factura.php?vdetcompra=<?php echo $compra['cod_compra']; ?>"
                                                            target="_blank"
                                                            class="btn btn-xs btn-primary"
                                                            rel="tooltip" data-title="imprimir">
                                                                <span class="glyphicon glyphicon-print"></span></a>
                                                                    
                                                                
                                                                
                                                              <?php if ($compra['comp_estado'] == 'ACTIVO'&&($compra['total_comp'] > 0)) { ?>   
                                                                
                                                                 <a onclick="confirmar(<?php
                                                        echo "'" .$compra['cod_compra'] . "_" .
//                                                              $compra['cod_ord_compra'] . "_" .
//                                                                  $compra['cod_pedido_com'] . "_" .
                                                                $compra['comp_estado'] ."'"
                                                        ?>)"
                                                           class="btn btn-xs btn-success" rel='tooltip' data-title="Confirmar"
                                                           data-toggle="modal"
                                                           data-target="#delete">
                                                            <span class="glyphicon glyphicon-ok-sign"></span></a>
                                                          
                                                            
                                                             <a onclick="anular(<?php
                                                        echo "'" .$compra['cod_compra'] . "_" .
//                                                              $compra['cod_ord_compra'] . "_" .
//                                                                  $compra['cod_pedido_com'] . "_" .
                                                                $compra['comp_estado'] ."'"
                                                        ?>)"
                                                     class="btn btn-xs btn-danger" rel='tooltip' data-title="Anular"
                                                                   data-toggle="modal"
                                                                   data-target="#deletee">
                                                                    <span class="glyphicon glyphicon-ban-circle"></span></a>
                                                            
                                                               <?php } else { ?>
                                                                     <?php } ?>
                                                            
<!--                                                              //  $compra['id_suc'] . "_" .
                                                               // $compra['usu_cod'] . "_" .
                                                              //  $compra['id_proveedor'] . "_" .
                                                               /// $compra['id_orden_compra'] . "_" .
                                                               // $compra['compra_fact'] . "_" .
                                                               // $compra['compra_fecha'] . "_" .
                                                               // $compra['compra_cond'] . "_" .
                                                               // $compra['comp_cant_cuota'] . "_" .
                                                              //  $compra['id_pedido'] . "_" .
                                                               // $compra['total_comp'] . "_" .
                                                            -->
                                                            
                                                            
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
                                <h4 class="modal-title"><strong>REGISTRAR COMPRA</strong></h4>
                            </div>

                            <?php $fecha = consultas::get_datos("select * from v_fecha"); ?>
                            <form action="compra_control.php" method="post" accept-charset="utf-8" class="form-horizontal">
                                <div class="panel-body ">
                                    <input type="hidden" name="accion"  value="1">
                                    <input type="hidden" name="vcompra" value="0"/> 
                                    <input type="hidden" name="vusuario" 
                                           value="<?php echo $_SESSION['cod_usu']; ?>">
                                    <input type="hidden" name="vfechasis" 
                                           value="<?php echo $fecha[0]['fecha'] ?>">
                                    <input type="hidden" name="vestad" value="ACTIVO">
                                    <input type="hidden" name="vtotal" value="0">
                                    <input type="hidden" name="pagina" value="compra_detalle.php">
                            
                                    <span class="col-md-1"></span>
                                    <span class="col-md-1"></span>
                                    <div class="form-group">
                                        <div class="col-md-3 " >
                                            <label  class="control-label col-md-2"><h3> COMPRA</h3></label>
                                            <input type="date" required="" placeholder="Ingrese fecha" onchange="validarvigencia()" id="desde"
                                                   class="form-control" name="vfechafact" value="<?php echo $fecha[0]['fecha'] ?>">
                                        </div>
                                          <div class="col-md-3 " >
                                            <label  class="control-label col-md-1"><h3>INGRESO</h3></label>
                                            <input type="date" required="" placeholder="Ingrese fecha" id="hasta"  onchange="validarvigencia()"
                                                   class="form-control" name="vfin" value="<?php echo $fecha[0]['fecha'] ?>">
                                        </div>

                                        </div>
                                    <span class="col-md-1"></span>
                                    <span class="col-md-1"></span>
                                    <div class="form-group">

          
                                    <div class="col-md-3">
                                        <label control-label class="col-md-3 "><h3>TIPO</h3></label>
                                        <select required="" name="vtipo" class="form-control select"  >
                                        <?php
                                        $tipocomprobantess = consultas::get_datos("select * from tipo_comrprobante where cod_tipo_comprobante = 1"
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
                                                <option value="">Debe insertar un comprobante</option>
<?php } ?>
                                        </select>
                                    </div>
                                   
                                    <div class="col-md-3">
                                            <label  class="control-label col-md-2"><h3>TIMBRADO</h3></label>
                                       
                                            <input type="text" required=""
                                               placeholder="Especifique Cantidad"
                                               class="form-control"
                                               name="vtim" id="timbrad"
                                               onchange="solo_timbrado()" onkeyup="solo_timbrado()"
                                               pattern="[0-9]{8,8}"title="SOLO SE PERMITEN 8 DIGITOS" autofocus="">
                                                
                                    </div>

                                    <div class="col-md-3">
                                            <label  class="control-label col-md-2"><h3>FACTURA</h3></label>
                                       
                                            <input type="text" required=""
                                               placeholder="Especifique Cantidad"
                                               class="form-control" id="factu"
                                               onchange="solo_factura()"onkeyup="solo_factura()"
                                               name="vfact"  min="15"max="15" value="000-000-0000000"
                                                pattern="[0-9 and -]{15,15}"title="NUMERO DE FACTURA DEBE SER 15 CONTANDO LOS - MODIFIQUE DE ACUERDO A SU NECESIDA!!!" autofocus="">
                                                
                                    </div>
                                </div>
                                    <span class="col-md-1"></span>
                                    <span class="col-md-1"></span>
                                    <div class="form-group">
                                        
                                                 <div class="col-md-3">
                                            <label class="control-label col-md-3"><H3>SELECION</h3></label>
                                            <select  class="form-control" required="" id="LISTA" onchange="tiposelect(), proveedorpedido(),proveedor()"onkeyup="tiposelect(), proveedorpedido(),proveedor()" onclick="tiposelect()" >
                                                <option value="" >Seleccione.. </option>
                                                <option value="1" >PEDIDO </option>
                                                <option value="2" >ORDEN DE COMPRA</option>



                                            </select>
                                        </div>

                                        <div class="col-md-3">
                                            <label  class="control-label col-md-2"><h3>PEDIDO</h3></label>
                                            <select required="" class="form-control"   name="vped"id="pedido"  
                                                    onchange="proveedorpedido()"
                                                onkeyup="proveedorpedido()">
                                                <option value="" >Seleccione un pedido</option>
                                                <?php
                                                $pedidos = consultas::get_datos("SELECT * FROM pedido_compra 
                                                WHERE ped_estado = 'PENDIENTE'
                                                ORDER BY cod_pedido_com;");
                                                ?> 
                                                <?php
                                               
                                                foreach ($pedidos as $pedido) { ?>
                                                    <option value="<?php echo $pedido['cod_pedido_com']; ?>"><?php echo $pedido['cod_pedido_com'] . " - " . $pedido['fecha_pedi']; ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>

                                        <div class="col-md-3" >
                                            <label  class="control-label col-md-2"><h3>ORDEN</h3></label>
                                            <select  required="" class="form-control"   name="vorden" id="orden" 
                                                     onchange="proveedor()"
                                                    onkeyup="proveedor()"> 
                                                <option   value="0">Seleccione una orden</option>
                                                <?php
                                                $ordens = consultas::get_datos("SELECT * FROM orden_compra 
                                                WHERE orden_estado = 'PENDIENTE'
                                                ORDER BY cod_ord_compra;");
                                                ?> 
                                                <?php foreach ($ordens as $orden) { ?>
                                                    <option value="<?php echo $orden['cod_ord_compra']; ?>"><?php echo $orden['cod_ord_compra'] . " - " . $orden['orden_fecha']; ?></option>
                                                <?php } ?>
                                                
                                            </select>
                                        </div>
                                    </div>

                                    <span class="col-md-1"></span>
                                    <span class="col-md-1"></span>
                                    <div class="form-group">
                                    
                                 <div class="col-md-4">
                                            <label  class="control-label col-md-3"><h3>PROVEEDOR</h3></label>
                                            <select class="form-control"  required="" name="vprov" id="idproveedor">
                                                <option value="">Seleccione un proveedor</option>
                                               
                                            </select>
                                              
                                        </div>
                                        
                                        
                                        
                                        
                                         <div class="col-md-4">
                                            <label  class="control-label col-md-3"><h3>CONDICION</h3></label>
                                     <select name="vcondicion" class="form-control"
                                             id="vcondicion" onchange="compra();">
                                            <option value="CONTADO">CONTADO</option>
                                            <option value="CREDITO">CREDITO</option>
                                        </select>
                                        </div>

                                    </div>

                                    <span class="col-md-1"></span>
                                      <span class="col-md-1"></span>
                                    <div class="form-group">
                                         <div class="col-md-4">
                                            <label  class="control-label col-md-3"><h3>CUOTA</h3></label>
                                           <input type="hidden" class="form-control"
                                               name="vcuota" value="1">
                                        <input type="number" class="form-control"
                                               name="vcuota" disabled="" min="1"
                                               id="vcancuo">
                                        </div>

                                        <div class="col-md-4">
                                            <label class="control-label col-md-3" ><H3>INTERVALO</h3></label>
                                          
                                            <select  class="form-control" required="" id="vintervalo" name="vinter">
                                                 <option  value=""  >Seleccione intervalo si es credito</option>
                                                 <option value="5"  >5</option>
                                                <option value="15" >15 </option>
                                                <option value="30" >30</option>
                                                <option value="40" >40</option>
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
                
                   <div class="modal fade" id="deletee" tabindex="-1" role="dialog">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                    <h4 class="modal-title custom_align" id="Heading">Atenci&oacute;n!!!</h4>
                                </div>
                                <div class="modal-body">

                                    <div class="alert alert-warning" id="confirmacionn"></div>

                                </div>
                                <div class="modal-footer">
                                    <a id="sii" role="button" class="btn btn-primary" ><span class="glyphicon glyphicon-ok-sign"></span> Si</a>
                                    <button type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> No</button>
                                </div>
                            </div>
                        </div>
                    </div> 
                <!--fin-->
            </div> 
                                    
                                      
                <?php require 'menu/js.ctp'; ?>

                <script language="JavaScript">
                $("document").ready(function () {
                    tiposelect();
                     proveedor();
                });
                          function solo_factura() {
                var numero = document.getElementById("factu").value;
                if (numero.match(/^-?[0-9--]+(\.[0-9--](1,2))?$/))
                {

                } else {
                    notificacion('Atencion', 'No se permiten letras o espacios ', 'window.alert(message);');
//                    notificacion("Solo numeros");
                    document.getElementById("factu").value = "";

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
                
                      function validarvigencia() {
            
                var hoy = new Date($('#desde').val());
                var fechaFormulario = new Date($('#hasta').val());
                if (fechaFormulario < hoy) {
                    
                     notificacion('Atencion', 'Fecha inferior a la fecha de compra!!!', 'window.alert(message);');
                    $('#fecha').val(hoy);
                    $('#hasta').val(hoy);
                }
                else {

                }
            }
            
                
                
                 function tiposelect() {
                    if($("#LISTA"))
                    switch($("#LISTA").val()){
                        case "1":
                             $("#pedido").removeAttr("disabled");
                              $("#orden").attr("disabled", "disabled");
                             
                              $("#orden").val('0');
                             
                               
                       
                        break;
                        case "2":
                            $("#orden").removeAttr("disabled");
                             $("#pedido").attr("disabled", "disabled");
                             
                              $("#pedido").val('');
                        break;
                        case "":
                            $("#pedido").attr("disabled", "disabled");
                             $("#pedido").val('');
                            $("#orden").attr("disabled", "disabled");
                          
                             $("#orden").val('0');
                            
                    
                             
                        break;
                     
                            
                    }
                }
                
                
                  function compra() {

                if (document.getElementById('vcondicion').
                        value === "CONTADO") {
                    document.getElementById('vcancuo').
                            setAttribute('disabled','true');
                    document.getElementById('vcancuo').
                            value = '1';
                    
                    
                    document.getElementById('vintervalo').
                            setAttribute('disabled','true');
                    document.getElementById('vintervalo').value = '';
               
                    
                        } else {
                            document.getElementById('vcancuo').
                                    removeAttribute('disabled');
                            document.getElementById('vcancuo').value = '2';
                            document.getElementById('vcancuo').min = '2';
                            
                            
                            document.getElementById('vintervalo').
                                    removeAttribute('disabled');
                                    document.getElementById('vintervalo').value = '5';
                            
                            
                            
                        }
                    }
                    window.onload = compra();
                    
                     
                          function proveedor(){
                    
            if ((parseInt($('#orden').val()) > 0) || ($('#orden').val() == "") || ($('#orden').val() !== "")) {
                $.ajax({
                    type: "GET",
                    url: "/mauro/lista_proveedor.php?vorden=" + $('#orden').val(),
                    cache: false,
                    beforeSend: function () {
                        $('#idproveedor').html('<img src="/bulls/img/cargando.GIF">  \n\
                          <strong><i>Cargando...</i></strong>');
                    },
                    success: function (msg) {
                        $('#idproveedor').html(msg);
                        
                    }
                });
            }
            else{
               $("#orden").val('');
               
            }
        }
         
    
        
              function proveedorpedido(){
                    
            if ((parseInt($('#pedido').val()) > 0) || ($('#pedido').val() == "")) {
                $.ajax({
                    type: "GET",
                    url: "/bulls/lista_proveedor_1.php?vprov=" + $('#pedido').val(),
                    cache: false,
                    beforeSend: function () {
                        $('#idproveedor').html('<img src="/bulls/img/cargando.GIF">  \n\
                          <strong><i>Cargando...</i></strong>');
                    },
                    success: function (msg) {
                        $('#idproveedor').html(msg);
                      
                    }
                });
            }
            else{
               $("#pedido").val('');
            }
        }
        
        function confirmar(datos) {
            var dat = datos.split("_");
            $('#si').attr('href',
                    'compra_control.php?vcompra=' + dat[0] +
                   '&vusuario=null'  +
                     '&vprov=null' +
                     '&vorden=null' +
                     '&vtipo=null' +
                     '&vfechasis=1900-01-01' +
                     '&vfechafact=1900-01-01' +
                     '&vfact=null' +
                     '&vcondicion=null' +
                     '&vcuota=null' +
                    '&vped=null'+
                     '&vtotal=null' +
                    '&vestad=CONFIRMADO'+
                    '&vinter=null' +
                    '&vfin=1900-01-01' +
                    '&vtim=null' +
                    '&accion=2' +
                    '&pagina=compra_index.php');
              $('#confirmacion').html('<span class="glyphicon glyphicon-warning-sign"></span>\n\
                Desea confirmar la compra?');
        }
        
        
        
        
                     function anular(datos) {
            var dat = datos.split("_");
            $('#sii').attr('href',
                    'compra_control.php?vcompra=' + dat[0] +
                   '&vusuario=null'  +
                     '&vprov=null' +
                     '&vorden=null' +
                     '&vtipo=null' +
                     '&vfechasis=1900-01-01' +
                     '&vfechafact=1900-01-01' +
                     '&vfact=null' +
                     '&vcondicion=null' +
                     '&vcuota=null' +
                    '&vped=null'+
                     '&vtotal=null' +
                    '&vestad=ANULADO'+
                    '&vinter=null' +
                    '&vfin=1900-01-01' +
                    '&vtim=null' +
                    '&accion=4' +
                    '&pagina=compra_index.php');
              $('#confirmacionn').html('<span class="glyphicon glyphicon-warning-sign"></span>\n\
                Desea Anular la orden?');
        }
             
        
      
                
            </script>

    </body>
</html>
