<?php

require_once "custom.php";

function connect() {
    return new PDO("mysql:host=localhost;dbname=pentest;charset=utf8", "root", "@root");
}

function getAll($table) {

    $pdo = connect();

    $sql = "select * from $table order by id desc";

    $rs = $pdo->query($sql);

    return $rs->fetchAll();

}


function find($table, $id) {

    $pdo = connect();

    $sql = "select * from {$table} where id = {$id}";

    $found = $pdo->query($sql);

    return $found->fetch();
    
}

function create($attributes, $table) {

    if(isArray($attributes)) {

        $sql = "insert into {$table} ";

        $sql .= "(" . implode(',', array_keys($attributes)) . ") values ";
    
        $sql .= "(:" . implode(',:', array_keys($attributes)) . ")";
    
        $pdo = connect();

        $insert = $pdo->prepare($sql);

        return $insert->execute($attributes);

    }
    return false;
}

function auth($attributes) {

    if(isArray($attributes)) {

        $pdo = connect();

        $sql = "select * from user where email = '{$attributes['email']}'";

        $login = $pdo->query($sql);

        return $login->fetch();
    
    }
    return null;
}

function admin($attributes) {

    if(isArray($attributes)) {

        $pdo = connect();

        $sql = "select user.email, user.password from admin inner join user on user.id = admin.user where user.email = ?";

        $login = $pdo->prepare($sql);

        $login->bindValue(1, $attributes['email']);

        $login->execute();
        
        return $login->fetch();
    
    }
    return null;
}

function getUserById($id) {

    $pdo = connect();

    $rs = $pdo->query("select * from user where id = {$id}");

    return $rs->fetch();
}

function pesquisar($busca) {

    $pdo = connect();

    $sql = "select * from feedback where comment like '%$busca%'";

    $rs = $pdo->query($sql);

    return $rs->fetchAll();

}