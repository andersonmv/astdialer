<?php
include_once '../config.php';
include_once 'user.php';

if (empty($_SESSION['logged'])) {
    header('Location: index.php');
}

$user = new user();

if (!empty($_GET['id'])) {
    $user->load($_GET['id']);
}
?>

<div class="panel panel-primary">
    <div class="panel-heading" align="center" style="font-weight: bold;">
        Cadastro de Usu&aacute;rio
    </div>
    <div class="panel-body">
        <form class="form-horizontal" action="user/process.php?action=save" method="post">
            <input type="hidden" name="id" value="<?php echo $user->getId(); ?>" />
            <div class="form-group">
                <label for="name" class="col-sm-2 control-label">Nome</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="name" value="<?php echo $user->getName(); ?>" />
                </div>
            </div>
            <div class="form-group">
                <label for="username" class="col-sm-2 control-label">Login</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="username" value="<?php echo $user->getUsername(); ?>" />
                </div>
            </div>
            <div class="form-group">
                <label for="password1" class="col-sm-2 control-label">Senha</label>
                <div class="col-sm-10">
                    <input type="password" class="form-control" name="password1"/>
                </div>
            </div>
            <div class="form-group">
                <label for="password2" class="col-sm-2 control-label">Repetir Senha</label>
                <div class="col-sm-10">
                    <input type="password" class="form-control" name="password2"/>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-floppy-disk"></span> Salvar</button>
                    <button type="reset" class="btn btn-danger"><span class="glyphicon glyphicon-remove"></span> Limpar</button>
                </div>
            </div>
        </form>
    </div>
</div>