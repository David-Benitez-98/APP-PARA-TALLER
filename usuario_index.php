<!DOCTYPE html>
<html>
    <head>
        <link rel="shortcut icon"  href=" img/blackbulls.ico"/>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <title>USUARIOS</title>

        <?php
        require './session_start';
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
                        <h3 class="page-header">LISTADO DE USUARIOS
                            <!--                            <a href="imprimir_usuario.php" 
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
                            $usuarios = consultas::get_datos("select * from v_usuarios
                                         order by cod_usu asc ");
                            if (!empty($usuarios)) {
                                ?>                         
                                <!-- /.panel-heading -->
                                <div class="panel-body">
                                    <div>
                                        <table id="example1" width="100%" class="table table-striped table-bordered table-hover">
                                            <thead>
                                                <tr>
                                                    <th class="text-center">#</th>
                                                    <th class="text-center">Nick</th>                                        
                                                    <th class="text-center">Grupo</th>
                                                    <th class="text-center">Nombre</th>
                                                    <th class="text-center">contraseña</th>
                                                    <th class="text-center">Estado</th>
                                                  
                                                    <th class="text-center">Acciones</th>
                                                </tr>
                                            </thead>
                                            <tbody class="buscar">
                                                <?php foreach ($usuarios as $usuario) { ?> 
                                                    <tr>
                                                        <td class="text-center"><?php echo $usuario['usu_cod']; ?></td>
                                                        <td class="text-center"><?php echo $usuario['usu_nick']; ?></td>
                                                        <td class="text-center"><?php echo $usuario['gru_nombre']; ?></td>
                                                        <td class="text-center"><?php echo $usuario['persona']; ?></td>
                                                        <td class="text-center"><?php echo $usuario['usu_clave']; ?></td>
                                                        <td class="text-center"><?php echo $usuario['usu_estado']; ?></td>
                                                        <td class="text-center">

                                                            <a href="/mauro/paginas.php?vgrup=<?php
                                                            echo $usuario['cod_grupo'] .
                                                            '&vnombre=' . $usuario['gru_nomb'];
                                                            ?>"
                                                               class="btn btn-xs btn-info" rel="tooltip" title="Permisos">
                                                                <span class="glyphicon glyphicon-plus"></span></a>


                                                            <a onclick="editar(<?php
                                                            echo "'" . $usuario['cod_usu'] . "_" .
                                                            $usuario['usu_nick'] . "_" . $usuario['usu_clave'] . "_" .
                                                            $usuario['cod_grupo'] . "_" . $usuario['usu_estado'] . "_" .
                                                            $usuario['cod_personal'] . "_" .$usuario['persona'] . "'";
                                                            ?>)" 
                                                               class="btn btn-xs btn-primary" rel='tooltip' data-title="Editar" 
                                                               data-toggle="modal" data-target="#editar">
                                                                <span class="glyphicon glyphicon-pencil"></span></a>
                                                            <a onclick="borrar(<?php
                                                            echo"'" . $usuario['cod_usu'] . "_" .
                                                            $usuario['usu_nick'] . "'";
                                                            ?>)"
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
                            <div class="modal-dialog modal-lg">
                                <!-- Modal content-->
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" 
                                                data-dismiss="modal" arial-label="Close">x</button>
                                        <h4 class="modal-title"><strong>REGISTRAR USUARIO</strong></h4>
                                    </div>
                                    <form action="usuario_control.php" method="post" accept-charset="utf-8" class="form-horizontal">
                                        <div class="panel-body se">
                                            <input type="hidden" name="accion"  value="1">
                                            <input type="hidden" name="vcod" value="0"/> 
                                            <input type="hidden" name="pagina" value="usuario_index.php">
                                            <input type="hidden" name="vestado" value="ACTIVO">


                                            <div class="form-group">
                                                <label class="col-md-3 control-label">PERSONAL:</label>
                                                <div class="col-md-5">

                                                    <select  required=""name="vpersonal" id="personal" class="form-control">
                                                        <option value="">Seleccione un personal</option>
                                                        <?php
                                                        $personas = consultas::get_datos("select * from v_personal where cod_personal NOT IN (select cod_personal from usuarios)");
                                                        ?> 
                                                        <?php
                                                        if (!empty($personas)) {
                                                            foreach ($personas as $persona) {
                                                                ?>
                                                                <option value="<?= $persona['cod_personal']; ?>">
                                                                <?= $persona['persona']; ?></option>
                                                                <?php
                                                            }
                                                        } else {
                                                            ?>

<?php } ?>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-md-3 control-label">Nick:</label>
                                                <div class="col-md-5">
                                                    <input type="text" required="" 
                                                           placeholder="Ingrese su Nick"  autocomplete="off"
                                                           class="form-control"
                                                           name="vnick"   
                                                           pattern="[A-Za-z]{4,30}" title="SOLO LETRAS !" autofocus="">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-3 control-label">Clave:</label>
                                                <div class="col-md-5">
                                                    <input type="password" required="" placeholder="Ingrese su Clave"  
                                                           class="form-control" name="vclave">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-3 control-label">Grupo:</label>
                                                <div class="col-md-5">

                                                    <select required="" name="vgrup" class="form-control select">
                                                        <option value="">Seleccione un grupo:</option>
                                                        <?php
                                                        $grupos = consultas::get_datos("select * from grupo "
                                                                        . " order by gru_nomb");
                                                        ?> 
                                                        <?php
                                                        if (!empty($grupos)) {
                                                            foreach ($grupos as $grupo) {
                                                                ?>
                                                                <option value="<?php echo $grupo['cod_grupo']; ?>">
                                                                <?php echo $grupo['gru_nomb']; ?></option>
                                                                <?php
                                                            }
                                                        } else {
                                                            ?>
                                                            <option value="">Debe insertar un Grupo:</option>
<?php } ?>
                                                    </select>
                                                </div>
                                            </div>

                                           
                                        </div>

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
                    <!--fin-->
                    <!-- Modal content-->
                    <div id="editar" class="modal fade" role="dialog">
                        <div class="modal-dialog">
                            <!-- Modal content-->
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" 
                                            data-dismiss="modal" arial-label="Close">x</button>
                                    <h4 class="modal-title"><strong>EDITAR USUARIO</strong></h4>
                                </div>

                                <form action="usuario_control.php" method="post" accept-charset="utf-8" class="form-horizontal">
                                    <div class="panel-body">
                                        <input name="accion" value="2" type="hidden"/>
                                        <input type="hidden" name="pagina" value="usuario_index.php">
                                        <input id="cod" type="hidden" name="vcod"/>
                                        <input id="personall"type="hidden" name="vpersonal"
                                               value="vpersonal">
                                        <div class="form-group">
                                            <label class="col-md-3 control-label"> Nick</label>
                                            <div class="col-md-5">
                                                <input type="text" required="" placeholder="Ingrese su Nick"
                                                       class="form-control"
                                                       name="vnick" id="nic">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-3 control-label">Clave</label>
                                            <div class="col-md-5">
                                                <input type="password" id="clav" placeholder="Ingrese su clave"  
                                                       class="form-control" name="vclave" 
                                                       >
                                            </div>
                                        </div>


                                        <div class="form-group">
                                            <label class="col-md-3 control-label">Grupo:</label>
                                            <div class="col-md-5">
                                                    <?php
                                                    $grupos = consultas::get_datos("select * from grupo "
                                                                    . " order by gru_nomb ");
                                                    ?>                                 
                                                <select  id="vgrup" name="vgrup" class="form-control select">
                                                        <?php
                                                        if (!empty($grupos)) {
                                                            foreach ($grupos as $grupo) {
                                                                ?>
                                                            <option value="<?php echo $grupo['cod_grupo']; ?>">
                                                            <?php echo $grupo['gru_nomb']; ?></option>
                                                            <?php
                                                        }
                                                    } else {
                                                        ?>
                                                        <option value="">Debe insertar un grupo</option>
<?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-3 control-label">Nombre</label>
                                            <div class="col-md-5">
                                                <input type="text" required="" 
                                                       placeholder="Ingrese su Nombre" 
                                                       class="form-control" name="vnombre"
                                                       disabled=""id="pers">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-3 control-label ">Sexo:</label>
                                            <div class="row_form">
                                                <div class="radio col-md-8">
                                                    <label>
                                                        <input required="" id="ina" type="radio" name="vestado" value="INACTIVO"> INACTIVO
                                                    </label>
                                                    <label>
                                                        <input  required="" id="act"  type="radio" name="vestado" value="ACTIVO"> ACTIVO
                                                    </label>                                       
                                                </div>
                                            </div>                                  
                                        </div>
                                        
                                        <br>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="reset" data-dismiss="modal" class="btn btn-default pull-left">
                                            <i class="fa fa-close"></i> Cerrar</button>
                                        <button type="submit" class="btn btn-primary pull-right">
                                            <i class="fa fa-refresh"></i> Actualizar</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!--fin-->
                    </ <!--borrar-->
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
                    function editar(datos) {
                        var dat = datos.split("_");
                        $('#cod').val(dat[0]);
                        $('#nic').val(dat[1]);
                        $('#clav').val(dat[2]);
                        $('#grup').val(dat[3]);
                        $('#esta').val(dat[4]);
                        $('#sucur').val(dat[5]);
                        $('#personall').val(dat[6]);
                        $('#pers').val(dat[7]);
                        if (dat[4] == 'INACTIVO') {
                            $('#ina').prop('checked', true);
                        } else {
                            $('#act').prop('checked', true);
                        }

                    }

                    function borrar(datos) {
                        var dat = datos.split("_");
                        $('#si').attr('href'
                                , 'usuario_control.php?vcod=' + dat[0] +
                                '&vnick=null' +
                                '&vclave=null' +
                                '&vgrup=null' +
                                '&vestado=null' +
                                '&vsuc=null' +
                                '&vpersonal=null' +
                                '&accion=3' +
                                '&pagina=usuario_index.php');
                        $('#confirmacion').html('<span class="glyphicon glyphicon-warning-sign"></span>\n\
                    Desea Borrar el Usuario <i><strong>' + dat[1] + '</strong></i>?');
                    }
                </script>
        <!--       <script>
                    function borrar(datos) {
                        var dat = datos.split("_");
                        $('#si').attr('href',
                        'usuario_control.php?vcod=' + dat[0] +
                                '&vnick=null'+
                                '&vclave=null'+
                                '&vgrup=null'+
                                '&vnombre=null'+
                                '&vestado=null'+
                                '&accion=3'+
                                '&pagina=usuario_index.php');
                        $('#confirmacion').html('<span class="glyphicon glyphicon-warning-sign"></span>\n\
                Desea Borrar el Usuario <i><strong>' + dat[1] + '</strong></i> ?'); 
                    }
                            </script>
                -->


                </body>
                </html>




