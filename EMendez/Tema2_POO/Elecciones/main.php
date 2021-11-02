<?php

include("Partidos.php");
include("Provincias.php");
include("Resultados.php");

$api_url ="https://dawsonferrer.com/allabres/apis_solutions/elections/api.php?data=";

$partidos = json_decode(file_get_contents($api_url . "parties"), true);
$provincias= json_decode(file_get_contents($api_url . "districts"), true);
$resultados= json_decode(file_get_contents($api_url . "results"), true);


/*echo "<br>";
echo "<pre>";
var_dump($resultados);
echo "</pre>";*/



// https://es.wikipedia.org/wiki/Sistema_D%27Hondt#:~:text=El%20n%C3%BAmero%20de%20votos%20recibidos,hasta%20que%20estos%20se%20agoten.
// https://es.wikipedia.org/wiki/Circunscripciones_electorales_del_Congreso_de_los_Diputados


    /*echo "<br>";
    echo "<pre>";
    var_dump($resultados);
    echo "</pre>";*/


//  Creo array para introducir los valores al objeto(casting)
$results_obj = [];
//con foreach le digo que el array es como el valor que le doy y me guarda en este ultimo
// los valores del array.
//Resultados
foreach ($resultados as $resultado){
    $results_obj[] = new Resultados($resultado["district"], $resultado["party"], $resultado["votes"]);
}

//Creo array para introducir los valores al objeto(casting)
// Partidos
$partidos_obj=[];
foreach ($partidos as $partido){
    $partidos_obj[]= new Partidos($partido["id"],$partido["name"],$partido["acronym"],$partido["logo"],$partido["colour"]);
}

//Creo array para introducir los valores al objeto(casting)
// Provincias
$provincias_obj=[];
foreach ($provincias as $provincia){
    $provincias_obj[]=new Provincias($provincia["id"],$provincia["name"],$provincia["delegates"]);
}
function Escanyos(){
    global $results_obj;

    for($i=0;$i<count($results_obj);$i++){
        if($results_obj[$i]->getDistrito()==) {

        }
    }

}

if (isset($_GET["sortingCriteria"])) {
    //TODO: Logic to call a function depending on the sorting criteria.
    $array=[];  // entre las comillas poner el criterio por el cual mostrara los datos por ejemplo "Madrid"
    if ($_GET["sortingCriteria"] == "Madrid") {
        // meter el array con las circumscripciones ya hechas
        $array=circumscripcion();

    } elseif ($_GET["sortingCriteria"] == "Barcelona") {

        $array= circumscripcion();

    } elseif ($_GET["sortingCriteria"] == "Valencia") {

        $array=circumscripcion();

    }
}

?>
<html lang="es">
<head>
    <title>Elecciones</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
            crossorigin="anonymous"></script>


    <style>
        :root {
            --gradient: linear-gradient(to left top, #FF512F 60%, black 40%) !important;
        }

        body {
            background: white !important;
        }

        .custom .btn {
            border: 5px solid;
            border-image-slice: 1;
            background: var(--gradient) !important;
            -webkit-background-clip: text !important;
            -webkit-text-fill-color: transparent !important;
            border-image-source: var(--gradient) !important;
            text-decoration: none;
            transition: all .4s ease;
        }

        .custom .btn:hover, .btn:focus {
            background: var(--gradient) !important;
            -webkit-background-clip: initial !important;
            -webkit-text-fill-color: #fff !important;
            border: 5px solid #fff !important;
            box-shadow: #222 1px 0 10px;
            text-decoration: underline;
        }

        .custom {
            padding-top: 100px;
        }

    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container-fluid">
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <form class="d-flex" action="elefantesMultifilter.php">
                <select class="form-control me-2 form-select" aria-label="Sorting criteria" name="sortingCriteria">
                    <option selected value="unsorted">Selecciona una circumscripción</option>
                    <?php

                        //Automatizar las selecciones con unos bucles.

                    ?>
                </select>
                <button class="btn btn-outline-success" type="submit">Sort</button>
            </form>
        </div>
    </div>
</nav>
<div class="container mx-auto mt-4 custom">
    <div class="row">
     <table>
         <tr>
             <th>Circumscripción</th>
             <th>Partido</th>
             <th>Votos</th>
             <!--<th>Escaños</th>-->
         </tr>
     <?php

        // Tabla para mostrar los datos
        for($i=0;$i<count($results_obj);$i++){
            echo "<tr>";

             echo "<td>".$results_obj[$i]->getDistrito() ."</td>";
             echo "<td>".$results_obj[$i]->getPartidos() ."</td>";
             echo "<td>".$results_obj[$i]->getVotos() ."</td>";

            echo "<tr>";
        }

     Escanyos();
     ?>
     </table>
    </div>
</div>

</body>
</html>
