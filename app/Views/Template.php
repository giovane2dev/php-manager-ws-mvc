<?php

namespace App;

session_start();

if (!empty(getURI())) {
    if (!isset($_SESSION['LOGIN'])) {
        if (!(bool) $_SESSION['LOGIN']) {
            header('Location: ' . APP_PATH);
            exit();
        }
    }
}

use App\Models\CategoriesModel;

$categoriesSub = CategoriesModel::read(null, false);
$categoriesCon = CategoriesModel::read();
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Home - ManagerWS</title>
    <meta name="description" content="Gestão de conteúdo para websites">
    <link rel="stylesheet" href="<?php echo ASSETS_PATH; ?>/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo ASSETS_PATH; ?>/bootstrap/css/bootstrap-datepicker3.min.css">
    <link rel="stylesheet" href="<?php echo ASSETS_PATH; ?>/bootstrap/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat:400,700">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic">
    <link rel="stylesheet" href="<?php echo ASSETS_PATH; ?>/fonts/font-awesome.min.css">
    <link rel="stylesheet" href="<?php echo ASSETS_PATH; ?>/css/jquery-te-1.4.0.css?load=<?php echo time(); ?>">
    <link rel="stylesheet" href="<?php echo ASSETS_PATH; ?>/css/style.css?load=<?php echo time(); ?>">
</head>

<body id="page-top">
    <nav class="navbar navbar-light navbar-expand-lg fixed-top bg-secondary text-uppercase" id="mainNav">
        <div class="container">
            <a class="navbar-brand js-scroll-trigger" href="#page-top">ManagerWS</a>
            <button class="navbar-toggler navbar-toggler-right text-uppercase bg-primary text-white rounded" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation"><i class="fa fa-bars"></i></button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="nav navbar-nav ml-auto">
                    <li class="nav-item dropdown mx-0 mx-lg-1">
                        <a class="nav-link" href="/categories" role="button">Categorias</a>
                    </li>
                    <li class="nav-item dropdown mx-0 mx-lg-1">
                        <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Subategorias</a>
                        <div class="dropdown-menu">
                            <div id="subcategoriesOptions">
                                <?php foreach ($categoriesSub
                                    as $categorySub) : ?>
                                    <a class="dropdown-item" href="<?php echo APP_PATH; ?>/subcategories/<?php echo $categorySub['id']; ?>"><?php echo $categorySub['name']; ?></a>
                                <?php endforeach; ?>
                            </div>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="<?php echo APP_PATH; ?>/subcategories/all">Todas</a>
                        </div>
                    </li>
                    <li class="nav-item dropdown mx-0 mx-lg-1">
                        <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Conteúdo</a>
                        <div class="dropdown-menu">
                            <div id="newsOptions">
                                <?php foreach ($categoriesCon
                                    as $categoryCon) : ?>
                                    <a class="dropdown-item" href="<?php echo APP_PATH; ?>/news/<?php echo $categoryCon['id']; ?>"><?php echo $categoryCon['name']; ?></a>
                                <?php endforeach; ?>
                            </div>
                            <div class="dropdown-divider"></div>
                            <a id="selectAllNews" class="dropdown-item" href="<?php echo APP_PATH; ?>/news/all">Todos</a>
                        </div>
                    </li>

                    <?php if (isset($_SESSION['LOGIN'])) : ?>
                        <?php if ((bool) $_SESSION['LOGIN']) : ?>
                            <li class="nav-item dropdown mx-0 mx-lg-1">
                                <a class="nav-link" href="<?php echo APP_PATH; ?>/exit" role="button">Sair</a>
                            </li>
                        <?php endif; ?>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>
    <header class="masthead bg-primary text-white text-center">
        <div class="container">
            <h2 class="font-weight-light mb-0">Design simples e novas experiências! Comece criando conteúdo.</h2>
        </div>
    </header>
    <section id="content" class="bg-light text-white mb-0">
        <div class="container text-dark">
            <?php if (isset($viewName)) {
                $path = viewsPath() . $viewName . '.php';
                if (file_exists($path)) {
                    require_once $path;
                }
            } ?>
        </div>
    </section>
    <footer class="footer text-center">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <h5 class="text-uppercase mb-4">Usuário</h5>
                    <p class="lead mb-0"><span><?php if (
                                                    isset($_SESSION['LOGIN'])
                                                ) {
                                                    echo $_SESSION['USER_NAME'] .
                                                        ' em ' .
                                                        formatDate('[SMALL]', $_SESSION['LAST_LOGIN']) .
                                                        ' às ' .
                                                        formatDate(
                                                            '[TIMEONLY]',
                                                            $_SESSION['LAST_LOGIN']
                                                        );
                                                } else {
                                                    echo 'Usuário desconectado!';
                                                } ?></span></p>
                </div>
                <div class="col-md-4 mb-5 mb-lg-0">
                    <h5 class="text-uppercase">Suporte</h5>
                    <ul class="list-inline">
                        <li class="list-inline-item">
                            <a class="btn btn-outline-light btn-social text-center rounded-circle" role="button" href="https://api.whatsapp.com/send?phone=5598988831042&text=Ol%C3%A1!%20Preciso%20da%20sua%20ajuda."><i class="fa fa-whatsapp fa-fw"></i></a>
                        </li>
                    </ul>
                </div>
                <div class="col-md-4">
                    <h5 class="text-uppercase mb-4"><strong>ManagerWS</strong></h5>
                    <p class="lead mb-0"><span>Gestão de conteúdo</span></p>
                </div>
            </div>
        </div>
    </footer>
    <script src="<?php echo ASSETS_PATH; ?>/js/jquery.min.js"></script>
    <script src="<?php echo ASSETS_PATH; ?>/bootstrap/js/bootstrap.min.js"></script>
    <script src="<?php echo ASSETS_PATH; ?>/bootstrap/js/bootstrap-datepicker.min.js"></script>
    <script src="<?php echo ASSETS_PATH; ?>/bootstrap/js/bootstrap-datepicker.pt-BR.min.js"></script>
    <script src="<?php echo ASSETS_PATH; ?>/bootstrap/js/dataTables.bootstrap4.min.js"></script>
    <script src="<?php echo ASSETS_PATH; ?>/bootstrap/js/jquery.dataTables.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.min.js"></script>
    <script src="<?php echo ASSETS_PATH; ?>/js/freelancer.js"></script>
    <script src="<?php echo ASSETS_PATH; ?>/js/jquery-te-1.4.0.js"></script>
    <script src="<?php echo ASSETS_PATH; ?>/js/ajax.js"></script>
    <script src="<?php echo ASSETS_PATH; ?>/js/jquery.form.js"></script>
    <script src="<?php echo ASSETS_PATH; ?>/js/fileupload.js"></script>
    <script src="<?php echo ASSETS_PATH; ?>/js/alert.js"></script>
    <script src="<?php echo ASSETS_PATH; ?>/js/scripts.js?load=<?php echo time(); ?>"></script>
</body>

</html>