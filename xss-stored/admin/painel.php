<?php

require_once "../custom.php";

session_start();

if(!isset($_SESSION['admin'])) {
    
    redirect("login.php");
    return;

}

require "../db.php";

$users = getAll("user");
$feedbacks = getAll("feedback");

//echo toJson($_SESSION['admin']);
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <title>Painel de Administrador</title>
  </head>
  <body>

      <div class="container">

      <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="users-tab" data-toggle="tab" href="#users" role="tab" aria-controls="users" aria-selected="false">Usuários</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="feed-tab" data-toggle="tab" href="#feed" role="tab" aria-controls="feed" aria-selected="false">Feedbacks</a>
            </li>
            </ul>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                
                    <div class="jumbotron" style="background: #fff;">
                        <h1 class="display-4">Administrador</h1>
                        <p class="lead">Você conseguiu acessar o painel do administrador!</p>
                        <hr class="my-4">
                        <p>Cuidado! Aquilo que for feito aqui, não pode ser desfeito.</p>
                        <a class="btn btn-primary btn-lg" href="../logout.php" role="button">Logout</a>
                    </div>

                </div>

                <div class="tab-pane fade" id="users" role="tabpanel" aria-labelledby="users-tab">
                    
                    <?php if(count($users) > 0): ?>

                    <div class="jumbotron" style="background: #fff;">
                        <h1 class="display-4">Usuários</h1>
                        <p class="lead">Usuários cadastrados no sistema.</p>
                        <hr class="my-4">
                        <p>Cuidado! Aquilo que for feito aqui, não pode ser desfeito.</p>
                       
                        <table class="table  table-borderless">
                            <th>NOME</th>
                            <th>EMAIL</th>
            
                            <?php foreach($users as $user): ?>
                                <tr>
                                    <td><?= $user['name'] ?></td>
                                    <td><?= $user['email'] ?></td>
                                    <td><a href="#" class="btn btn-outline-dark">Ver mais</a></td>
                                    <td><a href="#" class="btn btn-outline-primary">Editar</a></td>
                                    <td><a href="#" class="btn btn-outline-danger">Excluir</a></td>
                                </tr>
                            <?php endforeach; ?>
                        </table>
                    </div>
                    <?php else: ?>
                        <p class="alert alert-primary">Não possui usuários cadastrados.</p>
                    <?php endif;?>
                </div>


                <div class="tab-pane fade" id="feed" role="tabpanel" aria-labelledby="feed-tab">

                    <?php if(count($feedbacks) > 0): ?>

                    <div class="jumbotron" style="background: #fff;">
                        <h1 class="display-4">Feedbacks</h1>
                        <p class="lead">Todos os comentários postados no sistema</p>
                        <hr class="my-4">
                        <p>Cuidado! Aquilo que for feito aqui, não pode ser desfeito.</p>
                    
                        <table class="table table-borderless">
                            <th>USUÁRIO</th>
                            <th>COMENTÁRIO</th>

                            <?php foreach($feedbacks as $feed): ?>

                                <tr>
                                    <td><?= getUserById($feed['user'])['name']; ?></td>
                                    <td><?= $feed['comment'] ?></td>
                                    <td><a href="#" class="btn btn-outline-dark">Ver mais</a></td>
                                    <td><a href="#" class="btn btn-outline-primary">Editar</a></td>
                                    <td><a href="#" class="btn btn-outline-danger">Excluir</a></td>
                                </tr>
                            <?php endforeach; ?>
                        </table>
                    </div>
                    <?php else: ?>
                        <p class="alert alert-primary">Nenhum comentário foi postado ainda.</p>
                    <?php endif;?>
                </div>
            </div>
            
      </div> <!-- end container -->

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
  </body>
</html>