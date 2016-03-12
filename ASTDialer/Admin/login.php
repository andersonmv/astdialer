<?php
include_once 'user/user.php';
include_once 'connection.php';
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
            </div>
        </nav>
        <div align="center" class="container theme-showcase" role="main">
            <form class="form-horizontal" action="user/process.php?action=login" method="post">   
                <image src="images/phone.png">
                <br>
                <h4 for="username">Usu&aacute;rio</h4>
                <input style="width: 20%" type="text" name="username" id="username" class="form-control">
                <h4 for="password">Senha</h4>
                <input style="width: 20%" type="password" name="password" id="password" class="form-control">
                <br>
                <input style="width: 20%" type="submit" class="btn btn-primary">
            </form>
        </div>
    </body>
</html>