<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">

    <title>PHP Crud - Search</title>

    <style>
        table {
            max-width: 81rem;
            width: 90%;
        }

        th,
        td {
            text-align: center;
        }

        td {
            width: 20.25rem;
            vertical-align: middle;
        }
    </style>
</head>

<body>
    <div class="container">
        <nav class="navbar navbar-expand-sm navbar-light bg-light">
            <ul class="navbar-nav">
                <li class="nav-item m-1">
                    <a type="button" class="btn btn-dark" href="./create.php">Adicionar</a>
                </li>
                <li class="nav-item m-1">
                    <a type="button" class="btn btn-dark" href="./search.php?">Pesquisar</a>
                </li>
            </ul>
        </nav>
        <h1 class="text-center my-5">Pesquisar Notícia</h1>
        <table class="table table-striped table-light">
            <thead>
                <tr>
                    <th scope="col">Nome</th>
                    <th scope="col">Urgente?</th>
                    <th scope="col">Data</th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                <?php

                require '../bd.php';

                // GET DATA
                $sql = "SELECT * FROM `noticia`";
                $res = mysqli_query($con, $sql);

                // SHOW DATA
                while ($row = mysqli_fetch_assoc($res)) {
                    $id = $row['idNoticia'];
                    $name = $row['nomeNoticia'];
                    $date = date("d/m/Y", strtotime($row['dataNoticia']));
                    if ($row['urgenteNoticia'] == 1) {
                        $urgent = "Sim";
                    } else {
                        $urgent = "Não";
                    }

                    echo '
                        <tr>
                            <td>' . $name . '</td>
                            <td>' . $urgent . '</td>
                            <td>' . $date . '</td>
                            <td>
                                <a type="button" class="btn btn-warning m-1" href="./edit.php?id=' . $id . '">
                                    <i class="bi bi-pencil-square"></i>
                                </a>
                                <a type="button" class="btn btn-danger m-1" href="./delete.php?id=' . $id . '">
                                    <i class="bi bi-trash"></i>
                                </a>
                            </td>
                        </tr>
                    ';
                }

                // RESPONSE ERROR
                if ($res === false) {
                    die(mysqli_error($con));
                }

                ?>
            </tbody>
        </table>
        <footer class="d-flex flex-wrap align-items-center justify-content-center py-3 my-4 border-top">
            <div class="col-md-4 d-flex align-items-center justify-content-center">
                <span class="text-muted">PHP Crud - Rafael Adão</span>
            </div>
        </footer>
    </div>

</body>

</html>