<!-- Navigation -->
<nav class="navbar navbar-inverse navbar-static-top" role="navigation" style="margin-bottom: 0">
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="menu.php">TALLER DE MOTOS MAURO</a>
        
    </div>
    <!-- /.navbar-header -->

   <ul class="nav navbar-top-links navbar-right">
        <li class="dropdown">
            <a class="dropdown-toggle " data-toggle="dropdown" href="#">
                <i class="fa fa-question-circle"></i> <i class="fa fa-caret-down"></i>
            </a>
            <ul class="dropdown-menu dropdown-alerts">
                <li>
                    <a href="/mauro/MANUAL.pdf" target="_blank">
                        <div>
                            <i class="fa fa-book"></i> Manual de usuario
                            
                        </div>
                    </a>
                </li>
                
            </ul>
            <!-- /.dropdown-alerts -->
        </li>
        <!-- /.dropdown -->
        <li class="dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                <i class="fa fa-user fa-fw"></i>  <strong><?php echo $_SESSION['usu_nick'] ?></strong> <i class="fa fa-caret-down"></i>
            </a>
            <ul class="dropdown-menu dropdown-user">
<!--                <li><a href="#"><i class="fa fa-user fa"></i> Perfil</a>               
                <li class="divider"></li>-->
                <li><a href="/mauro/index.php"><i class="fa fa-sign-out fa-fw"></i> Salir</a>
                </li>
            </ul>
            
            <!-- /.dropdown-user -->
        </li>
        <!-- /.dropdown -->
    </ul>
    
    <!-- /.navbar-top-links -->
    <div class="navbar-default sidebar" role="navigation">
        <div class="sidebar-nav navbar-collapse">
            <?php require 'menu/toolbar.ctp'; ?>
        </div>
        <!-- /.sidebar-collapse -->
    </div>
    <!-- /.navbar-static-side -->
</nav>
