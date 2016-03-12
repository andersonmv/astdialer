<?php
include_once '../connection.php';
include_once 'campaing.php';

$campaing = new campaing();

switch ($_GET['action']) {

    case 'uploadcsv':

        $counter = $campaing->processCSV($_POST, $_FILES);
        $mesage = "$counter números foram importados com sucesso!";
        break;

    case 'save':

        if (!empty($_POST['id'])) {

            $campaing->change($_POST);
        } else {

            $campaing->insert($_POST);
        }
        break;

    case 'delete':

        $campaing->delete($_GET['id']);
        break;
}
?>

<script>
    <?php if (isset($mesage)) { ?>
        alert('<?php echo $mesage; ?>');
    <?php } ?>
    window.location.href = "../index.php?page=campaing/list.php";
</script>