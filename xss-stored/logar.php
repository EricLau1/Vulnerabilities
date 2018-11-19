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

$user = auth($_POST);

if($user != null) {

    if( verifica($_POST['password'], $user['password']) ) {

        $message = flash("logado com sucesso!", "success");

        $_SESSION['login'] = [
            "id" => $user['id'],
            "status" => true
        ];

    }else {

        $message = flash("senha incorreta.", "warning");

    }

} else {

    $message = flash("email incorreto ou usuário não existe.", "warning");

}

$_SESSION['message'] = $message;

redirect("index.php");
