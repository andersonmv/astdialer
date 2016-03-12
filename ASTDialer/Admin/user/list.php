<?php
include_once '../config.php';
include_once 'user.php';

if (empty($_SESSION['logged'])) {
    header('Location: index.php');
}

$user = new user();
$users = $user->selectAll();
?>

<a href="index.php?page=user/form.php" class="btn btn-primary"><span class="glyphicon glyphicon-plus"></span> Adicionar</a>
<div><br></div>
<table class="table table-bordered table-striped table-hover table-condensed">
    <tr>
        <td width="15%" align="center">Op&ccedil;&otilde;es</td>
        <td width="50%" align="center">Nome</td>
        <td width="35%" align="center">Usu&aacute;rio</td>
    </tr>
    <?php foreach ($users as $current_user) { ?>
        <tr align="center">
            <td>
                <?php
                if ($current_user['username'] == "admin") {; ?>
                    <a href="index.php?page=user/form.php&id=<?php echo $current_user['id']; ?>" class="btn-sm btn-success" ><span class="glyphicon glyphicon-pencil"></span> Alterar</a>
                <?php } else {; ?>
                    <a href="index.php?page=user/form.php&id=<?php echo $current_user['id']; ?>" class="btn-sm btn-success" ><span class="glyphicon glyphicon-pencil"></span> Alterar</a>
                    <a href="user/process.php?action=delete&id=<?php echo $current_user['id']; ?>" onclick="return confirm('Deseja realmente excluir o usuário <?php echo $current_user['name']; ?> ?')" class="btn-sm btn-danger" ><span class="glyphicon glyphicon-remove"></span> Excluir</a>
                <?php }; ?>
            </td>
            <td align="left"><?php echo $current_user['name']; ?></td>
            <td><?php echo $current_user['username']; ?></td>
        </tr>            		
<?php } ?>
</table>