<?php

require '../bd.php';

if(isset($_GET['id'])) {

    $id = $_GET['id'];
    $sql = "DELETE FROM noticia WHERE idNoticia = '$id'";
    
    $res = mysqli_query($con, $sql);
    if ($res === false) {
        die(mysqli_error($con));
    }
    else {
        header('Location: http://localhost:4200/crud/search.php');
    }
}