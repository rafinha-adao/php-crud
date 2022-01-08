<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>PHP Crud</title>
</head>

<body>
    <div class="container">
        <nav class="navbar navbar-expand-sm navbar-light bg-light">
            <ul class="navbar-nav">
                <li class="nav-item m-1">
                    <a type="button" class="btn btn-dark" href="./create.php">Adicionar</a>
                </li>
                <li class="nav-item m-1">
                    <a type="button" class="btn btn-dark" href="./search.php">Pesquisar</a>
                </li>
            </ul>
        </nav>
        <form method="POST" autocomplete="off">
            <div class="container my-5">
                <div class="mb-3">
                    <label class="form-label">Nome</label>
                    <input type="text" class="form-control" name="name" placeholder="Insira o nome da notícia" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Descrição</label>
                    <textarea class="form-control" placeholder="Insira a descrição da notícia" name="description" style="height: 10rem" required></textarea>
                </div>
                <div class="mb-3">
                    <input class="form-check-input" type="checkbox" name="urgent">
                    <label class="form-check-label">
                        Urgente
                    </label>
                </div>
                <div class="d-flex justify-content-end">
                    <button href="./search.php" type="submit" class="btn btn-primary" name="submit">
                        Editar Notícia
                    </button>
                </div>
            </div>
        </form>
        <footer class="d-flex flex-wrap align-items-center justify-content-center py-3 my-4 border-top">
            <div class="col-md-4 d-flex align-items-center justify-content-center">
                <span class="text-muted">Grupo Maxpro Educacional</span>
            </div>
        </footer>
    </div>
</body>

</html>

<?php

require '../bd.php';

if (isset($_POST['submit'])) {
    $id = $_GET['id'];
    $name = $_POST['name'];
    $desc = $_POST['description'];

    if (isset($_POST['urgent'])) {
        $urgent = 1;
    } else {
        $urgent = 0;
    }
    $date = date("y.m.d");

    $sql = "INSERT INTO `noticia`(nomeNoticia, descricaoNoticia, urgenteNoticia, dataNoticia) 
        VALUES('$name', '$desc', '$urgent', '$date') WHERE idNoticia = '$id'";

    $res = mysqli_query($con, $sql);

    if ($res === false) {
        die(mysqli_error($con));
    } else {
        header('Location: http://localhost:4200/crud/search.php');
    }
}

?>