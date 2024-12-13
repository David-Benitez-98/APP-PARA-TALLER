<!DOCTYPE html>
<html>
    <head>
        <link rel="shortcut icon"  href=" imges/mauro"/>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <title>EDITAR</title>

        <?php
        require './session_start.php';
//        require './anular_sesion.php';
        require 'menu/css.ctp';
        ?>
    </head>
    <body>
        <div id="wrapper">
            <?php require 'menu/navbar.php'; ?><!--BARRA DE HERRAMIENTAS-->
            <div id="page-wrapper">
                <div class="row">
                    <!--impresion del titulo de la pagina-->
                    <div class="col-lg-12">
                        <h3 class="page-header">Listado de Usuario
                            <a href="usuario_index.php" 
                             class="btn btn-primary btn-circle pull-right" 
                               rel="tooltip" data-title="Atras" >
                                <i class="glyphicon glyphicon-arrow-left"></i>
                            </a>                    
                        </h3>
                    </div>     
                    <!--Buscador-->
                    <div class="col-lg-12">
                        <div class="panel-body">
                            <?php $usuario= consultas::get_datos
                                    ("select * from usuarios where cod_usu=".$_REQUEST['vcod']) ?>
                            <form action="usuario_control.php" method="post" role="form"class="form-horizontal">
                                <input type="hidden" name="accion" value="2">
                               <input type="hidden" name="vcod"
                                       value="<?php echo $usuario[0]['cod_usu']; ?>">
                                  <input type="hidden" name="vpersonal"
                                       value="<?php echo $usuario[0]['cod_personal']; ?>">
                                <input type="hidden" name="pagina" value="usuario_index.php">
                                <div class="form-group">
                                    <label class="col-md-2 control-label"> Nick</label>
                                    <div class="col-md-5">
                                        <input type="text" required="" placeholder="Ingrese su Nick"
                                               class="form-control"
                                               name="vnick" value="<?php echo $usuario[0]['usu_nick'];?>" autofocus="">
                                               </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-2 control-label">Clave</label>
                                    <div class="col-md-5">
                                        <input type="password" required="" placeholder="Ingrese su clave"  
                                               class="form-control" name="vclave"
                                         value="<?php echo $usuario[0]['usu_clave'];?>" autofocus="">
                                    </div>
                                </div>
                                  <div class="form-group">
                                    <label class="col-md-2 control-label">Grupo</label>
                                    <div class="col-md-3">
                                        <?php
                                        $grupos = consultas::get_datos("select * from grupo "
                                                        . " order by cod_grupo=".$usuario[0]['cod_grupo']. "desc");
                                        ?>                                 
                                        <select name="vgrup" class="form-control select2">
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
                                                <option value="0">Debe insertar un Grupo</option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                 <div class="form-group">
                                    <label class="col-md-2 control-label">Nombre</label>
                                    <div class="col-md-5">
                                        <input type="text" required="" 
                                               placeholder="Ingrese su Nombre" 
                                               class="form-control" name="vnombre"
                                               disabled=""
                                        value="<?php echo $usuario[0]['usu_nick'];?>" autofocus="">
                                    </div>
                                </div>
<!--                       <div class="form-group">
                                    <label class="col-md-2 control-label">Estado</label>
                                    <div class="col-md-8">
                                        <input type="text" required="" 
                                               placeholder="Ingrese su estado" 
                                               class="form-control" name="vestado"
                                               value="
                                    </div>
                                </div>-->
             <div class="form-group">
                                    <label class="col-md-2 control-label">Estado</label>
                                  <div class="row">
                                    <div class="radio col-md-8">
                                        <?php if ($usuario[0]['usu_estado'] == 'ACTIVO'){?>
                                        <label>
                                            <input type="radio" name="vestado" value="ACTIVO" checked=""> ACTIVO
                                        </label>
                                        
                                        <label>
                                            <input type="radio" name="vestado" value="INACTIVO"> INACTIVO
                                        </label> 
                                         <?php }else{ ?>
                                        <label>
                                            <input type="radio" name="vestado" value="ACTIVO" >ACTIVO
                                        <label>
                                            <input type="radio" name="vestado" value="INACTIVO" checked=""> INACTIVO
                                        </label> 
                                         <?php }?>
                                    </div>
                                  </div>                                  
                                </div>
              
                         
                                   <br>
                                <div class="form-group">
                                    <div class="col-md-offset-2 col-md-10">
                                        <button class="btn btn-primary" type="submit"><i class="fa fa-floppy-o"></i> Grabar</button>
                                    </div>
                                </div>
                            </form>     
                        </div>
                    </div>
                </div>
                <!-- /.col-lg-12 -->
            </div>

        </div> 
        <!--fin-->
        <!--archivos js-->   
        <?php require 'menu/js.ctp'; ?>

    </body>
</html>
