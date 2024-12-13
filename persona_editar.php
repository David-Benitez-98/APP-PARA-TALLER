<html>
    <head>
        <link rel="shortcut icon"  href=" img/blackbulls.ico"/>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <title>PERSONA EDITAR</title>

        <?php
        require './session_start.php';
         
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
                        <h3 class="page-header">PERSONA EDITAR
                            <a href=persona_index.php
                             class="btn btn-primary btn-circle pull-right" 
                               rel="tooltip" data-title="Atras" >
                                <i class="glyphicon glyphicon-arrow-left"></i>
                            </a>                    
                        </h3>
                    </div>     
                            <!--Buscador-->
                    <div class="col-lg-12">
                        <div class="panel-body">
                            <?php $persona= consultas::get_datos
                                    ("select * from persona where id_persona=".$_REQUEST['vcodper']) ?>
                            <form action="persona_control.php" method="post" role="form"class="form-horizontal">
                                <input type="hidden" name="accion" value="2">
                                <input type="hidden" name="vcodper" 
                                       value="<?php echo $persona[0]['id_persona']; ?>">
                                <input type="hidden" name="pagina" value="persona_index.php">
                                 <div class="form-group">
                                    <label class="col-md-2 control-label">NOMBRE</label>
                                    <div class="col-md-5">
                                        <input type="text" required=""
                                               placeholder="Ingrese su nombre"  
                                               class="form-control"
                                               name="vpernomb"
                                                pattern="[A-Za-z #SPACE]{4,30}" title="SOLO LETRAS !" 
                                               value="<?php echo $persona[0]['per_nombre'];?>" autofocus="">
                                    </div>
                                </div>
                                <br>
                                      <div class="form-group">
                                    <label class="col-md-2 control-label">APELLIDO:</label>
                                    <div class="col-md-5">
                                        <input type="text" required=""
                                               placeholder="Ingrese su apellido"  
                                               class="form-control"
                                               name="vperapelli"
                                                pattern="[A-Za-z #SPACE]{4,30}" title="SOLO LETRAS !" 
                                               value="<?php echo $persona[0]['per_apellido'];?>" autofocus="">
                                    </div>
                                </div>
                                <br>
                                             <div class="form-group">
                                    <label class="col-md-2 control-label">CI:</label>
                                    <div class="col-md-5">
                                        <input type="number" required=""
                                               placeholder="Ingrese su cedula de identidad"  
                                               class="form-control"
                                               name="vperci" maxlength="8"
                                               value="<?php echo $persona[0]['per_ci'];?>" autofocus="">
                                    </div>
                                </div>
                                <br>
                                    <div class="form-group">
                                    <label class="col-md-2 control-label">SEXO:</label>
                                  <div class="row">
                                    <div class="radio col-md-8">
                                        <?php if ($persona[0]['per_sexo'] == 'M'){?>
                                        <label>
                                            <input type="radio" name="vpersexo" value="M" checked=""> Masculino
                                        </label>
                                        
                                        <label>
                                            <input type="radio" name="vpersexo" value="F"> Femenino
                                        </label> 
                                         <?php }else{ ?>
                                        <label>
                                            <input type="radio" name="vpersexo" value="M" checked="">Masculino
                                        <label>
                                            <input type="radio" name="vpersexo" value="F" checked=""> Femenino
                                        </label> 
                                         <?php }?>
                                    </div>
                                  </div>                                  
                                </div>
                                <br>
                                        <div class="form-group">
                                    <label class="col-md-2 control-label">FECHA NAC.:</label>
                                    <div class="col-md-5">
                                        <input type="date" required="" id="fec"
                                          placeholder="Ingrese fecha nacimiento"  
                                          class="form-control"
                                          name="vperfn" onchange="validar1()"
                                          value="<?php echo $persona[0]['per_fecha_nac'];?>">
                                    </div>
                                </div>
                                <br>
                                        <div class="form-group">
                                    <label class="col-md-2 control-label">DIRECCION:</label>
                                    <div class="col-md-5">
                                        <input type="text" required=""
                                               placeholder="Ingrese su direccion"  
                                               class="form-control"
                                               name="vperdirec" pattern="[A-Za-z and 0-9 and #SPACE]{4,100}"title="SOLO LETRAS Y NUMEROS"
                                               value="<?php echo $persona[0]['per_direc'];?>" autofocus="">
                                    </div>
                                </div>
                                <br>
                                             <div class="form-group">
                                    <label class="col-md-2 control-label">TELEFONO:</label>
                                    <div class="col-md-5">
                                        <input type="number" required=""
                                               placeholder="Ingrese su numero de telefono"  
                                               class="form-control"
                                               name="vpertelef"
                                               value="<?php echo $persona[0]['per_telef'];?>" autofocus="">
                                    </div>
                                </div>
                                <br>
                                <div class="form-group">
                                    <label class="col-md-2 control-label">TELEFONO 2:</label>
                                    <div class="col-md-5">
                                        <input type="number" 
                                               placeholder="Ingrese su numero de telefono"  
                                               class="form-control"
                                               name="vpertelef2"
                                               value="<?php echo $persona[0]['nro_telef1'];?>" autofocus="">
                                    </div>
                                </div>
                                <br>
                                                   <div class="form-group">
                                    <label class="col-md-2 control-label">EMAIL:</label>
                                    <div class="col-md-5">
                                        <input type="text" required=""
                                               placeholder="Ingrese su direccion de correo electronico"  
                                               class="form-control"
                                               name="vperemail"
                                               value="<?php echo $persona[0]['per_email'];?>" autofocus="">
                                    </div>
                                </div>
                                <br>
                                
                               
                                 <div class="form-group">
                                    <label class="col-md-2 control-label">DEPARTAMENTO:</label>
                                    <div class="col-md-5">
                                        <?php
                                        $departamentos = consultas::get_datos("select * from departamento "
                                                        . " order by depar_descripcion");
                                        ?>                                 
                                        <select name="vperdepart" class="form-control select2">
                                            <?php
                                            if (!empty($departamentos)) {
                                                foreach ($departamentos as $departamento) {
                                                    ?>
                                                    <option value="<?php echo $departamento['id_departamento']; ?>">
                                                        <?php echo $departamento['depar_descripcion']; ?></option>
                                                    <?php
                                                }
                                            } else {
                                                ?>
                                                <option value="0">Debe insertar un departamento</option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <br>
                            <div class="form-group">
                                    <label class="col-md-2 control-label">CIUDAD:</label>
                                    <div class="col-md-5">
                                        <?php
                                        $ciudads = consultas::get_datos("select * from ciudad "
                                                        . " order by ciu_descrip");
                                        ?>                                 
                                        <select name="vperciu" class="form-control select2">
                                            <?php
                                            if (!empty($ciudads)) {
                                                foreach ($ciudads as $ciudad) {
                                                    ?>
                                                    <option value="<?php echo $ciudad['id_ciudad']; ?>">
                                                        <?php echo $ciudad['ciu_descrip']; ?></option>
                                                    <?php
                                                }
                                            } else {
                                                ?>
                                                <option value="0">Debe insertar una ciudad</option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <br>
                           
                            
                            
                                 <br>
                                <div class="form-group">
                                    <div class="col-md-offset-6 col-md-10">
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
        <script>
        function validar1() {
                var hoy = new Date();
                var fechaFormulario = new Date($('#fec').val());
                if (fechaFormulario > hoy) {
                    alert('Fecha superior al actual!!!');
//                    $('#fecha').val(hoy);
                    $('#fec').val(hoy);
                } else {

                }
            }
               </script>
    </body>
</html>
