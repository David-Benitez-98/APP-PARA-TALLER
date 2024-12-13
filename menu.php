<!DOCTYPE html>
<html lang="es">
    <head>
        <link rel="shortcut icon"  href="images/mauro.jpg "/>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <title>MENU</title>
        <?php
        require './session_start.php';
        ?>
        <!-- Bootstrap Core CSS -->
        <link href="./vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <!-- MetisMenu CSS -->
        <link href="./vendor/metisMenu/metisMenu.min.css" rel="stylesheet">
        <!-- Custom CSS -->
        <link href="./dist/css/sb-admin-2.css" rel="stylesheet">
        <!-- Custom Fonts -->
        <link href="./vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
        

   
    <link href="assets/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />



    </head>
    <body>
        
        <div id="wrapper">
            <?php require 'menu/navbar.php'; ?><!--Barra de herramientas-->
            <div id="page-wrapper">
                   
            <?php $fecha = consultas::get_datos("select * from v_fecha1") ?>
                <!--        SERVICIOS-->
                <div class="row">
                        <div class="col-lg-12">
                            <h1><i><?php echo $fecha[0]['fecdate']; ?></i></h1>
                        </div>
                        <h3 class="page-header"><i> ÁREA DE SERVICIOS</i></h3>
                    </div>

                    <!-- /.row -->
                    <div class="row">
                        <div class="col-lg-4 col-md-6">
                            <div class="panel panel-primary">
                                <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-list fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class="huge"></div>
                                        <div>Listado de Solicitudes</div>
                                    </div>
                                </div>
                            </div>
                                <a href="/bulls/solicitud_index.php">
                                    <div class="panel-footer">
                                        <span class="pull-left">Listado de solicitudes</span>
                                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                        <div class="clearfix"></div>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6">
                            <div class="panel panel-green">
                                <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa  fa-edit fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class="huge"></div>
                                        <div>Solicitud</div>
                                    </div>
                                </div>
                            </div>
                                <a href="/bulls/solicitud_index.php">
                                    <div class="panel-footer">
                                        <span class="pull-left">Registar nueva solicitud</span>
                                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                        <div class="clearfix"></div>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6">
                            <div class="panel panel-yellow">
                                <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-cogs fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class="huge"></div>
                                        <div>Servcios</div>
                                    </div>
                                </div>
                            </div>
                                <a href="/bulls/serviciios_index.php">
                                    <div class="panel-footer">
                                        <span class="pull-left">Registrar servicio</span>
                                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                        <div class="clearfix"></div>
                                    </div>
                                </a>
                            </div>
                        </div>
                        
                    </div>
                    
                    <!--        VENTAS-->

                    <!--            <div id="page-wrapper">-->
                    <div class="row">
                        <!--                    <div class="col-lg-12">-->
                        <h3 class="page-header"><i> ÁREA DE FACTURACION</i></h3>
                    </div>

                    <!-- /.row -->
                    <div class="row">
                        <div class="col-lg-4 col-md-6">
                            <div class="panel panel-info">
                                <div class="panel-heading">
                                    <div class="row">
                                        <div class="col-xs-3">
                                            <i class="fa fa-list-ul fa-5x"></i>
                                        </div>
                                        <div class="col-xs-9 text-right">
                                            <div class="huge"></div>
                                            <div>Listado de ventas</div>
                                        </div>
                                    </div>
                                </div>
                                <a href="/bulls/facturacion.php">
                                    <div class="panel-footer">
                                        <span class="pull-left">Vista de las facturaciones</span>
                                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                        <div class="clearfix"></div>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6">
                            <div class="panel panel-success">
                                <div class="panel-heading">
                                    <div class="row">
                                        <div class="col-xs-3">
                                            <i class="fa  fa-group fa-5x"></i>
                                        </div>
                                        <div class="col-xs-9 text-right">
                                            <div class="huge"></div>
                                            <div>Clientes</div>
                                        </div>
                                    </div>
                                </div>
                                <a href="/bulls/clientes_agregar.php">
                                    <div class="panel-footer">
                                        <span class="pull-left">Registar nuevo cliente</span>
                                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                        <div class="clearfix"></div>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6">
                            <div class="panel panel-warning">
                                <div class="panel-heading">
                                    <div class="row">
                                        <div class="col-xs-3">
                                            <i class="fa fa-shopping-cart fa-5x"></i>
                                        </div>
                                        <div class="col-xs-9 text-right">
                                            <div class="huge"></div>
                                            <div>Notas de credito</div>
                                        </div>
                                    </div>
                                </div>
                                <a href="/bulls/nota_credito_factura.php">
                                    <div class="panel-footer">
                                        <span class="pull-left">Registrar notas de credito</span>
                                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                        <div class="clearfix"></div>
                                    </div>
                                </a>
                            </div>
                        </div>
                        
                        </div>
               
                    <!--        COMPRAS-->
                
                    <div class="row">
                        <h3 class="page-header"><i> ÁREA DE COMPRAS</i></h3>
                    </div>

                    <!-- /.row -->
                    <div class="row">
                        <div class="col-lg-4 col-md-6">
                            <div class="panel panel-primary">
                                <div class="panel-heading">
                                    <div class="row">
                                        <div class="col-xs-3">
                                            <i class="fa fa-list fa-5x"></i>
                                        </div>
                                        <div class="col-xs-9 text-right">
                                            <div class="huge"></div>
                                            <div>Listado de Compras</div>
                                        </div>
                                    </div>
                                </div>
                                <a href="/bulls/compra_index.php">
                                    <div class="panel-footer">
                                        <span class="pull-left">Vista de los detalles</span>
                                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                        <div class="clearfix"></div>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6">
                            <div class="panel panel-green">
                                <div class="panel-heading">
                                    <div class="row">
                                        <div class="col-xs-3">
                                            <i class="fa fa-truck fa-5x"></i>
                                        </div>
                                        <div class="col-xs-9 text-right">
                                            <div class="huge"></div>
                                            <div>Proveedores</div>
                                        </div>
                                    </div>
                                </div>
                                <a href="/bulls/proveedor_index.php">
                                    <div class="panel-footer">
                                        <span class="pull-left">Registar nuevo proveedor</span>
                                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                        <div class="clearfix"></div>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6">
                            <div class="panel panel-yellow">
                                <div class="panel-heading">
                                    <div class="row">
                                        <div class="col-xs-3">
                                            <i class="fa fa-balance-scale fa-5x"></i>
                                        </div>
                                        <div class="col-xs-9 text-right">
                                            <div class="huge"></div>
                                            <div>Compras</div>
                                        </div>
                                    </div>
                                </div>
                                <a href="/bulls/compra_index_1.php">
                                    <div class="panel-footer">
                                        <span class="pull-left">Registrar compra directa</span>
                                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                        <div class="clearfix"></div>
                                    </div>
                                </a>
                            </div>
                        </div>
                      
                            
                        </div>
                    </div>
                

            </div>
            
        </div>

        <strong>Copyright &copy; <?php echo date('Y');?> - <a href="#"> Proyecto Web</a></strong> <p><a href="https://www.linkedin.com/in/david-benítez-b50239235/" target="_blank"> Desarrollado por David Benitez</a></p>
        <!-- jQuery -->
        <script src="./vendor/jquery/jquery.min.js"></script>

        <!-- Bootstrap Core JavaScript -->
        <script src="./vendor/bootstrap/js/bootstrap.min.js"></script>

        <!-- Metis Menu Plugin JavaScript -->
        <script src="./vendor/metisMenu/metisMenu.min.js"></script>

        <!-- Custom Theme JavaScript -->
        <script src="./dist/js/sb-admin-2.js"></script>
    </body>





