<?php
include_once("Clases/bd.php");

$conn= new bd();
$conn->local();
session_start();

$comentario=$_POST["comment"];
//$calificacion=$_POST["calificacion"];

/**
 * PONE LOS MISMOS ID's DE USUARIO Y DE LA PELICULA A TODOS LOS COMENTARIOS
 * EN TODAS LAS PELICULAS
 */

if(isset($_POST["comment"]) && $_POST["comment"]!=""){
    $comentario=mysqli_real_escape_string($conn,$comentario);
    //$calificacion=mysqli_real_escape_string($conn,$calificacion);
    /**
     * DEBEN SER ESTOS PARAMETROS QUE NO HACEN LO QUE yo creo que deberian hacer,
     * Deberia cambiar la sesion PeliculaID y Sesson UsuarioID, por que
     * no se veran los comentarios hasta que no inicies sesion, aparte
     * no identifica bien a los usuarios.
     */
    if($conn->insertComent($comentario,$_SESSION["peliID"],$_SESSION["usrID"])){
        //Mirar de como hacer bien el _GET para mandar a la PagPeli correspondiente
        // la pagina anterior, en este caso
       header("Location:PagMain.php");
    }else{
        ?>
        <script>
            window.alert("Hubo un error al introducir el comentario, pruebe de nuevo");
        </script>
        <?php
    }

}else{
    header("Location:PagMain.php");
    ?>

    <script>
        window.alert("No puede dejar el comentario en blanco");
    </script>
<?php
}


?>