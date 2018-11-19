<?php


require_once "custom.php";

session_start();

$message = flash("campos obrigatórios.", "dark");

if(isEmpty($_POST)){

    $_SESSION['message'] = $message;
    redirect("../index.php");
    return;
}

require_once "db.php";

$_POST['password'] = cripto($_POST['password']);

if(create($_POST, "user")) {
    
    $message = flash("conta criada com sucesso!", "success");

} else {
    
    $message = flash("Oops! Ocorreu um erro.", "danger");

}

$_SESSION['message'] = $message;

redirect("index.php");