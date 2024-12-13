<!DOCTYPE html>
<html lang="en">
<head>
        <link rel="shortcut icon"  href=" images/mauro.jpg"/>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <title>CLIENTE</title>

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
                        <h3 class="page-header">LISTADO DE CLIENTES
<!--                            <a href="imprimir_departamento.php" 
                               class="btn btn-primary btn-circle pull-right" 
                               rel="tooltip" data-title="Imprimir" target="_blank">
                                <i class="fa fa-print"></i>
                            </a> -->
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
                            $clientes = consultas::get_datos("select * from v_cliente 
                                         order by cod_cliente asc ");
                            if (!empty($clientes)) {
                                ?>                         
                                <!-- /.panel-heading -->
                                <div class="panel-body">
                                    <div>
                                        <table id="example1" width="100%" class="table table-striped table-bordered table-hover">
                                            <thead>
                                                <tr>
                                                    <th class="text-center">#</th>
                                                    <th class="text-center">CLIENTE</th>                                        
                                                    <th class="text-center">Acciones</th>
                                                </tr>
                                            </thead>
                                            <tbody class="buscar">
                                                <?php foreach ($clientes as $cliente) { ?> 
                                                    <tr>
                                                        <td class="text-center"><?php echo $cliente['cod_cliente']; ?></td>
                                                        <td class="text-center"><?php echo $cliente['persona']; ?></td>
                                                        <td class="text-center">
<!--                                                            <a onclick="editar(<?php echo "'" . $cliente['cod_persona'] . "_" .
                                                                    $cliente['cod_persona'] ."'"; ?>)" 
                                                               class="btn btn-xs btn-primary" rel='tooltip' data-title="Editar" 
                                                               data-toggle="modal" data-target="#editar">
                                                                <span class="glyphicon glyphicon-pencil"></span></a>-->
                                                            <a onclick="borrar(<?php echo "'" . $cliente['cod_cliente'] . "_" . 
                                                                    $cliente['cod_persona']. "'"; ?>)" 
                                                               class="btn btn-xs btn-primary" rel='tooltip' data-title="Borrar"
                                                               data-toggle="modal"
                                                               data-target="#delete">
                                                                <span class="glyphicon glyphicon-trash"></span></a>
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
                    <div class="modal-dialog">
                        <!-- Modal content-->
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" 
                                        data-dismiss="modal" arial-label="Close">x</button>
                                <h4 class="modal-title"><strong>REGISTRAR CLIENTE</strong></h4>
                            </div>
                            <form action="cliente_control.php" method="post" accept-charset="utf-8" class="form-horizontal">
                                <div class="panel-body se">
                                    <input type="hidden" name="accion"  value="1">
                                    <input type="hidden" name="vcod" value="0"/> 
                                    <input type="hidden" name="pagina" value="cliente_index.php">
                              


                                    <div class="form-group">
                                        <label class="col-md-3 control-label">PERSONA:</label>
                                        <div class="col-md-3">
                                            <?php
                                            $personas = consultas::get_datos("select * from v_persona where cod_persona NOT IN(select cod_persona from cliente)");
                                            ?>                                 
                                              <select name="vpers" class="form-control select" required="" style="width: 180%">
                                                  <option value="">Seleccione una persona</option>
                                                <?php
                                                if (!empty($personas)) {
                                                    foreach ($personas as $persona) {
                                                        ?>
                                                        <option value="<?php echo $persona['cod_persona']; ?>">
                                                            <?php echo $persona['persona']; ?></option>
                                                        <?php
                                                    }
                                                } else {
                                                    ?>
                                                    
                                                <?php } ?>
                                            </select> 
                                        </div>
                                        <a   href="persona_index.php" class="btn btn-xs btn- pull-right" rel='tooltip' data-title="REGISTRAR PERSONA" >
                                            <span class="fa fa-plus col-md-3"></span></a>
                                        
                                    </div>

                                </div>



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
                $('#si').attr('href', 'cliente_control.php?vcod=' + dat[0] + '&vpers=' + dat[1]+
                         '&accion=3 &pagina=cliente_index.php');
                $('#confirmacion').html('<span class="glyphicon glyphicon-warning-sign"></span>\n\
            Desea Borrar el cliente ?');
            }
        </script>


    </body>
</html>
</body>
</html>