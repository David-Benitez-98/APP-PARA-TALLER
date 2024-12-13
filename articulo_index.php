<!DOCTYPE html>
<html lang="en">
<head>
<link rel="shortcut icon"  href=" images/mauro.jpg"/>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <title>ARTICULOS</title>

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
                        <h3 class="page-header">LISTADO DE ARTICULOS
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
              

                <div class="row">
                    <div class="col-lg-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                Datos
                            </div>
                            <?php
                            $articulos = consultas::get_datos("select * from v_articulo
                                         order by cod_arti asc ");
                            if (!empty($articulos)) {
                                ?>  
                             <!-- /.panel-heading -->
                                <div class="panel-body">
                                    <div>
                                        <table id="example1" width="100%" class="table table-striped table-bordered table-hover">
                                            <thead>
                                                <tr>
                                                    <th class="text-center">#</th>                                       
                                                    <th class="text-center">DESCRIPCION</th>
                                                    <th class="text-center">PRECIO</th>
                                                    <th class="text-center">IMPUESTO</th>
                                                    <th class="text-center">ACCIONES</th>
                                                </tr>
                                            </thead>
                                             <tbody class="buscar">
                                                <?php foreach ($articulos as $articulo) { ?> 
                                                    <tr>
                                                        <td class="text-center"><?php echo $articulo['cod_arti']; ?></td>
                                                      <td class="text-center"><?php echo $articulo['arti_descrip']; ?></td>
                                                      <td class="text-center"><?php echo $articulo['arti_precio']; ?></td>
                                                      <td class="text-center"><?php echo $articulo['imp_porc']; ?></td>
                                                       <td class="text-center"> 
                                                        <a onclick="editar(<?php 
                                                        echo "'" . $articulo['cod_arti'] . "_" .
                                                        $articulo['arti_descrip'] . "_" . 
                                                        $articulo['arti_precio'] . "_" . $articulo['cod_impuesto'] ."'";
                                                        ?>)"
                                                        class="btn btn-xs btn-primary" rel='tooltip' data-title="Editar"
                                                        data-toggle="modal" data-target="#editar">
                                                            <span class="glyphicon glyphicon-pencil"></span></a>
                                                        <a onclick="borrar(<?php 
                                                        echo "'" .$articulo['cod_arti'] . "_" .
                                                        $articulo['arti_descrip'] . "_" .
                                                        $articulo['arti_precio'] . "_" . $articulo['cod_impuesto'] . "'";
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
                                <h4 class="modal-title"><strong>Registrar Articulo</strong></h4>
                            </div>
                            <form action="articulo_control.php" method="post" accept-charset="utf-8" class="form-horizontal">
                                <div class="panel-body ">
                                    <input type="hidden" name="accion"  value="1">
                                    <input type="hidden" name="vcodarti" value="0"/> 
                                    <input type="hidden" name="pagina" value="articulo_index.php">
                                    <span class="col-md-1"></span>
                                    <div class="form-group">
                                    <label class="col-md-3 control-label">Descripcion:</label>
                                        <div class="col-md-5">
                                            <input type="text" required=""
                                                   placeholder="Ingrese el nombre del articulo"   autocomplete="off"
                                                   class="form-control"
                                                   id="vdescrip"
                                                   name="descrip"
                                                   onchange="sololetras()"
                                                   onkeyup="sololetras()"
                                                   min="3"
                                                   pattern="[A-Za-z #SPACE]{4,30}" >
                                        </div>                                
                                    </div>
                                    <br>
                                    <span class="col-md-1"></span>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">PRECIO:</label>
                                        <div class="col-md-5">
                                            <input type="number" required=""
                                                   placeholder="Ingrese el numero de telefono"  autocomplete="off"
                                                   class="form-control" id="vprecio"
                                                   name="precio" maxlength="15"
                                                   onchange="numerotelefon()"
                                                   onkeyup="numerotelefon()">
                                        </div>
                                    </div>
                                    <br>

                                    <span class="col-md-1"></span>
                                    <div class="form-group">
                                        <label  class="control-label col-md-3">TIPO IMPUESTO: </label>
                                        <div class="col-md-5">

                                            <select required="" class="form-control"   name="vimpues" >

                                                <option value="">Seleccione una impuesto</option>
                                                <?php
                                                $impuestos = consultas::get_datos("select * from tipo_impuesto "
                                                                . " order by imp_porc");
                                                ?> 
                                                <?php
                                                if (!empty($impuestos)) {
                                                    foreach ($impuestos as $impuesto) {
                                                        ?>
                                                        <option value="<?php echo $impuesto['cod_impuesto']; ?>">
                                                            <?php echo $impuesto['imp_porc']; ?></option>
                                                        <?php
                                                    }
                                                } else {
                                                    ?>
                                                    <option value="">Debe insertar una impuesto</option>
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
                            <h4 class="modal-title"><strong>EDITAR ARTICULO</strong></h4>
                        </div>
                        <form action="articulo_control.php" method="post" accept-charset="utf-8" class="form-horizontal">
                                <div class="panel-body ">
                                    <input type="hidden" name="accion"  value="1">
                                    <input type="hidden" name="vcodarti" value="0"/> 
                                    <input type="hidden" name="pagina" value="articulo_index.php">
                                    <span class="col-md-1"></span>
                                    <div class="form-group">
                                    <label class="col-md-3 control-label">Descripcion:</label>
                                        <div class="col-md-5">
                                            <input type="text" required=""
                                                   placeholder="Ingrese el nombre del articulo"   autocomplete="off"
                                                   class="form-control"
                                                   id="descrip"
                                                   name="varticulo"
                                                   onchange="editarpersona()"
                                                   onkeyup="editarpersona()"
                                                   min="3"
                                                   pattern="[A-Za-z #SPACE]{4,30}" >
                                        </div>                                
                                    </div>
                                    <br>
                                    <span class="col-md-1"></span>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">PRECIO:</label>
                                        <div class="col-md-5">
                                            <input type="number" required=""
                                                   placeholder="Ingrese el numero de telefono"  autocomplete="off"
                                                   class="form-control" id="precio"
                                                   name="vprecio" maxlength="15"
                                                   onchange="editar_precio()"
                                                   onkeyup="editar_precio()">
                                        </div>
                                    </div>
                                    <br>

                                    <span class="col-md-1"></span>
                                    <div class="form-group">
                                        <label  class="control-label col-md-3">TIPO IMPUESTO: </label>
                                        <div class="col-md-5">

                                            <select required="" class="form-control"   name="impues" >

                                                <option value="">Seleccione una impuesto</option>
                                                <?php
                                                $impuestos = consultas::get_datos("select * from tipo_impuesto "
                                                                . " order by imp_porc");
                                                ?> 
                                                <?php
                                                if (!empty($impuestos)) {
                                                    foreach ($impuestos as $impuesto) {
                                                        ?>
                                                        <option value="<?php echo $impuesto['cod_impuesto']; ?>">
                                                            <?php echo $impuesto['imp_porc']; ?></option>
                                                        <?php
                                                    }
                                                } else {
                                                    ?>
                                                    <option value="">Debe insertar una impuesto</option>
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

function editar_precio() {
    var numero = document.getElementById("precio").value;
   if (numero.match(/^-?[0-9--]+(\.[0-9--](1,2))?$/))
    {

    } else {
        notificacion('Atencion', 'No se permiten letras o espacios', 'window.alert(message);');
//                    notificacion("Solo numeros");
        document.getElementById("precio").value = "";

    }
}

function editarpersona() {
//                      var numero = trim(numero);
    var numero = document.getElementById("descrip").value;
    if (numero.length === 0 || numero === " ") {
        notificacion('Atencion', 'No se permiten campos vacios', 'window.alert(message);');
        document.getElementById("descrip").value = "";


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
    $('#descrip').val(dat[1]);
    $('#precio').val(dat[2]);
    $('#impues').val(dat[3]);
    


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
    var numero = document.getElementById("precio").value;
    if (numero.match(/^-?[0-9]+(\.[0-9](1,2))?$/))
    {

    } else {
        notificacion('Atencion', 'No se permiten letras o espacios', 'window.alert(message);');
//                    notificacion("Solo numeros");

        document.getElementById("precio").value = "";
    }
}
function borrar(datos) {
    var dat = datos.split("_");
    $('#si').attr('href', 'articulo_control.php?vcodarti=' + dat[0]
            + '&vdescrip=' + dat[1]
            + '&vprecio=' + dat[2]
            + '&vimpues=' + dat[3]

            + '&accion=3&pagina=articulo_index.php');
    $('#confirmacion').html('<span class="glyphicon glyphicon-warning-sign"></span>\n\
¿Desea Borrar el Articulo? <i><strong>' + dat[1] + '</strong></i>?');
}




</script>
</body>
</html>