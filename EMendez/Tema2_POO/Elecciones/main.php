<?php

require("Partidos.php");
require("Provincias.php");
require("Resultados.php");
error_reporting(0);
$api_url = "https://dawsonferrer.com/allabres/apis_solutions/elections/api.php?data=";

$partidos = json_decode(file_get_contents($api_url . "parties"), true);
$provincias = json_decode(file_get_contents($api_url . "districts"), true);
$resultados = json_decode(file_get_contents($api_url . "results"), true);

/*echo "<br>";
echo "<pre>";
var_dump($provincias);
echo "</pre>";*/

// https://es.wikipedia.org/wiki/Sistema_D%27Hondt#:~:text=El%20n%C3%BAmero%20de%20votos%20recibidos,hasta%20que%20estos%20se%20agoten.
// https://es.wikipedia.org/wiki/Circunscripciones_electorales_del_Congreso_de_los_Diputados

//  Creo array para introducir los valores al objeto(casting)
$results_obj = [];
//con foreach le digo que el array es como el valor que le doy y me guarda en este ultimo
// los valores del array.
//Resultados
foreach ($resultados as $resultado) {
    $results_obj[] = new Resultados($resultado["district"], $resultado["party"], $resultado["votes"]);
}

//Creo array para introducir los valores al objeto(casting)
// Partidos
$partidos_obj = [];
foreach ($partidos as $partido) {
    $partidos_obj[] = new Partidos($partido["id"], $partido["name"], $partido["acronym"], $partido["logo"], $partido["colour"]);
}

//Creo array para introducir los valores al objeto(casting)
// Provincias
$provincias_obj = [];

foreach ($provincias as $provincia => $valor) {
    $provincias_obj[] = new Provincias($valor["id"], $valor["name"], $valor["delegates"]);
}
$divisor = 0;



//La funcion me devuleve las delegaciones de la provincia seleccionada.
function Delegados($provincias_obj, $provinciaSelected)
{

    for ($h = 0; $h < count($provincias_obj); $h++) {
        if ($provincias_obj[$h]->getName() == $provinciaSelected) {
            return $provincias_obj[$h]->getDelegates();
        }
    }

}

//La funcion muestra solo los resultados de la provincia seleccionada
function ResFiltrados($results_obj)
{

    $resultsFiltrados = [];

        for ($i = 0; $i < count($results_obj); $i++) {

            if ($results_obj[$i]->getDistrito() == $_GET["provincia"]) {

                $resultsFiltrados[$i] = $results_obj[$i]->getDistrito();

            }

    }
    return $resultsFiltrados;

}

function Escanyos()
{
    // Como hago para poder saber que escaños he dado a cada partido,
    // vale guardo los escaños en un array, el que mas tenga sera el primero
    global $results_obj;
    global $provincias_obj;

    //Duplicacion de results_obj con la funcion pero podria hacerlo con un foreach pero no
    //he podido sacar (sacar)
    $dupResults_obj=[];
    $dupResults_obj = array_merge($dupResults_obj,$results_obj);

    //Ordeno los votos de mayor a menor,
    for ($k = 0; $k < count(ResFiltrados($dupResults_obj)); $k++) {
        for ($i = $k; $i < count(ResFiltrados($dupResults_obj)); $i++) {
            if ($dupResults_obj[$k]->getVotos() < $dupResults_obj[$i]->getVotos()) {
                $aux = $dupResults_obj[$k];
                $dupResults_obj[$k] = $dupResults_obj[$i];
                $dupResults_obj[$i] = $aux;
            }
        }
    }


    // Intento hacer lo de los escaños en mi cabeza y he pensado esto, el tope de veces que se repetira
    // el bucle seran las diferentes delegaciones que tiene cada provincia, y digo yo vale
    // despues si en "resultados" esta en la posicion 0 significa que es el que tiene mas votos
    // pues se divide entre dos y le damos un escaño. El punto viene que como yo lo tengo hecho
    // me sale un desplegable con todas las provincias y al seleccionarme una deberia hacerlo
    // de esa provincia, problema no se como enlazarlo, por que claro yo he ordenado los votos
    // de todo el pais, no dividiendo cada provincia por el partido que mas votos tiene.

    $divisor = 2;

    for($j=0;$j<count($dupResults_obj);$j++){
        $dupResults_obj[$j]->setEscanyos(0);
    }
// De una provincia cojo el partido que mas votos tiene, a este lo divido entre dos y le sumo un escaño, despues miro quien es el que mas votos tiene y hago la misma operación, si
// ya tiene un escaño pero sigue siendo el que mas votos tiene dividir entre 3 y sumar otro escaño... asi sucesivamente. Hasta repartir todas las delegaciones en cada provincia.
// problema no se como automatizar esto que acabo de escribir.

    //Aqui sacare los escaños,
    for ($i = 0; $i < count(Delegados($provincias_obj, $_GET["provincia"])); $i++) {

        for($j=0;$j<count(ResFiltrados($results_obj));$j++){



        }
    }

}

