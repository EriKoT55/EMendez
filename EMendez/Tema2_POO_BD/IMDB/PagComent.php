<?php
error_reporting(0);
include_once("Clases/bd.php");

$conn= new bd();
$conn->local();
session_start();

$comentario=$_POST["comment"];
//$calificacion=$_POST["calificacion"];

if(isset($_POST["comment"]) && $_POST["comment"]!="" && $_POST["comment"]!=null){
    $comentario=mysqli_real_escape_string($conn,$comentario);
    //$calificacion=mysqli_real_escape_string($conn,$calificacion);

    if($conn->insertComent($comentario,$_SESSION["peliID"],$_SESSION["usrID"])){
       header("Location:PagPeli.php?PeliculaID=".$_SESSION["peliID"]);
    }else{
        ?>
        <script>
            window.alert("Hubo un error al introducir el comentario, pruebe de nuevo");
        </script>
        <?php

    }

}else{
    //NUNCA ENTRA AQUI, DEBERIA
    header("Location:PagPeli.php?PeliculaID=".$_SESSION["peliID"]);
    ?>

    <script>
        window.alert("No puede dejar el comentario en blanco");
    </script>
<?php
}


?>