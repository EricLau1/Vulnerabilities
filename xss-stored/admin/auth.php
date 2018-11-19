<?php

require_once "../custom.php";

if(isEmpty($_POST)) {
    redirect("login.php");
    return;
}

require_once "../db.php";

$admin = admin($_POST);

//echo toJson($admin);

if($admin != null) {

    if(verifica($_POST['password'], $admin['password'])) {

        session_start();

        $_SESSION['admin'] = $admin['email'];

        redirect("painel.php");
        return;

    }

}

redirect("login.php");
return;

?>

