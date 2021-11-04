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
var_dump($provincias);
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
$divisor=0;
// De una provincia cojo el partido que mas votos tiene, a este lo divido entre dos y le sumo un escaño, despues miro quien es el que mas votos tiene y hago la misma operación, si
// ya tiene un escaño pero sigue siendo el que mas votos tiene dividir entre 3 y sumar otro escaño... asi sucesivamente. Hasta repartir todas las delegaciones en cada provincia.
// problema no se como automatizar esto que acabo de escribir.

function Escanyos(){
    // Como hago para poder saber que escaños he dado a cada partido,
    // vale guardo los escaños en un array, el que mas tenga sera el primero
    global $results_obj;
    global $provincias_obj;
    $escanyo=[];

    //Ordeno los votos de mayor a menor
    for($k=0;$k<count($results_obj);$k++) {
      for ($i = $k; $i < count($results_obj); $i++) {
          if ($results_obj[$k]->getVotos() < $results_obj[$i]->getVotos()) {
              $aux = $results_obj[$k];
              $results_obj[$k] = $results_obj[$i];
              $results_obj[$i] = $aux;
          }
          $divisor = 0;
          $escanyo = 0;

      }
  }
    // Intento de hacer lo de los escaños en mi cabeza he pensado esto, el tope de veces que se repetira
    // el bucle seran las diferentes delegaciones que tiene cada provincia, y digo yo vale
    // despues si en resultados esta en la posicion significa que es el que tiene mas votos
    // pues se divide entre dos y le damos un escaño. El punto viene que como yo lo tengo echo
    // me sale un desplegable con todas las provincias y al seleccionarme una deberia hacerlo
    // de esa provincia, problema no se como enlazarlo, por que claro yo he ordenado los votos
    // de todo el pais, no dividiendo cada provincia el partido que mas votos tiene.
    for($h=0;$h<count($provincias_obj);$h++){
        for ($j=0;$j<count($provincias_obj[$h]->getDelegates());$j++) {

            $results_obj[0]/2;

            if($results_obj[0] && $escanyo==0){
                $results_obj[0]/2;
                $escanyo++;
            }

        }
    }
      echo "<br>";
      echo "<pre>";
      var_dump($results_obj);
      echo "</pre>";
}
function tabla($resultadosProvincias){
    global $results_obj;
    echo "<br>";
    echo "<br>";
    echo "<br>";
    echo "<br>";
    echo "<table>";
    echo "<tr>";
    echo "<th>Circumscripción</th>";
    echo "<th>Partido</th>";
    echo "<th>Votos</th>";
    echo "<th>Escaños</th>";
    echo "</tr>";
    for($i=0;$i<count($results_obj);$i++){

        echo "<tr>";
        if($results_obj[$i]->getDistrito()==$resultadosProvincias){
            echo "<td>" . $results_obj[$i]->getDistrito() . "</td>";
            echo "<td>" . $results_obj[$i]->getPartidos() . "</td>";
            echo "<td>" . $results_obj[$i]->getVotos() . "</td>";
        }
        echo "<tr>";
    }
    echo "</table>";
}
if (isset($_GET["sortingCriteria"])) {
    //TODO: Logic to call a function depending on the sorting criteria.
    $array=[];  // entre las comillas poner el criterio por el cual mostrara los datos por ejemplo "Madrid"
    for($i=0;$i<count($provincias_obj);$i++){

    if ($_GET["sortingCriteria"] == $provincias_obj[$i]->getName()) {
        // meter el array con las circumscripciones ya hechas
        tabla($provincias_obj[$i]->getName());
        break;
    }
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
            <form class="d-flex" action="main.php">
                <select class="form-control me-2 form-select" aria-label="Sorting criteria" name="sortingCriteria">
                    <option selected value="unsorted">Selecciona una circumscripción</option>
                    <?php

                        //Automatizar las selecciones con unos bucles.
                      for($k=0;$k<count($provincias_obj);$k++){
                              echo "<option selected value='".$provincias_obj[$k]->getName()."'>".$provincias_obj[$k]->getName()."</option> ";
                      }
                    ?>
                </select>
                <button class="btn btn-outline-success" type="submit">Sort</button>
            </form>
        </div>
    </div>
</nav>
<div class="container mx-auto mt-4 custom">
    <div class="row">

     <?php

     /*Escanyos();*/

     ?>
     </table>
    </div>
</div>

</body>
</html>
