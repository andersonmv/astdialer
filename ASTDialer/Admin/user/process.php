<?php
include_once '../connection.php';
include_once 'user.php';

$user = new user();

switch ($_GET['action']) {
    case 'login':

        $user->doLogin($_POST);
        break;
    case 'logout':

        session_start();
        unset($_SESSION['logged']);
        header('Location: index.php');
        break;
    case 'delete':

        $result = $user->delete($_GET['id']);
        break;
    case 'save':

        if ($_POST['password1'] == $_POST['password2']) {

            if (!empty($_POST['id'])) {

                $result = $user->change($_POST);
            } else {

                $result = $user->insert($_POST);
            }
        } else {

            $mesage = "As senhas digitas são diferentes!";
        }
        break;
}
?>

<script>
    <?php if (!empty($mesage)) { ?>
        alert('<?php echo $mesage; ?>');
    <?php }; ?>
    window.location.href = "../index.php?page=user/list.php";
</script>