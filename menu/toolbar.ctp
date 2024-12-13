<?php
include_once 'config/database.php'; //llamar a la conexion

?>

<ul class="nav" id="side-menu">
<!--      <div class="col-lg-12">
                        <div class="panel-heading">
                            <div class="input-group custom-search-form">
                                <input id="filtrartolbar" type="text" class="form-control" placeholder="Buscar...">
                                <span class="input-group-btn">
                                    <button class="btn btn-default" type="button" rel="tooltip" title="Buscar">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </span>
                            </div>
                        </div>                      
                    </div>-->
                
    
    <li>
        <a href="/mauro/menu.php"><i class="fa fa-home"></i> INICIO</a>
    </li>
    <?php
    //Obtener el nombre de los modulos
    $modulos = consultas::get_datos("select distinct(mod_cod),
        (mod_nombre) from v_permisos 
        where cod_grupo =" . $_SESSION['cod_grupo'] . " order by mod_cod");
    ?>  
    <?php foreach ($modulos as $modulo) { ?>
        <li>
            <a ><i class="fa fa-edit"></i><?php echo $modulo['mod_nombre']; ?>
                <span class="fa arrow"></span></a>
           
            <ul class="nav nav-second-level">               
                <?php
                //Obtener las paginas de acuerdo al modulo
                $paginas = consultas::get_datos("select pag_direcc,pag_nombre,leer,insertar,editar,borrar from v_permisos  
                        where mod_cod=" . $modulo['mod_cod'] . " and cod_grupo =" . $_SESSION['cod_grupo'] . " order by pag_nombre");
                ?>
                <?php foreach ($paginas as $pagina) { ?>
                    <li>
                        <a href="/mauro/<?php echo $pagina['pag_direcc']; ?>">
                            <?php echo $pagina['pag_nombre']; ?>
                        </a>                        
                    </li>
                    <?php $_SESSION[$pagina['pag_nombre']] = $pagina; ?>
                <?php } ?>  
            </ul>
            <!-- /.nav-second-level -->
        </li>
    <?php } ?>
</ul>
