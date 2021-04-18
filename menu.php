<!-- Navigation-->
<nav class="navbar navbar-expand-lg bg-primary text-uppercase fixed-top" id="mainNav">
            <div class="container">
                <a class="navbar-brand js-scroll-trigger" href="<?= $redirect; ?>">REPORTE DE GASTOS</a>
                <button class="navbar-toggler navbar-toggler-right text-uppercase font-weight-bold bg-info text-white rounded" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                    Menu
                    <i class="fas fa-bars"></i>
                </button>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item mx-0 mx-lg-1">
                            <?php if($page != 'registro'){?>
                                <a class="nav-link py-3 px-0 px-lg-3" href="form/add.php">Registrar gastos</a>
                            <?php }else {?>
                                <a class="nav-link py-3 px-0 px-lg-3" href="add.php">Registrar gastos</a>
                            <?php }?>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>