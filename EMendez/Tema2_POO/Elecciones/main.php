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

//Duplicar objeto results, para trabajar en el duplicado e ir dividiendo los votos para sacar los escaños despues pasar los escaños al original
$resultsDuplicate_obj = $results_obj;
function tabla($resultSelector, $objUtilizado)
{

    echo "<table>";
    echo "<tr>";
    echo "<th>Circumscripción</th>";
    echo "<th>Partido</th>";
    echo "<th>Votos</th>";
    echo "<th>Escaños</th>";
    echo "</tr>";
    echo "<tr>";
    for ($i = 0; $i < count($objUtilizado); $i++) {
        if($resultSelector=="Resultados_generales"){
            echo "<tr>";
            echo "<td> Generales </td>";
            echo "<td>" . $objUtilizado[$i]->getName() . "</td>";
            echo "<td>" . $objUtilizado[$i]->getVotos() . "</td>";
            echo "<td>" . $objUtilizado[$i]->getEscanyos() . "</td>";
            echo "</tr>";
        } elseif($objUtilizado[$i]->getDistrito() == $resultSelector) {
            echo "<tr>";
            echo "<td>" . $objUtilizado[$i]->getDistrito() . "</td>";
            echo "<td>" . $objUtilizado[$i]->getPartidos() . "</td>";
            echo "<td>" . $objUtilizado[$i]->getVotos() . "</td>";
            echo "<td>" . $objUtilizado[$i]->getEscanyos() . "</td>";
            echo "</tr>";
        }

    }
    echo "</table>";
}
/*
echo "<br>";
echo "<pre>";
var_dump($resultsDuplicate_obj);
echo "</pre>";
*/

//Funcion para sacar delegaciones
function Delegados($provincias_obj, $provinciaSelected)
{

    for ($h = 0; $h < count($provincias_obj); $h++) {
        if ($provincias_obj[$h]->getName() == $provinciaSelected) {
            return $provincias_obj[$h]->getDelegates();
        }
    }

}
//Filtrar resultados por provincia seleccionada
function ResultsFiltrados($resultsDuplicate_obj, $provinciaSelected)
{
    $resultsFiltrados = [];
    for ($i = 0; $i < count($resultsDuplicate_obj); $i++) {

        if ($resultsDuplicate_obj[$i]->getDistrito() == $provinciaSelected) {
            $resultsFiltrados[] = $resultsDuplicate_obj[$i];
        }

    }
    return $resultsFiltrados;
}

function Escanyos($provinciaSelected)
{
    global $results_obj;
    global $provincias_obj;
    global $resultsDuplicate_obj;
    $resultadosFiltrados = ResultsFiltrados($resultsDuplicate_obj, $provinciaSelected);
    $delegados = Delegados($provincias_obj, $provinciaSelected);

    //Sacar el minimo de votos
    $resultVotos=[];
    for ($i = 0; $i < count($resultadosFiltrados); $i++) {

        $resultVotos[]=$resultadosFiltrados[$i]->getVotos();

    }
    $votosMinimos=array_sum($resultVotos)*0.03;

    $posicion=0;
    $escanyos=[];

    // Escanyos todos a 0
    for ($j = 0; $j < count($resultVotos); $j++) {
        $escanyos[]=0;
    }


    for ($k = 0; $k < $delegados; $k++) {
        $mayor = 0;
        for ($i = 0; $i < count($resultadosFiltrados); $i++) {
            if ($resultadosFiltrados[$i]->getVotos() > $votosMinimos && $resultVotos[$i] > $mayor) {

                $mayor=$resultVotos[$i];
                $posicion= $i;

            }

        }
    $escanyos[$posicion]+=1;
    $resultVotos[$posicion]= $resultadosFiltrados[$posicion]->getVotos() / ($escanyos[$posicion]+1);

    }
    $posicion=0;

    for($i=0;$i<count($results_obj);$i++){

        if($results_obj[$i]->getDistrito() == $provinciaSelected) {

            $results_obj[$i]->setEscanyos($escanyos[$posicion]);
            $posicion++;
        }

    }

}



function Generales($results_obj,$partidos_obj){


    $resultsVotos=[];
    $resultsEscanyos=[];

    for($i=0;$i<count($results_obj);$i++){
    Escanyos($results_obj[$i]->getDistrito());
        for($k=0;$k<count($partidos_obj);$k++){

            if($results_obj[$i]->getPartidos() == $partidos_obj[$k]->getName()){

                $resultsEscanyos[$k]+=$results_obj[$i]->getEscanyos();
                $resultsVotos[$k]+=$results_obj[$i]->getVotos();

                $partidos_obj[$k]->setVotos($resultsVotos[$k]);
                $partidos_obj[$k]->setEscanyos($resultsEscanyos[$k]);

            }

        }
    }


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
            <option selected value="Filtrar_por_partido">Filtrar por partido</option>
            <!--Debo hacer que cuando clique en filtrar por partidos salga otro selector con los partidos -->
        </select>
        <button type="submit">Sort</button>
    </form>

    </body>
    </html>
<?php

if (isset($_GET["sortingCriteria"]) || isset($_GET["provincia"]) || isset($_GET["partido"])) {
    //TODO: Logic to call a function depending on the sorting criteria.
    global $provincias_obj;

    if ($_GET["sortingCriteria"] == "Resultados_generales") {
        Generales($results_obj,$partidos_obj);
        //Mirar bien, lo puse, pero no esta comprobado su funcionamiento, tocar tabla para mostrar general
        tabla($_GET["sortingCriteria"],$partidos_obj);
    }

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

    for ($i = 0; $i < count($results_obj); $i++) {
        if ($_GET["provincia"] == $results_obj[$i]->getDistrito()) {

            Escanyos($results_obj[$i]->getDistrito());
            tabla($results_obj[$i]->getDistrito(),$results_obj);
            break;
        }
    }


    /*for ($k = 0; $k < count($provincias_obj); $k++) {
        echo $_GET["devolverProvincias"];*/

    //}
}

?>

