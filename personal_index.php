<!DOCTYPE html>
<html>
    <head>
        <link rel="shortcut icon"  href=" images/mauro"/>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <title>PERSONAL</title>

        <?php
        require './session_start.php';
        require './anular_sesion.php';
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
                        <h3 class="page-header">LISTADO DE PERSONAL
<!--                            <a href="imprimir_remera.php" 
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
                <div class="row">
                    <div class="col-lg-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                Datos
                            </div>
                            <?php
                            $personals = consultas::get_datos("select * from v_personal
                                         order by cod_personal asc ");
                            if (!empty($personals)) {
                                ?>  
                             <!-- /.panel-heading -->
                                <div class="panel-body">
                                    <div>
                                        <table id="example1" width="100%" class="table table-striped table-bordered table-hover">
                                            <thead>
                                                <tr>
                                                    <th class="text-center">#</th>
                                                    <th class="text-center">NOMBRE</th>                                        
                                                    <th class="text-center">CARGO</th>
                                                    <th class="text-center">ACCIONES</th>
                                                </tr>
                                            </thead>
                                             <tbody class="buscar">
                                                <?php foreach ($personals as $personal) { ?> 
                                                    <tr>
                                                        <td class="text-center"><?php echo $personal['cod_personal']; ?></td>
                                                        <td class="text-center"><?php echo $personal['persona']; ?></td>
                                                      <td class="text-center"><?php echo $personal['descrip_cargo']; ?></td>
                                                       <td class="text-center">
                                                          <a onclick="editar(<?php echo "'" . $personal['cod_personal'] . "_" .$personal['cod_persona'] . "_" .
                                                                    $personal['cod_cargo'] . "'"; ?>)" 
                                                               class="btn btn-xs btn-primary" rel='tooltip' data-title="Editar" 
                                                               data-toggle="modal" data-target="#editar">
                                                                <span class="glyphicon glyphicon-pencil"></span></a>
                                                                 <a onclick="borrar(<?php echo"'". $personal['cod_personal']."_".
                                                                    $personal['persona']."'";?>)"
                                                                    data-toggle="modal" data-target="#delete"
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
                         <!--registrar-->
                <div id="registrar" class="modal fade" role="dialog">
                    <div class="modal-dialog ">
                        <!-- Modal content-->
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" 
                                        data-dismiss="modal" arial-label="Close">x</button>
                                <h4 class="modal-title"><strong>Registrar Personal</strong></h4>
                            </div>
                            <form action="personal_control.php" method="post" accept-charset="utf-8" class="form-horizontal">
                                <div class="panel-body ">
                               <input type="hidden" name="accion" value="1">
                                <input type="hidden" name="vcodper" value="0">
                                <input type="hidden" name="pagina" value="personal_index.php">

                                   <div class="form-group">
                                    <label class="col-md-4 control-label">PERSONA:</label>
                                    <div class="col-md-5">
                                        <?php
                                        $personas = consultas::get_datos("select * from v_persona where cod_persona NOT IN(select cod_persona from personal)" );
                                        ?>                                 
                                        <select name="vperperso"   class="form-control" required="">
                                             <option value="">Seleccione un codigo</option>
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
                                </div>
                                <br>
                                 <div class="form-group">
                                        <label  class="control-label col-md-4">CARGO: </label>
                                        <div class="col-md-5">

                                            <select required="" class="form-control"   name="vpercargo" >

                                                <option value="">Seleccione un cargo</option>
                                                <?php
                                                
                                                  $cargos = consultas::get_datos("select * from cargo "
                                                        . " order by cod_cargo");
                                                ?> 
                                                 <?php if (!empty($cargos)) {
                                                foreach ($cargos as $cargo) { ?>
                                                    <option value="<?php echo $cargo['cod_cargo']; ?>" > 
                                                        <?php echo $cargo['descrip_cargo']; ?></option>
                                                <?php } 
                                                     } else {
                                                    ?>
                                                    <option value="">Debe insertar un cargo</option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
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
            </div>
            <!--fin-->
            <!--editar-->
            <div id="editar" class="modal fade" role="dialog">
                <div class="modal-dialog">
                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" 
                                    data-dismiss="modal" arial-label="Close">x</button>
                            <h4 class="modal-title"><strong>Editar persponal</strong></h4>
                        </div>
                        <form action="personal_control.php" method="post" accept-charset="utf-8" class="form-horizontal">
                            <div class="panel-body">
                                <input name="accion" value="2" type="hidden"/>
                                <input type="hidden" name="vperperso" id="per">
                                <input type="hidden" name="pagina" value="personal_index.php">
                                <input id="cod" type="hidden" name="vcodper"/>
                                 
                                 <div class="form-group">
                                        <label  class="control-label col-md-3">CARGO: </label>
                                        <div class="col-md-5">

                                            <select   id="car" required="" class="form-control"   name="vpercargo" >

                                                
                                                <?php
                                                
                                                $cargoss = consultas::get_datos("select * from cargo "
                                                        . " order by cod_cargo ");
                                                ?> 
                                              <?php
                                                if (!empty($cargoss)) {
                                                    foreach ($cargoss as $cargos) {
                                                        ?>
                                                        <option value="<?php echo $cargos['cod_cargo']; ?>">
                                                            <?php echo $cargos['descrip_cargo']; ?></option>
                                                        <?php
                                                    }
                                                     } else {
                                                    ?>
                                                    <option value="">Debe insertar un cargo</option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                               
                                
                                <br>
                            
                            <div class="modal-footer">
                                <button type="reset" data-dismiss="modal" class="btn btn-default pull-left">
                                    <i class="fa fa-close"></i> Cerrar</button>
                                <button type="submit" class="btn btn-primary pull-right">
                                    <i class="fa fa-refresh"></i> Actualizar</button>
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

<  <script>
            function borrar(datos) {
                var dat = datos.split("_");
                $('#si').attr('href',
                'personal_control.php?vcodper=' + dat[0] +
                       '&vpercargo=null'+
                        '&vperperso=null'+
                        '&accion=3'+
                        '&pagina=personal_index.php');
                $('#confirmacion').html('<span class="glyphicon glyphicon-warning-sign"></span>\n\
        DESEA BORRAR AL PERSONAL <i><strong>' + dat[1] + '</strong></i> ?'); 
            }
                function editar(datos) {
                var dat = datos.split("_");
                $('#cod').val(dat[0]);
                $('#per').val(dat[1]);
                $('#car').val(dat[2]);

            }
            
           
                    </script>
                    
   


    </body>
</html>