<?php
include_once("Persona.php");
include_once("Pelicula.php");
include_once("Genero.php");
include_once("BD.php");
/*https://www.imdb.com/title/tt2382320/?pf_rd_m=A2FGELUUNOQJNL&pf_rd_p=ea4e08e1-c8a3-47b5-ac3a-75026647c16e&pf_rd_r=1VHKKEY8F9SF79HJTAB3&pf_rd_s=center-1&pf_rd_t=15506&pf_rd_i=moviemeter&ref_=chtmvm_tt_6*/

//Coger los datos para poder trabajar el Obj
 $objPelicula=ObjPelicula();
global $objPelicula;


//Ordenacion de las peliculas
function Ranking(){

}
function Nuevo(){

}
function Antiguo(){

}

$sortingCriteria = "";
if (isset($_GET["sortingCriteria"])) {
    $sortingCriteria = $_GET["sortingCriteria"];
    switch ($sortingCriteria) {
        case "mejoresCalificadas":
            //$characters = getSortedCharactersById($characters);
            break;
        case "Antiguas":
           // $characters = getSortedCharactersByOrigin($characters);
            break;
        case "Nuevas":
            //$characters = getSortedCharactersByStatus($characters);
            break;
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IMDBE</title>
    <link type="text/css" rel="stylesheet" href="Estilos/estilosMain.css">
    <!-- Este link es para poder utilizar la libreria de iconos de Font Awesome-->
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
</head>
<body>
<header>

</header>
  <nav class="contenedorNav">
    <div >
        <!--Para hacer una barra de busqueda decente-->
       <!--https://webdesign.tutsplus.com/es/tutorials/css-experiments-with-a-search-form-input-and-button--cms-22069-->
        <span class="icon"><i class="fa fa-search"></i></span>
        <input type="search" id="buscar" placeholder="Search..." />
    </div>
      <!--Poner nombre a las clases-->
    <div class="contenedorForm">
        <form class="" action="PagMain.php">
            <select class="" aria-label="Sorting criteria" name="sortingCriteria">
                <option <?php echo($sortingCriteria == "" ? "selected" : "") ?> value="unsorted">Sorting criteria
                </option>
                <option <?php echo($sortingCriteria == "mejoresCalificadas" ? "selected" : "") ?> value="mejoresCalificadas">Mejores Calificaciones</option>
                <option <?php echo($sortingCriteria == "Antiguas" ? "selected" : "") ?> value="Antiguas">Mas Antiguas</option>
                <option <?php echo($sortingCriteria == "Nuevas" ? "selected" : "") ?> value="Nuevas">Mas Nuevas</option>
            </select>
            <button class="" type="submit">Sort</button>
        </form>
    </div>
  </nav>
<?php for($i=0;$i<count($objPelicula);$i++){?>
  <div class="contenedor">
      <div class="contenedorPelis">
         <a href="PagPeli.php"> <img src="<?php echo $objPelicula[$i]->getIMG() ?>">
          <p class="nomPeli"><?php echo $objPelicula[$i]->getNombre() ?></p>
          <p><?php echo $objPelicula[$i]->getCalificacion() ?></p>
         </a>
      </div>
  </div>
      <?php }?>
</body>
</html>