function tabla($resultadosProvincias)
{
    global $results_obj;
    echo "<table>";
    echo "<tr>";
    echo "<th>Circumscripción</th>";
    echo "<th>Partido</th>";
    echo "<th>Votos</th>";
    echo "<th>Escaños</th>";
    echo "</tr>";
    echo "<tr>";
    for ($i = 0; $i < count($results_obj); $i++) {

        if ($results_obj[$i]->getDistrito() == $resultadosProvincias) {
            echo "<tr>";
            echo "<td>" . $results_obj[$i]->getDistrito() . "</td>";
            echo "<td>" . $results_obj[$i]->getPartidos() . "</td>";
            echo "<td>" . $results_obj[$i]->getVotos() . "</td>";
            echo "</tr>";
        }

    }
    echo "</table>";
}


?>
    <html lang="es">
    <head>
        <title>Elecciones</title>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
                integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
                crossorigin="anonymous"></script>


    </head>
    <body>
    <form method="get" action="main.php">
        <select name="sortingCriteria">
            <option selected value="unsorted">Selecciona filtrado</option>
            <option selected value="Resultados_generales">Resultados generales</option>
            <option selected value="Filtrar_por_provincia">Filtrar por provincia</option>
            <!--Debo hacer que cuando clique en filtrar por provincia salga otro selector con las provincias -->
            <option selected value="Filtrar_por_partido">Filtrar por partido</option>
            <!--Debo hacer que cuando clique en filtrar por partidos salga otro selector con los partidos -->
        </select>
        <button type="submit">Sort</button>
    </form>
    <div>
        <div class="row">

            <?php

            Escanyos();

            ?>

        </div>
    </div>

    </body>
    </html>
<?php

if (isset($_GET["sortingCriteria"]) || isset($_GET["provincia"])) {
    //TODO: Logic to call a function depending on the sorting criteria.
    global $provincias_obj;

    if ($_GET["sortingCriteria"] == "Filtrar_por_provincia") {
        echo '<form method="get" action="main.php">';
        echo '<select name="provincia">';

        //Automatizar las selecciones con unos bucles.
        foreach ($provincias_obj as $provincia => $valores) {
            echo "<option selected value='" . $valores->getName() . "'>" . $valores->getName() . "</option> ";
        }

        echo '</select>';
        echo '<button  type="submit">Sort2</button>';
        echo '</form>';
    }

    for ($i = 0; $i < count($provincias_obj); $i++) {
        if ($_GET["provincia"] == $provincias_obj[$i]->getName()) {
            // meter el array con las circumscripciones ya hechas
            tabla($provincias_obj[$i]->getName());
            break;
        }
    }

    /*for ($k = 0; $k < count($provincias_obj); $k++) {
        echo $_GET["devolverProvincias"];*/

    //}
}

?>