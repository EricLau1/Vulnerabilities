<?php

require_once "custom.php";

require_once "db.php";

$comentarios = getAll("feedback");

$message = "";

session_start();
if(isset($_SESSION['message'])) {
    $message = $_SESSION['message'];
    unset($_SESSION['message']);
}

$status = 0;

if(isset($_SESSION['login'])) {
    $status = $_SESSION['login']['status'];
    $user = find('user', $_SESSION['login']['id']);
    //dd($user);
}

?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <title>XSS CROSS SITE SCRIPTING</title>

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
 
  </head>
  <body>

    <div class="container">

        <nav class="navbar navbar-expand-lg navbar navbar-dark bg-dark">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <a class="navbar-brand" href="#">XSS</a>

            <div class="collapse navbar-collapse" id="navbarTogglerDemo03">
                <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                <li class="nav-item active">
                    <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Contact</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">About</a>
                </li>
                </ul>
                <form class="form-inline my-2 my-lg-0" method="get" action="pesquisar.php">
                <input class="form-control mr-sm-2" type="search" placeholder="Search" name="busca" aria-label="Search">
                    <button class="btn btn-outline-info my-2 my-sm-0" type="submit">Search</button>
                </form>
            </div>
        </nav> <!-- end nav -->
        <br>

        <div class="row">
            <div class="col-md-12">


                <?php if($status):?>
                    <a href="logout.php" class="btn btn-outline-info float-right"> Logout <i class="fas fa-sign-out-alt"></i></a>
                <?php else: ?>
                    <a href="forms/login.php" class="btn btn-outline-dark float-right"> Login <i class="fas fa-sign-in-alt"></i></a>
                <?php endif; ?>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <?php if(!empty($message)) { echo $message; } ?>
            </div>
        </div>
        <?php if($status): ?>
            <p><?= "Olá, {$user['name']}!"; ?></p>
        <?php endif; ?>
        <div class="row">
            <div class="col-md-6">
            
                <h6><strong>Faça seu comentário</strong></h6>
                <form action="comentar.php" method="POST">
                    <div class="form-group">
                        <input type="text" name="email" id="email" class="form-control" placeholder="Informe seu email"/>
                    </div>
                    <div class="form-group">
                        <label for="feedback">Comentar</label>
                        <textarea name="feedback" id="feedback" class="form-control" cols="30" rows="5"></textarea>
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-secondary">Publicar</button>
                    </div>
                </form>
                
            </div>
            <div class="col-md-6">
                <h6><em>comentários</em> <span class="badge badge-danger"><?= count($comentarios) ?></h6>
                <div class="comments">
                    <ul class="list-group list-group-flush">
                    <?php foreach($comentarios as $comentario): ?>
                        <li class="list-group-item text-primary"><?= $comentario['comment']; ?> <br>
                            <small class="text-dark">publicado em <?= $comentario['created_at']; ?> </small>
                        </li>
                    <?php endforeach;?>
                    </ul>
                </div>

            </div>
        </div>
    </div>

    <script src="js/detect_browser.js"></script>
    <script>  console.log(document.cookie + " "  + navigator.appName + " " + navigator.appVersion); </script>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
  </body>
</html>