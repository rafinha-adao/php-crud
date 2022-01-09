<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>PHP Crud - Edit</title>
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
        <h1 class="text-center my-5">Editar Notícia</h1>
        <?php

        require '../bd.php';

        // GET DATA TO EDIT
        $id = $_GET['id'];
        $sql = "SELECT * FROM noticia WHERE idNoticia = '$id'";
        $res = mysqli_query($con, $sql);

        $row = mysqli_fetch_assoc($res);
        $name = $row['nomeNoticia'];
        $date = $row['dataNoticia'];
        $desc = $row['descricaoNoticia'];
        if ($row['urgenteNoticia'] == 1) {
            $urgent = "checked";
        } else {
            $urgent = "!checked";
        }

        echo '
            <form method="POST" autocomplete="off">
                <div class="container my-5">
                    <div class="mb-3">
                        <label class="form-label">Nome</label>
                        <input type="text" class="form-control" name="name" required value="' . $name . '">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Descrição</label>
                        <textarea class="form-control" name="description" style="height: 10rem; resize: none;" required>' . $desc . '</textarea>
                    </div>
                    <div class="mb-3">
                        <input type="date" name="date" value="' . $date . '" required>
                    </div>
                    <div class="mb-3">
                        <input class="form-check-input" type="checkbox" name="urgent" ' . $urgent . '>
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
        ';

        // RESPONSE ERROR
        if ($res === false) {
            echo "Erro";
            die(mysqli_error($con));
        }

        ?>
        <footer class="d-flex flex-wrap align-items-center justify-content-center py-3 my-4 border-top">
            <div class="col-md-4 d-flex align-items-center justify-content-center">
                <span class="text-muted">PHP Crud - Rafael Adão</span>
            </div>
        </footer>
    </div>
</body>

</html>

<?php

require '../bd.php';

// EDIT AND UPDATE DATA
if (isset($_POST['submit'])) {

    $id = $_GET['id'];
    $name = $_POST['name'];
    $desc = $_POST['description'];
    $date = $_POST['date'];
    if (isset($_POST['urgent'])) {
        $urgent = 1;
    } else {
        $urgent = 0;
    }

    $sql = "UPDATE `noticia`
            SET nomeNoticia = '$name', 
                descricaoNoticia = '$desc',
                urgenteNoticia = '$urgent',
                dataNoticia = '$date'
            WHERE idNoticia = '$id'";

    $res = mysqli_query($con, $sql);

    // RESPONSE ERROR
    if ($res === false) {
        die(mysqli_error($con));
    } else {
        header('Location: http://localhost:4200/pages/search.php');
    }
}

?>