<?php

require "custom.php";
session_start();

$message = flash("Entre com sua conta para comentar!");
if(!isset($_SESSION['login'])) {

   $_SESSION['message'] = $message;
   redirect("index.php");
   return;
}


require "db.php";

$message = flash("campos obrigatórios.", "dark");

if(isEmpty($_POST)) {

    $_SESSION['message'] = $message;

    redirect("index.php");
    return;

}

$dados = [
    "user" => $_SESSION['login']['id'],
    "comment" => $_POST['feedback']
];

if(!create($dados, "feedback")) {
    $message = flash("Oops! ocorreu um erro!", "danger");
} else {
    $message = "";
}

$_SESSION['message'] = $message;

redirect("index.php");
