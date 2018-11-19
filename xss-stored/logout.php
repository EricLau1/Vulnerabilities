<?php

require "custom.php";

session_start();

if(isset($_SESSION['login'])) {
    unset($_SESSION['login']);
    $_SESSION['message'] = flash("Você saiu da conta.");
}

if(isset($_SESSION['admin'])) {
    unset($_SESSION["admin"]);
    $_SESSION['message'] = flash("Você saiu do painel de administrador.");
}



redirect("/");
