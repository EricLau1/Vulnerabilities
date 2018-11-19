<?php

function dd($dump) {
    var_dump($dump);
    die();
}

function toJson($data) {
    header("Content-type: application/json");
    return json_encode($data);
}

function isArray($attributes) {
    if(!is_array($attributes)){
        throw new Exception("É necessário ser um Array.");
    }
    return true;
}

function isEmpty($attributes){

    if(isArray($attributes)) {

        foreach($attributes as $field => $value) {
            if(empty($value)) {
                
                return true;
            } 
        }

    }
    return false;
}

function cripto($password){

    return password_hash($password, PASSWORD_DEFAULT);

}

function verifica($password, $hash) {

    return password_verify($password, $hash);

}

function redirect($path) {
    header("location: {$path}");
}

function flash($message, $alert = "info") {
    return "<p class='alert alert-{$alert}'> {$message} </p>";
}
