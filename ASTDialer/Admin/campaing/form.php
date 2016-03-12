<?php
include_once '../config.php';
include_once 'campaing.php';

if (empty($_SESSION['logged'])) {
    header('Location: index.php');
}

$campaing = new campaing();

if (!empty($_GET['id'])) {
    $campaing->load($_GET['id']);
}
?>

<div class="panel panel-primary">
    <div class="panel-heading" align="center" style="font-weight: bold;">
        Gest&atilde;o de Campanhas
    </div>
    <div class="panel-body">
        <form class="form-horizontal" action="campaing/process.php?action=save" method="post">
            <input type="hidden" name="id" value="<?php echo $campaing->getId(); ?>" />
            <div class="form-group">
                <label for="state" class="col-sm-2 control-label">Ativo</label>
                <div class="col-sm-10">
                    <?php
                    if ($campaing->getState() == "on") {
                        ;
                        ?>
                        <input type="checkbox" name="state" checked/>
                    <?php
                    } else {
                        ;
                        ?>
                        <input type="checkbox" name="state"/>
<?php }; ?>
                </div>
            </div>
            <div class="form-group">
                <label for="name" class="col-sm-2 control-label">Nome</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="name" id="name" value="<?php echo $campaing->getName(); ?>" />
                </div>
            </div>
            <div class="form-group">
                <label for="max_retries" class="col-sm-2 control-label">M&aacute;x. Tentativas</label>
                <div class="col-sm-10">
                    <input type="number" class="form-control" name="max_retries" id="max_retries" value="<?php echo $campaing->getMax_retries(); ?>" /> 
                </div>
            </div>
            <div class="form-group">
                <label for="max_calls" class="col-sm-2 control-label">M&aacute;x. Chamadas</label>
                <div class="col-sm-10">
                    <input type="number" class="form-control" name="max_calls" id="max_calls" value="<?php echo $campaing->getMax_calls(); ?>" />
                </div>
            </div>
            <div class="form-group">
                <label for="prefix" class="col-sm-2 control-label">Prefixo da Campanha</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="prefix" id="prefix" value="<?php echo $campaing->getPrefix(); ?>" />
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

<?php
$id = $campaing->getId();
if (!empty($id)) {; ?>
    <div class = "panel panel-primary">
        <div class = "panel-heading" align = "center" style = "font-weight: bold;">
            Inserir N&uacute;meros
        </div>
        <div class = "panel-body">
            <form class = "form-horizontal" enctype = "multipart/form-data" action = "campaing/process.php?action=uploadcsv" method = "post">
                <input type = "hidden" name = "id" value = "<?php echo $campaing->getId(); ?>" />
                <div class = "form-group">
                    <label for = "numberslist" class = "col-sm-2 control-label">Arquivo de Lote</label>
                    <div class = "col-sm-10">
                        <input type = "file" class = "form-control" name = "numberslist" id = "numberslist"/>
                    </div>
                </div>
                <div class = "form-group">
                    <div class = "col-sm-offset-2 col-sm-10">
                        <button type = "submit" class = "btn btn-success"><span class = "glyphicon glyphicon-ok"></span> Enviar</button>
                    </div>
            </form>
        </div>
    </div>
<?php }; ?>