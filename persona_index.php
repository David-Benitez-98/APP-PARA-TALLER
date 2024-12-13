<!DOCTYPE html>
<html>
    <head>
        <link rel="shortcut icon"  href=" images/mauro"/>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <title>PERSONAS</title>

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
                        <h3 class="page-header">LISTADO DE PERSONA
                            <!--                            <a href="imprimir_ciudad.php" 
                                                           class="btn btn-primary btn-circle pull-right" 
                                                           rel="tooltip" data-title="Imprimir" target="_blank">
                                                            <i class="fa fa-print"></i>
                                                        </a> -->
                             <a   href="cliente_index.php" class="btn btn-xs btn- pull-right" rel='tooltip' data-title="Direccion Cliente" >
                                            <span class="fa fa-plus col-md-3"></span></a>
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
                            $personas = consultas::get_datos("select * from v_persona
                                         order by cod_persona asc");
                            if (!empty($personas)) {
                                ?>                         
                                <!-- /.panel-heading -->
                                <div class="panel-body">
                                    <div>
                                        <table id="example1" width="100%" class="table table-striped table-bordered table-hover">
                                            <thead>
                                                <tr>
                                                    <th class="text-center">#</th>
                                                    <th class="text-center">PERSONA</th>                                        
                                                    <th class="text-center">C.I</th>
                                                    <th class="text-center">FECHA NACIMIENTO</th>
                                                    <th class="text-center">TELEFONO 1</th>
                                                    <th class="text-center">TELEFONO 2</th>
                                                    <th class="text-center">EMAIL</th>
                                                    <th class="text-center">CIUDAD</th>
                                                    <th class="text-center">DEPARTAMENTO</th>
                                                    <th class="text-center">ACCIONES</th>
                                                </tr>
                                            </thead>
                                            <tbody class="buscar">
                                                <?php foreach ($personas as $persona) { ?> 
                                                    <tr>
                                                        <td class="text-center"><?php echo $persona['cod_persona']; ?></td>
                                                        <td class="text-center"><?php echo $persona['persona']; ?></td>
                                                        <td class="text-center"><?php echo $persona['per_ci']; ?></td>
                                                        <td class="text-center"><?php echo $persona['per_fecha_nac']; ?></td>
                                                        <td class="text-center"><?php echo $persona['per_tel']; ?></td>
                                                        <td class="text-center"><?php echo $persona['per_tel2']; ?></td>
                                                        <td class="text-center"><?php echo $persona['per_email']; ?></td>
                                                        <td class="text-center"><?php echo $persona['ciu_descrip']; ?></td>
                                                        <td class="text-center"><?php echo $persona['depar_descrip']; ?></td>
                                                        <td class="text-center">

                                                            <!--                                                            <a  
                                                                                                                            href="persona_editar.php?vcodper=<?php echo $persona['cod_persona']; ?>"
                                                                                                                            class="btn btn-xs btn-primary" rel='tooltip' data-title="Editar" >
                                                                                                                            <span class="glyphicon glyphicon-pencil"></span></a>-->
                                                            <a onclick="editar(<?php
                                                            echo "'" . $persona['cod_persona'] . "_" .
                                                            $persona['per_nombre'] . "_" . $persona['per_apellido'] . "_" .
                                                            $persona['per_ci'] . "_" . $persona['per_sexo'] . "_" .
                                                            $persona['per_fecha_nac'] . "_" . $persona['per_direc'] . "_" .
                                                            $persona['per_tel'] . "_" . $persona['per_tel2'] . "_" .
                                                            $persona['per_email'] . "_" . $persona['cod_depar'] . "_" .
                                                            $persona['cod_ciudad'] . "'";
                                                            ?>)" 
                                                               class="btn btn-xs btn-primary" rel='tooltip' data-title="Editar" 
                                                               data-toggle="modal" data-target="#editar">
                                                                <span class="glyphicon glyphicon-pencil"></span></a>
                                                            <a onclick="borrar(<?php
                                                            echo "'" . $persona['cod_persona'] . "_" .
                                                            $persona['per_nombre'] . "_" . $persona['per_apellido'] . "_" .
                                                            $persona['per_ci'] . "_" . $persona['per_sexo'] . "_" .
                                                            $persona['per_fecha_nac'] . "_" . $persona['per_direc'] . "_" .
                                                            $persona['per_tel'] . "_" . $persona['per_tel2'] . "_" .
                                                            $persona['per_email'] . "_" . $persona['cod_depar'] . "_" .
                                                            $persona['cod_ciudad'] . "'";
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
                                <h4 class="modal-title"><strong>Registrar Persona</strong></h4>
                            </div>
                            <form action="persona_control.php" method="post" accept-charset="utf-8" class="form-horizontal">
                                <div class="panel-body ">
                                    <input type="hidden" name="accion"  value="1">
                                    <input type="hidden" name="vcodper" value="0"/> 
                                    <input type="hidden" name="pagina" value="persona_index.php">

                                    <div class="form-group">
                                        <label class="col-md-3 control-label ">NOMBRE:</label>
                                        <div class="col-md-5">
                                            <input type="text" required=""
                                                   placeholder="Ingrese el nombre"  autocomplete="off"
                                                   class="form-control"
                                                   id="nombre" 
                                                   name="vpernomb" 
                                                   onchange="sololetras()"
                                                   onkeyup="sololetras()"
                                                   pattern="[A-Za-z #SPACE]{4,30}"  >

                                        </div>
                                    </div>
                                    <br>

                                    <div class="form-group">
                                        <label class="col-md-3 control-label">APELLIDO:</label>
                                        <div class="col-md-5">
                                            <input type="text" required=""
                                                   placeholder="Ingrese el apellido"  autocomplete="off"
                                                   class="form-control"
                                                   id="apellidoo"
                                                   name="vperapelli"
                                                   onchange="sololetrasape()"
                                                   onkeyup="sololetrasape()"
                                                   pattern="[A-Za-z #SPACE]{4,30}" title="SOLO LETRAS !" autofocus="">
                                        </div>
                                    </div>
                                    <br>


                                    <div class="form-group">
                                        <label class="col-md-3 control-label">C.I:</label>
                                        <div class="col-md-5">
                                            <input type="number" required=""
                                                   placeholder="Ingrese el numero de ci"   autocomplete="off"
                                                   class="form-control"
                                                   id="cii"
                                                   name="vperci"
                                                   onchange="solo_ci()"
                                                   onkeyup="solo_ci()"
                                                   maxlength="8">
                                        </div>
                                    </div>
                                    <br>

                                    <div class="form-group">
                                        <label class="col-md-3 control-label">SEXO:</label>
                                        <div class="row">
                                            <div class="radio col-md-8">
                                                <label>
                                                    <input  required=""type="radio" name="vpersexo" value="M"> Masculino
                                                </label>
                                                <label>
                                                    <input  required=""type="radio" name="vpersexo" value="F"> Femenino
                                                </label>                                       
                                            </div>
                                        </div>                                  
                                    </div>
                                    <br>

                                    <div class="form-group">
                                        <label class="col-md-3 control-label">FECHA NAC.</label>
                                        <div class="col-md-5">
                                            <input type="date" required="" id="fec"
                                                   placeholder="Ingrese fecha nacimiento"  
                                                   class="form-control"
                                                   onchange="validar()"
                                                   name="vperfn">
                                        </div>
                                    </div>
                                    <br>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">DIRECCION:</label>
                                        <div class="col-md-5">
                                            <input type="text" required="" 
                                                   placeholder="Ingrese la direccion"  autocomplete="off"
                                                   class="form-control"
                                                   id="direccionn"
                                                   name="vperdirec"
                                                      onchange="sololetras1()"
                                                   onkeyup="sololetras1()"
                                                   pattern="[A-Za-z and 0-9 and #SPACE]{4,100}"title="SOLO LETRAS Y NUMEROS" autofocus="">
                                        </div>
                                    </div>
                                    <br>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">TELEFONO 1:</label>
                                        <div class="col-md-5">
                                            <input type="number" required=""
                                                   placeholder="Ingrese el numero de telefono"  autocomplete="off"
                                                   class="form-control" id="celuu"
                                                   name="vpertelef" maxlength="15"
                                                   onchange="numerotelefon()"
                                                   onkeyup="numerotelefon()">
                                        </div>
                                    </div>
                                    <br>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">TELEFONO 2:</label>
                                        <div class="col-md-5">
                                            <input type="number" 
                                                   placeholder="Ingrese el numero de telefono"  autocomplete="off"
                                                   class="form-control" id="celu"
                                                   name="vpertelef2" maxlength="15"
                                                     onchange="numerotelefono()"
                                                   onkeyup="numerotelefono()" >
                                        </div>
                                    </div>
                                    <br>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">EMAIL:</label>
                                        <div class="col-md-5">
                                            <input type="email" required="" autocomplete="off" id="maul"
                                                   placeholder="Ingrese la direccion de email"  
                                                   class="form-control"
                                                   name="vperemail"
                                                   onchange="solomail()"
                                                   onkeyup="solomail()"
                                                   pattern="[A-Za-z and 0-9 and #SPACE and @ and ._]{4,100}">
                                        </div>
                                         
                                    </div>
                                    <br>
                                    <div class="form-group">
                                        <label  class="control-label col-md-3">DEPARTAMENTO: </label>
                                        <div class="col-md-5">

                                            <select required="" class="form-control"   name="vperdepart" >

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
                                    <div class="form-group">
                                        <label  class="control-label col-md-3">CIUDAD: </label>
                                        <div class="col-md-5">

                                            <select required="" class="form-control"   name="vperciu" >

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
                <div class="modal-dialog modal-lg">
                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" 
                                    data-dismiss="modal" arial-label="Close">x</button>
                            <h4 class="modal-title"><strong>EDITAR PERSONA</strong></h4>
                        </div>
                        <form action="persona_control.php" method="post" accept-charset="utf-8" class="form-horizontal">
                            <div class="panel-body">
                                <input name="accion" value="2" type="hidden"/>
                                <input type="hidden" name="pagina" value="persona_index.php">
                                <input id="cod" type="hidden" name="vcodper"/>

                                <div class="form-group">
                                    <label class="col-md-3 control-label">NOMBRE</label>
                                    <div class="col-md-5">
                                        <input type="text" required="" id="nomb"
                                               placeholder="Ingrese su nombre"  
                                               class="form-control"
                                               name="vpernomb"
                                               onchange="editarpersona"
                                               onkeyup="editarpersona()"
                                               pattern="[A-Za-z #SPACE]{4,30}" title="SOLO LETRAS !" 
                                               value="<?php echo $persona[0]['per_nombre']; ?>" autofocus="">
                                    </div>
                                </div>
                                <br>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">APELLIDO:</label>
                                    <div class="col-md-5">
                                        <input type="text" required="" id="ape"
                                               placeholder="Ingrese su apellido"  
                                               class="form-control"
                                               name="vperapelli"
                                               onchange="editarpersonaape()"
                                               onkeyup="editarpersonaape()"
                                               pattern="[A-Za-z #SPACE]{4,30}" title="SOLO LETRAS !" 
                                               value="<?php echo $persona[0]['per_apellido']; ?>" autofocus="">
                                    </div>
                                </div>
                                <br>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">CI:</label>
                                    <div class="col-md-5">
                                        <input type="number" required="" id="cedula"
                                               placeholder="Ingrese su cedula de identidad"  
                                               class="form-control"
                                               name="vperci" maxlength="8"
                                               onchange="editar_ci()"
                                               onkeyup="editar_ci()"
                                               value="<?php echo $persona[0]['per_ci']; ?>" autofocus="">
                                    </div>
                                </div>
                                <br>
                                <div class="form-group">
                                    <label class="col-md-3 control-label ">Sexo:</label>
                                    <div class="row_form">
                                        <div class="radio col-md-8">
                                            <label>
                                                <input required="" id="sexa" type="radio" name="vpersexo" value="M"> M
                                            </label>
                                            <label>
                                                <input  required="" id="sexi"  type="radio" name="vpersexo" value="F"> F
                                            </label>                                       
                                        </div>
                                    </div>                                  
                                </div>
                                <br>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">FECHA NAC.:</label>
                                    <div class="col-md-5">
                                        <input type="date" required="" id="fn"
                                               placeholder="Ingrese fecha nacimiento"  
                                               class="form-control"
                                               name="vperfn" onchange="editarfecha()"onkeyup="editarfecha()"
                                               value="<?php echo $persona[0]['per_fecha_nac']; ?>">
                                    </div>
                                </div>
                                <br>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">DIRECCION:</label>
                                    <div class="col-md-5">
                                        <input type="text" required="" id="direc"
                                               placeholder="Ingrese su direccion"  
                                               class="form-control"
                                               onchange="editardirecc()" onkeyup="editardirecc()"
                                               name="vperdirec" pattern="[A-Za-z and 0-9 and #SPACE]{4,100}"title="SOLO LETRAS Y NUMEROS"
                                               value="<?php echo $persona[0]['per_direc']; ?>" autofocus="">
                                    </div>
                                </div>
                                <br>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">TELEFONO:</label>
                                    <div class="col-md-5">
                                        <input type="number" required="" id="telef1"
                                               placeholder="Ingrese su numero de telefono"  
                                               class="form-control"
                                               name="vpertelef"
                                               onchange="editartel1()"
                                               onkeyup="editartel1()"
                                               value="<?php echo $persona[0]['per_tel']; ?>" autofocus="">
                                    </div>
                                </div>
                                <br>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">TELEFONO 2:</label>
                                    <div class="col-md-5">
                                        <input type="number" id="telf2"
                                               placeholder="Ingrese su numero de telefono"  
                                               class="form-control"
                                               name="vpertelef2"
                                               onchange="editartel2()"
                                               onkeyup="editartel2()"
                                               value="<?php echo $persona[0]['per_tel2']; ?>" autofocus="">
                                    </div>
                                </div>
                                <br>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">EMAIL:</label>
                                    <div class="col-md-5">
                                        <input type="text" required="" id="mail"
                                               placeholder="Ingrese su direccion de correo electronico"  
                                               class="form-control"
                                               name="vperemail"
                                               onchange="editarmail()"
                                               onkeyup="editarmail()"
                                               value="<?php echo $persona[0]['per_email']; ?>" autofocus="">
                                    </div>
                                </div>
                                <br>


                                <div class="form-group">
                                    <label class="col-md-3 control-label">DEPARTAMENTO:</label>
                                    <div class="col-md-5">
                                        <?php
                                        $departamentos = consultas::get_datos("select * from departamento "
                                                        . " order by depar_descrip");
                                        ?>                                 
                                        <select  id="depar" name="vperdepart" class="form-control select">
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
                                <div class="form-group">
                                    <label class="col-md-3 control-label">CIUDAD:</label>
                                    <div class="col-md-5">
                                        <?php
                                        $ciudads = consultas::get_datos("select * from ciudad "
                                                        . " order by ciu_descrip");
                                        ?>                                 
                                        <select id="ciu" name="vperciu" class="form-control select">
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
	     function editarpersona() {
//                      var numero = trim(numero);
                var numero = document.getElementById("nomb").value;
                if (numero.length === 0 || numero === " ") {
                    notificacion('Atencion', 'No se permiten campos vacios', 'window.alert(message);');
                    document.getElementById("nomb").value = "";
                 
                   
                } else {

                }
            }
                 function editarpersonaape() {
//                      var numero = trim(numero);
                var numero = document.getElementById("ape").value;
                if (numero.length === 0 || numero === " ") {
                    notificacion('Atencion', 'No se permiten campos vacios', 'window.alert(message);');
                    document.getElementById("ape").value = "";
                 
                   
                } else {

                }
            }
      function editar_ci() {
                var numero = document.getElementById("cedula").value;
                if (numero.match(/^-?[0-9]+(\.[0-9](1,2))?$/))
                {

                } else {
                    notificacion('Atencion', 'No se permiten letras o espacios', 'window.alert(message);');
//                    notificacion("Solo numeros");
                    document.getElementById("cedula").value = "";
        
                }
            }
                function editarfecha() {
                var hoy = new Date();
                var fechaFormulario = new Date($('#fn').val());
                if (fechaFormulario >= hoy) {
                    notificacion('Atencion', 'Fecha superior al actual!!!', 'window.alert(message);');
//                    notificacion('Fecha superior al actual!!!');
//                    $('#fecha').val(hoy);
                    $('#fn').val(hoy);
                } else {

                }
            }
                function editardirecc() {
//                      var numero = trim(numero);
                var numero = document.getElementById("direc").value;
                if (numero.length === 0 || numero === " ") {
                    notificacion('Atencion', 'No se permiten campos vacios', 'window.alert(message);');
                   
                    document.getElementById("direc").value = "";
                } else {

                }
            }
                   function editartel1() {
                var numero = document.getElementById("telef1").value;
                if (numero.match(/^-?[0-9]+(\.[0-9](1,2))?$/))
                {

                } else {
                    notificacion('Atencion', 'No se permiten letras o espacios', 'window.alert(message);');
//                    notificacion("Solo numeros");
                 
                    document.getElementById("telef1").value = "";
                }
            }
                  function editartel2() {
                var numero = document.getElementById("telf2").value;
                if (numero.match(/^-?[0-9]+(\.[0-9](1,2))?$/))
                {

                } else {
                    notificacion('Atencion', 'No se permiten letras o espacios', 'window.alert(message);');
//                    notificacion("Solo numeros");
                 
                    document.getElementById("telf2").value = "";
                }
            }
            function editarmail() {
//                      var numero = trim(numero);
                var numero = document.getElementById("mail").value;
                if (numero.length === 0 || numero === " ") {
                    notificacion('Atencion', 'No se permiten campos vacios', 'window.alert(message);');
                   
                    document.getElementById("mail").value = "";
                } else {

                }
            }
            function editar(datos) {
                var dat = datos.split("_");
                $('#cod').val(dat[0]);
                $('#nomb').val(dat[1]);
                $('#ape').val(dat[2]);
                $('#cedula').val(dat[3]);
                $('#sex').val(dat[4]);
                $('#fn').val(dat[5]);
                $('#direc').val(dat[6]);
                $('#telef1').val(dat[7]);
                $('#telf2').val(dat[8]);
                $('#mail').val(dat[9]);
                $('#depar').val(dat[10]);
                $('#ciu').val(dat[11]);

                if (dat[4] == 'M') {
                    $('#sexa').prop('checked', true);
                } else {
                    $('#sexi').prop('checked', true);
                }

//                $('#porc)'.val(dat[2]).trigger('change');
//                console.log(dat[2]);

            }

            function sololetras() {
//                      var numero = trim(numero);
                var numero = document.getElementById("nombre").value;
                if (numero.length === 0 || numero === " ") {
                    notificacion('Atencion', 'No se permiten campos vacios', 'window.alert(message);');
                    document.getElementById("nombre").value = "";
                    
                    
                } else {

                }
            }
               function sololetrasape() {
//                      var numero = trim(numero);
                var numero = document.getElementById("apellidoo").value;
                if (numero.length === 0 || numero === " ") {
                    notificacion('Atencion', 'No se permiten campos vacios', 'window.alert(message);');
               
                    document.getElementById("apellidoo").value = "";
                    
                } else {

                }
            }
              function sololetras1() {
//                      var numero = trim(numero);
                var numero = document.getElementById("direccionn").value;
                if (numero.length === 0 || numero === " ") {
                    notificacion('Atencion', 'No se permiten campos vacios', 'window.alert(message);');
                   
                    document.getElementById("direccionn").value = "";
                } else {

                }
            }
                function solomail() {
//                      var numero = trim(numero);
                var numero = document.getElementById("maul").value;
                if (numero.length === 0 || numero === " ") {
                    notificacion('Atencion', 'No se permiten campos vacios', 'window.alert(message);');
                   
                    document.getElementById("maul").value = "";
                } else {

                }
            }
            function solo_ci() {
                var numero = document.getElementById("cii").value;
                if (numero.match(/^-?[0-9]+(\.[0-9](1,2))?$/))
                {

                } else {
                    notificacion('Atencion', 'No se permiten letras o espacios', 'window.alert(message);');
//                    notificacion("Solo numeros");
                    document.getElementById("cii").value = "";
        
                }
            }
               function numerotelefono() {
                var numero = document.getElementById("celu").value;
                if (numero.match(/^-?[0-9]+(\.[0-9](1,2))?$/))
                {

                } else {
                    notificacion('Atencion', 'No se permiten letras o espacios', 'window.alert(message);');
//                    notificacion("Solo numeros");
                 
                    document.getElementById("celu").value = "";
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
            function validar() {
                var hoy = new Date();
                var fechaFormulario = new Date($('#fec').val());
                if (fechaFormulario >= hoy) {
                    notificacion('Atencion', 'Fecha superior al actual!!!', 'window.alert(message);');
//                    notificacion('Fecha superior al actual!!!');
//                    $('#fecha').val(hoy);
                    $('#fec').val(hoy);
                } else {

                }
            }

            function borrar(datos) {
                var dat = datos.split("_");
                $('#si').attr('href', 'persona_control.php?vcodper=' + dat[0]
                        + '&vpernomb=' + dat[1]
                        + '&vperapelli=' + dat[2]
                        + '&vperci=' + dat[3]
                        + '&vpersexo=' + dat[4]
                        + '&vperfn= ' + dat[5]
                        + '&vperdirec=' + dat[6]
                        + '&vpertelef=' + dat[7]
                        + '&vpertelef2=' + dat[8]
                        + '&vperemail= ' + dat[9]
                        + '&vperdepart=' + dat[10]
                        + '&vperciu=' + dat[11]
                        + '&accion=3&pagina=persona_index.php');
                $('#confirmacion').html('<span class="glyphicon glyphicon-warning-sign"></span>\n\
            Desea Borrar la Persona <i><strong>' + dat[1] + '</strong></i>?');
            }
        </script>


    </body>
</html>
