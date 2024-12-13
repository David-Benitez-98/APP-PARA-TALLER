<!DOCTYPE html>
<html lang="en">
<head>
        <link rel="shortcut icon"  href=" images/mauro"/>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
    <title>Proveedor</title>
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
                        <h3 class="page-header">LISTADO DE PROVEEDOR
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
                            $proveedors = consultas::get_datos("select * from v_proveedor
                                         order by cod_provee asc ");
                            if (!empty($proveedors)) {
                                ?>  
                             <!-- /.panel-heading -->
                                <div class="panel-body">
                                    <div>
                                        <table id="example1" width="100%" class="table table-striped table-bordered table-hover">
                                            <thead>
                                                <tr>
                                                    <th class="text-center">#</th>
                                                    <th class="text-center">RUC</th>                                        
                                                    <th class="text-center">NOMBRE</th>
                                                    <th class="text-center">TELEFONO</th>
                                                    <th class="text-center">CIUDAD</th>
                                                    <th class="text-center">DEPARTAMENTO</th>
                                                    <th class="text-center">ACCIONES</th>
                                                </tr>
                                            </thead>
                                             <tbody class="buscar">
                                                <?php foreach ($proveedors as $proveedor) { ?> 
                                                    <tr>
                                                        <td class="text-center"><?php echo $proveedor['cod_provee']; ?></td>
                                                      <td class="text-center"><?php echo $proveedor['provee_ruc']; ?></td>
                                                      <td class="text-center"><?php echo $proveedor['provee_nomb']; ?></td>
                                                      <td class="text-center"><?php echo $proveedor['provee_tel']; ?></td>
                                                      <td class="text-center"><?php echo $proveedor['ciu_descrip']; ?></td>
                                                      <td class="text-center"><?php echo $proveedor['depar_descrip']; ?></td>
                                                       <td class="text-center"> 
                                                        <a onclick="editar(<?php 
                                                        echo "'" . $proveedor['cod_provee'] . "_" .
                                                        $proveedor['provee_ruc'] . "_" . 
                                                        $proveedor['provee_nomb'] . "_" . $proveedor['provee_tel'] . "_" .
                                                        $proveedor['cod_ciudad'] . "_" . $proveedor['cod_depar'] . "'";
                                                        ?>)"
                                                        class="btn btn-xs btn-primary" rel='tooltip' data-title="Editar"
                                                        data-toggle="modal" data-target="#editar">
                                                            <span class="glyphicon glyphicon-pencil"></span></a>
                                                        <a onclick="borrar(<?php 
                                                        echo "'" .$proveedor['cod_provee'] . "_" .
                                                        $proveedor['provee_ruc'] . "_" .
                                                        $proveedor['provee_nomb'] . "_" . $proveedor['provee_tel'] . "_" .
                                                        $proveedor['cod_ciudad'] . "_" . $proveedor['cod_depar'] . "'";
                                                        ?>)"
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
                    <div class="modal-dialog modal-lg">
                        <!-- Modal content-->
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" 
                                        data-dismiss="modal" arial-label="Close">x</button>
                                <h4 class="modal-title"><strong>Registrar Proveedor</strong></h4>
                            </div>
                            <form action="proveedor_control.php" method="post" accept-charset="utf-8" class="form-horizontal">
                                <div class="panel-body ">
                                    <input type="hidden" name="accion"  value="1">
                                    <input type="hidden" name="vcodprov" value="0"/> 
                                    <input type="hidden" name="pagina" value="proveedor_index.php">
                                    <span class="col-md-1"></span>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label ">RUC:</label>
                                        <div class="col-md-5">
                                            <input type="text" required=""
                                                   placeholder="Ingrese el ruc"  autocomplete="off"
                                                   class="form-control"
                                                   id="ruc" 
                                                   name="vruc" 
                                                   onchange="solo_ruc()"
                                                   onkeyup="solo_ruc()"
                                                   maxlength="11">

                                        </div>
                                    </div>
                                    <br>


                                    <span class="col-md-1"></span>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">Proveedor:</label>
                                        <div class="col-md-5">
                                            <input type="text" required=""
                                                   placeholder="Ingrese el nombre del proveedor"   autocomplete="off"
                                                   class="form-control"
                                                   id="vdescrip"
                                                   name="vprovnombre"
                                                   onchange="sololetras()"
                                                   onkeyup="sololetras()"
                                                   min="3"
                                                   pattern="[A-Za-z #SPACE]{4,30}" >
                                        </div>
                                    </div>
                                    <br>

                                    <span class="col-md-1"></span>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">TELEFONO:</label>
                                        <div class="col-md-5">
                                            <input type="number" required=""
                                                   placeholder="Ingrese el numero de telefono"  autocomplete="off"
                                                   class="form-control" id="celuu"
                                                   name="vtelef" maxlength="15"
                                                   onchange="numerotelefon()"
                                                   onkeyup="numerotelefon()">
                                        </div>
                                    </div>
                                    <br>

                                    <span class="col-md-1"></span>
                                    <div class="form-group">
                                        <label  class="control-label col-md-3">DEPARTAMENTO: </label>
                                        <div class="col-md-5">

                                            <select required="" class="form-control"   name="vdepar" >

                                                <option value="">Seleccione un departamento</option>
                                                <?php
                                                $departamentos = consultas::get_datos("select * from departamento "
                                                                . " order by depar_descrip");
                                                ?> 
                                                <?php
                                                if (!empty($departamentos)) {
                                                    foreach ($departamentos as $departamento) {
                                                        ?>
                                                        <option value="<?php echo $departamento['cod_depar']; ?>" > 
                                                            <?php echo $departamento['depar_descrip']; ?></option>
                                                        <?php
                                                    }
                                                } else {
                                                    ?>
                                                    <option value="">Debe insertar un departamento</option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>



                                    <br>
                                    <span class="col-md-1"></span>
                                    <div class="form-group">
                                        <label  class="control-label col-md-3">CIUDAD: </label>
                                        <div class="col-md-5">

                                            <select required="" class="form-control"   name="vciu" >

                                                <option value="">Seleccione una ciudad</option>
                                                <?php
                                                $ciudads = consultas::get_datos("select * from ciudad "
                                                                . " order by ciu_descrip");
                                                ?> 
                                                <?php
                                                if (!empty($ciudads)) {
                                                    foreach ($ciudads as $ciudad) {
                                                        ?>
                                                        <option value="<?php echo $ciudad['cod_ciudad']; ?>">
                                                            <?php echo $ciudad['ciu_descrip']; ?></option>
                                                        <?php
                                                    }
                                                } else {
                                                    ?>
                                                    <option value="">Debe insertar una ciudad</option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>



                                    <br>
                                    <br

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
                <div class="modal-dialog modal-lg">
                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" 
                                    data-dismiss="modal" arial-label="Close">x</button>
                            <h4 class="modal-title"><strong>EDITAR PROVEEDOR</strong></h4>
                        </div>
                        <form action="proveedor_control.php" method="post" accept-charset="utf-8" class="form-horizontal">
                            <div class="panel-body">
                                <input name="accion" value="2" type="hidden"/>
                                <input type="hidden" name="pagina" value="proveedor_index.php">
                                <input id="cod" type="hidden" name="vcodprov"/>
                                <span class="col-md-1"></span>
                                <div class="form-group">
                                    <label class="col-md-3 control-label ">RUC:</label>
                                    <div class="col-md-5">
                                        <input type="text" required=""
                                               placeholder="Ingrese el ruc"  autocomplete="off"
                                               class="form-control"
                                               id="rucED" 
                                               name="vruc" 
                                               onchange="editar_ruc()"
                                               onkeyup="editar_ruc()"
                                               maxlength="11"  >

                                    </div>
                                </div>
                                <br>
                                  <span class="col-md-1"></span>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">PROVEEDOR:</label>
                                        <div class="col-md-5">
                                            <input type="text" required=""
                                                   placeholder="Ingrese el nombre del proveedor"   autocomplete="off"
                                                   class="form-control"
                                                   id="nomb"
                                                   name="vprovnombre"
                                                   onchange="editarpersona()"
                                                   onkeyup="editarpersona()"
                                                   min="3"
                                                   pattern="[A-Za-z #SPACE]{4,30}">
                                        </div>
                                    </div>
                                    <br>
                                     <span class="col-md-1"></span>
                             
                                    
                                   
                                      <div class="form-group">
                                        <label class="col-md-3 control-label">TELEFONO:</label>
                                        <div class="col-md-5">
                                            <input type="number" 
                                                   placeholder="Ingrese el numero de telefono"  autocomplete="off"
                                                   class="form-control" id="tele"
                                                   name="vtelef" maxlength="15"
                                                   onchange="editartel1()"
                                                   onkeyup="editartel1()" >
                                        </div>
                                   </div>                                   
                                    <br>

                             <span class="col-md-1"></span>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">DEPARTAMENTO:</label>
                                    <div class="col-md-5">
                                        <?php
                                        $departamentos = consultas::get_datos("select * from departamento "
                                                        . " order by depar_descrip");
                                        ?>                                 
                                        <select  id="depar" name="vdepar" class="form-control select">
                                            <?php
                                            if (!empty($departamentos)) {
                                                foreach ($departamentos as $departamento) {
                                                    ?>
                                                    <option value="<?php echo $departamento['cod_depar']; ?>">
                                                        <?php echo $departamento['depar_descrip']; ?></option>
                                                    <?php
                                                }
                                            } else {
                                                ?>
                                                <option value="">Debe insertar un departamento</option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <br>
                                <span class="col-md-1"></span>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">CIUDAD:</label>
                                    <div class="col-md-5">
                                        <?php
                                        $ciudads = consultas::get_datos("select * from ciudad "
                                                        . " order by ciu_descrip");
                                        ?>                                 
                                        <select id="ciu" name="vciu" class="form-control select">
                                            <?php
                                            if (!empty($ciudads)) {
                                                foreach ($ciudads as $ciudad) {
                                                    ?>
                                                    <option value="<?php echo $ciudad['cod_ciudad']; ?>">
                                                        <?php echo $ciudad['ciu_descrip']; ?></option>
                                                    <?php
                                                }
                                            } else {
                                                ?>
                                                <option value="">Debe insertar una ciudad</option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>





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

            function editar_ruc() {
                var numero = document.getElementById("rucED").value;
               if (numero.match(/^-?[0-9--]+(\.[0-9--](1,2))?$/))
                {

                } else {
                    notificacion('Atencion', 'No se permiten letras o espacios', 'window.alert(message);');
//                    notificacion("Solo numeros");
                    document.getElementById("rucED").value = "";

                }
            }

            function editarpersona() {
//                      var numero = trim(numero);
                var numero = document.getElementById("nomb").value;
                if (numero.length === 0 || numero === " ") {
                    notificacion('Atencion', 'No se permiten campos vacios', 'window.alert(message);');
                    document.getElementById("nomb").value = "";


                } else {

                }
            }

            function editartel1() {
                var numero = document.getElementById("tele").value;
                if (numero.match(/^-?[0-9]+(\.[0-9](1,2))?$/))
                {

                } else {
                    notificacion('Atencion', 'No se permiten letras o espacios', 'window.alert(message);');
//                    notificacion("Solo numeros");

                    document.getElementById("tele").value = "";
                }
            }

            function editar(datos) {
                var dat = datos.split("_");
                $('#cod').val(dat[0]);
                $('#rucED').val(dat[1]);
                $('#nomb').val(dat[2]);
                $('#tele').val(dat[3]);
                $('#ciu').val(dat[4]);
                $('#depar').val(dat[5]);
                
         

            }

            function solo_ruc() {
                var numero = document.getElementById("ruc").value;
                if (numero.match(/^-?[0-9--]+(\.[0-9--](1,2))?$/))
                {

                } else {
                    notificacion('Atencion', 'No se permiten letras o espacios', 'window.alert(message);');
//                    notificacion("Solo numeros");
                    document.getElementById("ruc").value = "";

                }
            }

            function sololetras() {
//                      var numero = trim(numero);
                var numero = document.getElementById("vdescrip").value;
                if (numero.length === 0 || numero === " " ) {
                    notificacion('Atencion', 'No se permiten campos vacios', 'window.alert(message);');
                    document.getElementById("vdescrip").value = "";


                } else {

                }
            }

            function numerotelefon() {
                var numero = document.getElementById("celuu").value;
                if (numero.match(/^-?[0-9]+(\.[0-9](1,2))?$/))
                {

                } else {
                    notificacion('Atencion', 'No se permiten letras o espacios', 'window.alert(message);');
//                    notificacion("Solo numeros");

                    document.getElementById("celuu").value = "";
                }
            }
            function borrar(datos) {
                var dat = datos.split("_");
                $('#si').attr('href', 'proveedor_control.php?vcodprov=' + dat[0]
                        + '&vruc=' + dat[1]
                        + '&vprovnombre=' + dat[2]
                        + '&vtelef=' + dat[3]
                        + '&vciu=' + dat[4]
                        + '&vdepar= ' + dat[5]

                        + '&accion=3&pagina=proveedor_index.php');
                $('#confirmacion').html('<span class="glyphicon glyphicon-warning-sign"></span>\n\
            ¿Desea Borrar el Proveedor? <i><strong>' + dat[1] + '</strong></i>?');
            }
          



        </script>

    
</body>
</html>