<?php
include_once '../config.php';
include_once 'campaing.php';

if (empty($_SESSION['logged'])) {
    header('Location: index.php');
}

$campaing = new campaing();
$campaings = $campaing->selectAll();
?>

<div class="well well-sm" align="center">
    <b style="font-weight: bold; font-size: large; color: navy">Gest&atilde;o de Campanhas</b>
</div>
<a href="index.php?page=campaing/form.php" class="btn btn-primary"><span class="glyphicon glyphicon-plus"></span> Adicionar</a>
<div><br></div>
<table class="table table-bordered table-striped table-hover table-condensed">
    <tr>
        <td width="15%" align="center">Op&ccedil;&otilde;es</td>
        <td width="30%" align="center">Nome</td>
        <td width="15%" align="center">M&aacute;x. de Tentativas</td>
        <td width="15" align="center">M&aacute;x. de Chamadas</td>
        <td width="15" align="center">Qtd. de N&uacute;meros</td>
        <td width="10%" align="center">Prefixo</td>
    </tr>
    <?php foreach ($campaings as $current_campaing) { ?>
        <tr align="center">
            <td>
                <a href="index.php?page=campaing/form.php&id=<?php echo $current_campaing['id']; ?>" class="btn-sm btn-success" ><span class="glyphicon glyphicon-pencil"></span> Alterar</a>
                <a href="campaing/process.php?action=delete&id=<?php echo $current_campaing['id']; ?>" onclick="return confirm('Deseja realmente excluir a campanha <?php echo $current_campaing['name']; ?> ?')" class="btn-sm btn-danger" ><span class="glyphicon glyphicon-remove"></span> Excluir</a>
            </td>
            <td align="left"><?php echo $current_campaing['name']; ?></td>
            <td><?php echo $current_campaing['max_retries']; ?></td>
            <td><?php echo $current_campaing['max_calls']; ?></td>
            <td><?php echo $campaing->getNumbersCount($current_campaing['id']); ?></td>
            <td><?php echo $current_campaing['prefix']; ?></td>
        </tr>            		
    <?php } ?>
</table>