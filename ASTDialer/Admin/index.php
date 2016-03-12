<?php
include_once 'config.php';
include_once 'connection.php';
include_once 'user/user.php';
include_once 'campaing/campaing.php';

if (empty($_SESSION['logged'])) {
    header('Location: login.php');
}
?>

<html>
    <head>
        <meta charset="utf-8">
        <title>ASTDialer Administration</title>
        <script src="js/jquery.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <link href="css/bootstrap.min.css" rel="stylesheet">
    </head>
    <body>
        <nav class="navbar navbar-default">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <image class="navbar-brand" src="images/phone.png">
                    <b class="navbar-brand">ASTDialer</b>
                </div>
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav">
                        <li><a href="index.php?page=dashboard.php"><span class="glyphicon glyphicon-list-alt"></span> Dashboard</a></li>
                        <li><a href="index.php?page=campaing/list.php"><span class="glyphicon glyphicon-phone-alt"></span> Campanhas</a></li>
                        <?php if ($_SESSION['username'] == 'admin') {; ?>
                            <li class="dropdown">
                                <a class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-cog"></span> Administra&ccedil;&atilde;o <span class="caret"></span></a>
                                <ul class="dropdown-menu">
                                    <li><a href="index.php?page=user/list.php"><span class="glyphicon glyphicon-user"></span> Usu&aacute;rios</a></li>
                                    <li><a href="#"><span class="glyphicon glyphicon-wrench"></span> Par&acirc;metros</a></li> 
                                </ul>
                            </li>
                        <?php }; ?>
                    </ul>
                    <ul class="nav navbar-btn navbar-right">
                        <a style="font-weight: bold" href="logout.php" class="btn btn-danger btn-md">
                            <span class="glyphicon glyphicon-off"></span> Sair
                        </a>
                    </ul>
                </div>
            </div>
        </nav>
        <div class="container theme-showcase" role="main">
            <?php
            if (isset($_GET['page']) && file_exists($_GET['page'])) {
                $page = $_GET['page'];
            } else {
                $page = 'index.php';
            }

            include_once $page;
            ?>
        </div>
    </body>
</html>