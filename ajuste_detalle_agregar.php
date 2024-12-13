<!DOCTYPE html>
<html lang="en">
<head>
        <link rel="shortcut icon"  href=" images/mauro"/>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <title>DETALLE AJUSTE</title>
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
                           
        
                        <h3 class="page-header">DATOS  DEL AJUSTE 
                            <a href="ajuste_index.php" 
                               class="btn btn-primary btn-circle pull-right" 
                               rel='tooltip' title="Atras">
                                <i class="glyphicon glyphicon-arrow-left"></i>
                            </a> 
                           
                           
                            
                            <a data-toggle="modal" data-target="#registrar" 
                               class="btn btn-info btn-circle pull-right" 
                               rel="tooltip" data-title="Registrar">
                                <i class="fa fa-plus"></i>
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
                           $ajustes = consultas::get_datos("select * from  v_ajuste"
                                        . " where cod_ajuste_stock=" . $_REQUEST['vdetcod'] .
                                        "order by cod_ajuste_stock asc");
                           
                              ?>                         
                            <!-- /.panel-heading -->
                            <div class="panel-body">
                                <div class="table-responsive">
                                    <table width="100%"
                                           class="table table-bordered">
                                        <thead>
                                                   <tr>
                                         <th class="text-center">#</th>                                        
                                                    <th class="text-center">USUARIO</th>                                        
                                                    <th class="text-center">FECHA</th>                                        
                                                    <th class="text-center">ESTADO</th>  
                                                </tr>
                                            </thead>
                                        
                                                <?php foreach ($ajustes as $ajuste) { ?> 
                                                <tr>
                                                           <td class="text-center"><?php echo $ajuste['cod_ajuste_stock']; ?></td>
                                                        <td class="text-center"><?php echo $ajuste['usu_nick']; ?></td>
                                                        <td class="text-center"><?php echo $ajuste['fecha_ajuste']; ?></td>
                                                        <td class="text-center"><?php echo $ajuste['estado_ajuste']; ?></td>
                                                          
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
                        $ajustedetas = consultas::get_datos
                                        ("select * from  v_detalle_ajuste"
                                        . " where cod_ajuste_stock=" . $_REQUEST['vdetcod'] .
                                        "order by cod_ajuste_stock asc");
                        ?>
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                Detalle del ajuste
                            </div>
                            <?php if (!empty($ajustedetas)) { ?>
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                               <th class="text-center">#</th>
                                                <th class="text-center"> ARTICULO</th>
                                                <th class="text-center"> DESCRIPCION</th>
                                                <th class="text-center"> MOTIVO</th>
                                                  <th class="text-center"> CANTIDAD VIEJA</th>
                                                <th class="text-center"> ACTUALIZACION CANT</th>                                           
                                                <th class="text-center"> CANT TOTAL STOCK</th>
                                                
                                              
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($ajustedetas as $ajustedeta) { ?>
                                                <tr>
                                                     <td class="text-center"><?php echo $ajustedeta['cod_ajuste_stock']; ?></td>
                                                    <td class="text-center"><?php echo $ajustedeta['arti_descrip']; ?></td>
                                                    <td class="text-center"><?php echo $ajustedeta['ajuste_motivo']; ?></td>
                                                    <td class="text-center"><?php echo $ajustedeta['ajuste_motiv_descrip']; ?></td>
                                                  <td class="text-center"><?php echo number_format($ajustedeta['stock_viejo'], 0, ',', '.');?></td>
                                                    <td class="text-center"><?php echo number_format($ajustedeta['ajuste_cantidad'], 0, ',', '.');?></td>
                                                    
                                                    <td class="text-center"><?php echo number_format($ajustedeta['cantidad'], 0, ',', '.');?></td>
                                                 
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
                                            <strong>No se encontraron detalles para el ajustes....!</strong>
                                        </div>
                                    </div>
<?php } ?>
                            </div>
                        </div>

                        <div id="registrar" class="modal fade" role="dialog">
                    <div class="modal-dialog modal-lg">
                        <!-- Modal content-->
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" 
                                        data-dismiss="modal" arial-label="Close">x</button>
                                <h4 class="modal-title"><strong>REGISTRAR AJUSTE</strong></h4>
                            </div>
                            <form action="ajuste_detalle_control.php" method="get"
                                  role="form" class="form-horizontal">
                                <input type="hidden" name="accion" value="1">
                                <input type="hidden" name="vdetcod"
                                       value="<?php echo $_REQUEST['vdetcod'] ?>">
                                 <input type="hidden" name="pagina"
                                       value="ajuste_detalle_agregar.php">
                                 <BR>
                                 <div class="form-group">
                                 <label class="col-md-2 control-label">Articulos:</label>
                                    <div class="col-md-4" id="detalles">
                                        <select class="form-control" required>
                                            <option>Seleccione un articulo</option>
                                        </select>
                                    </div>
                                    </div>

                                    <div class="form-group">
                                    <label class="col-md-2 control-label">CANTIDAD:</label>
                                    <div class="col-md-3">
                                        <input type="number" required=""
                                               class="form-control" placeholder=""
                                               id="cant" name="vcant" min="1"
                                               onkeyup="stock()"
                                               onclick="stock()"
                                               max="100"
                                               onkeypress="stock()">
                                    </div>
    

                               
                                <label class="col-md-2 control-label">STOCK:</label>
                                    <div class="col-md-4" id="detalle_cantidad">

                                        <input type="number" name="vsto"
                                               class="form-control" placeholder="Cantidad de la Transferencia"
                                               id="cant" >
                                    </div>
                            </div> 
                            <div class="form-group">
                                    <div class="row">
                                        <div class="radio col-md-12">
                                            <label class="col-md-2 control-label">MOTIVO:</label>
                                            <label>
                                                <input  required=""type="radio" name="vajuste" id="entrada" value="ENTRADA" checked=""> ENTRADA
                                            </label>
                                            <BR>
                                            <label>
                                                <input  required=""type="radio" name="vajuste"  id="salida" value="SALIDA" onchange="stock()"> SALIDA
                                            </label>                                       
                                        </div>
                                    </div>                                  
                                </div>
                                                     <div class="form-group">
                                
                                          <label class="col-md-2 control-label">MOTIVO DESCRIPCION:</label>
                                    <div class="col-md-9">
                                        <input type="text" required="" 
                                               placeholder="Ingrese descripcion"
                                               class="form-control" id="descri"
                                               name="vajusdescrip">
                                        
                                    </div>
                                          
                                          <br>
                                          <br>
                                          <br>
                                  
                                   
                               
                                 
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
            
            function stock() {
                    var entrada = $('#entrada').val();
                var salida = $('#salida').val();
                var cero =0;
                
                var radio = $('input[name="vajuste"]:checked').val();
                       var cant = parseInt ($('#cantstock').val());
                       if (radio === 'SALIDA'){
                       //if (cant > 0){
                           if (parseInt ($('#cant').val()) > cant) {
   //                              notificacion('SOLO HAY ' + cant +
   //                        ' EN STOCK DE ESTE PRODUCTO','window.alert(message);');
                    notificacion('Atencion', 'SOLO HAY' + cant +' EN STOCK DE ESTE PRODUCTO', 'window.alert(message);');
                               $('#cant').val(cero);
                            
                           }
                       }
              
                       }
               
     
       
     
   //              function articulo(){
   //                    if (parseInt($('#depo').val()) > 0) {
   //                        $.ajax({
   //                            type: "GET",
   //                            url: "/kamblack/lista_articulos.php?vdep=" + 
   //                                    $('#depo').val (),
   //                            cache: false,
   //                            beforeSend: function () {
   //                                $('#detalles').
   //                            html('<img src="/kamblack/img/cargando.GIF">\n\
   //                            <strong><i>Cargando...</i><strong>');
   //                            },
   //                                    success: function (msg){
   //                                        $('#detalles').html(msg);
   //                                       
   //                                    }
   //                        });
   //                    }
   //                }
   //                
                   $("document").ready(function () {
           articulo();
       });
       function articulo() {
    $.ajax({
        type: "GET",
        url: "/mauro/lista_articulos_ajuste_stock.php",
        cache: false,
        beforeSend: function () {
            $('#detalles').html('<img src="/bulls/img/cargando.GIF">\n\
                               <strong><i>Cargando...</i><strong>');
        },
        success: function (msg) {
            $('#detalles').html(msg);
            obtenercantidad();
        }
    });
}

       function obtenercantidad() {
    var dat = $('#artic').val().split("_");
    if (parseInt($('#artic').val()) > 0) {
        $.ajax({
            type: "GET",
            url: "/mauro/lista_cantidad_ajuste.php?varti=" + dat[0],
            cache: false,
            beforeSend: function () {
                $('#detalle_cantidad').
                        html('<img src="/bulls/img/cargando.GIF">\n\
                        <strong><i>Cargando...</i><strong>');
            },
            success: function (msg) {
                $('#detalle_cantidad').html(msg);
                $('#cant').select();
            }
        });
    }
}

   
       
   </script>
</body>
</html>