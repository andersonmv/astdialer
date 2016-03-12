<?php
include_once 'config.php';
include_once 'connection.php';
include_once 'camapaing/campaing.php';

if (empty($_SESSION['logged'])) {
    header('Location: index.php');
}

$connection = new connection();
$sql = "SELECT count(phonenumber) AS numbers FROM numberlist WHERE state = 0";
$connection->connect();
$data = $connection->getData($sql);
$data = $data[0];

$campaing = new campaing();
$campaings = $campaing->selectAll();
?>

<meta http-equiv="refresh" content="5"/>
<div class="container">
    <div class="container">
        <div class="well well-sm" align="center">
            <b style="font-weight: bold; font-size: large; color: navy">Dashboard</b>
        </div>
    </div>
    <div class="container">
        <table class="table table-bordered table-striped table-hover table-condensed">
            <tr>
                <td align="center" width="70%">Total de N&uacute;meros Restantes</td>
            </tr>
            <tr>
                <td align="center" style="font-size: 30px; font-weight: bold; color: navy"><?php echo $data['numbers']; ?></td>
            </tr>
        </table>
    </div>
    <div class="container">
        <table class="table table-bordered table-striped table-hover table-condensed">
            <tr>
                <td align="center" width="70%">Total de Chamadas Em Curso</td>
            </tr>
            <tr>
                <td align="center" style="font-size: 30px; font-weight: bold; color: navy">0</td>
            </tr>
        </table>
    </div>
    <div class="container">
        <table class="table table-bordered table-striped table-hover table-condensed">
            <tr>
                <td align="center" width="70%">Campanhas Ativas</td>
            </tr>
            <?php foreach ($campaings as $current_campaing) {; ?>
    <?php if ($current_campaing['state'] == "on") {; ?>
                    <tr>
                        <td align="center" style="font-size: 20px; font-weight: bold; color: navy"><?php echo $current_campaing['name']; ?></td>
                    </tr>
    <?php }; ?>
<?php }; ?>
        </table>
    </div>
</div>