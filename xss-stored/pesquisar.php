<?php

require_once "custom.php";

$message = flash("campo obrigatório", "dark");

session_start();

if (isEmpty($_GET)) {

    $_SESSION['message'] = $message;
    redirect("../index.php");
    return;

}


require_once "db.php";

try {


    $results = pesquisar($_GET["busca"]);

    $message = flash("não foi encontrado nenhum resultado com : <strong><em> {$_GET['busca']} </em></strong>", "warning");

    $count = count($results);

    if( $count > 0 ) {

        //echo toJson($results);
        //return;
        $message = flash( "<strong> {$count} </strong> resultados encontrados!", "success");

    }

} catch(PDOException $e) {

    die("Internal Server Error. ". $e->getMessage());
}


$_SESSION['message'] = $message;
redirect("../index.php");


