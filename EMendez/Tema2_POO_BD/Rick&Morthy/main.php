<?php

require("Character.php");
require("Episode.php");
require("Location.php");
require("BD.php");

/*$seed = 3702; //TODO: LAST 4 NUMBERS OF YOUR DNI.
$api_url = "https://dawsonferrer.com/allabres/apis_solutions/rickandmorty/api.php?seed=" . $seed . "&data=";*/

$characters = Characters();
$episodes = Episodes();
$locations = Locations();

/*
    echo "<br>";
    echo "<pre>";
    var_dump($locations);
    echo "</pre>";
*/

function getSortedCharactersById($characters)
{
    //TODO: Your code here.

    for($i=0;$i<count($characters);$i++){
        for($j=0;$j<count($characters);$j++){

            if($characters[$i]["id"]<$characters[$j]["id"]){

                $aux=$characters[$i];
                $characters[$i]=$characters[$j];
                $characters[$j]=$aux;

            }

        }
    }
    return $characters;
}

function getSortedCharactersByOrigin($characters)
{
    //TODO: Your code here.
    for($i=0;$i<count($characters);$i++){
        for($j=0;$j<count($characters);$j++){

            if($characters[$i]["origin"]<$characters[$j]["origin"]){

                $aux=$characters[$i];
                $characters[$i]=$characters[$j];
                $characters[$j]=$aux;

            }

        }
    }
    return $characters;
    /*echo "<br>";
    echo "<pre>";
    var_dump($characters);
    echo "</pre>";*/
}

function getSortedCharactersByStatus($characters)
{
    //TODO: Your code here.
    for($i=0;$i<count($characters);$i++){
        for($j=0;$j<count($characters);$j++){

            if($characters[$i]["status"]<$characters[$j]["status"]){

                $aux=$characters[$i];
                $characters[$i]=$characters[$j];
                $characters[$j]=$aux;

            }

        }
    }
    return $characters;
}

//A_Entidades

function createCharacter(){
    global $characters;

    for($i=0;$i<count($characters);$i++){

        $characters[$i]=new Character($characters[$i]["id"],$characters[$i]["name"],$characters[$i]["status"],
            $characters[$i]["species"],$characters[$i]["type"],$characters[$i]["gender"],$characters[$i]["origin"],
            $characters[$i]["location"],$characters[$i]["image"],$characters[$i]["created"],$characters[$i]["episodes"]);

    }
    return $characters;
}

//NOTE: OPTIONAL FUNCTION
function getSortedLocationsById($locations)
{
    //TODO: Your code here.
    for($i=0;$i<count($locations);$i++){
        for($j=0;$j<count($locations);$j++){

            if($locations[$i]["id"]<$locations[$j]["id"]){

                $aux=$locations[$i];
                $locations[$i]=$locations[$j];
                $locations[$j]=$aux;

            }

        }
    }
    return $locations;
}

//NOTE: OPTIONAL FUNCTION
function getSortedEpisodesById($episodes)
{
    //TODO: Your code here.
    for($i=0;$i<count($episodes);$i++){
        for($j=0;$j<count($episodes);$j++){

            if($episodes[$i]["id"]<$episodes[$j]["id"]){

                $aux=$episodes[$i];
                $episodes[$i]=$episodes[$j];
                $episodes[$j]=$aux;

            }

        }
    }
    return $episodes;
}

function mapCharacters($characters)
{
    //TODO: Your code here.
    global $sortedLocations;
    global $sortedEpisodes;

    // mapping origin
    for($i=0;$i<count($sortedLocations);$i++){
        for($j=0;$j<count($characters);$j++){

            if($characters[$j]["origin"]==$sortedLocations[$i]["id"]){

                $characters[$j]["origin"]=$sortedLocations[$i]["name"];

            }

        }
    }


    //mapping location
    for($i=0;$i<count($sortedLocations);$i++){
        for($j=0;$j<count($characters);$j++){
            if($characters[$j]["location"]==$sortedLocations[$i]["id"]){

                $characters[$j]["location"]=$sortedLocations[$i]["name"];

            }
        }
    }

    // mapping episodes
    for($i=0;$i<count($sortedEpisodes);$i++){//41
        for($j=0;$j<count($characters);$j++){//14
            for($h=0;$h<count($characters[$j]["episodes"]);$h++){//19

                if($sortedEpisodes[$i]["id"] == $characters[$j]["episodes"][$h]){

                    $characters[$j]["episodes"][$h]=$sortedEpisodes[$i]["name"];

                }
            }
        }
    }

    return $characters;

}

function renderCard($character){
    $ch = curl_init('https://dawsonferrer.com/allabres/apis_solutions/rickandmorty/api.php?data=render');
    $data = array("character" => $character);
    $postData = json_encode($data);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
    $result = curl_exec($ch);
    curl_close($ch);
    return $result;
}

//NOTE: $sortingCriteria receive the sorting criteria of the form. Don't edit
$sortingCriteria = "";
if (isset($_GET["sortingCriteria"])) {
    $sortingCriteria = $_GET["sortingCriteria"];
    switch ($sortingCriteria) {
        case "id":
            $characters = getSortedCharactersById($characters);
            break;
        case "origin":
            $characters = getSortedCharactersByOrigin($characters);
            break;
        case "status":
            $characters = getSortedCharactersByStatus($characters);
            break;
    }
}

//NOTE: Save function returns to variables and then you can use it as globals if needed. Don't edit.
$sortedLocations = getSortedLocationsById($locations);
$sortedEpisodes = getSortedEpisodesById($episodes);
$mappedCharacters = mapCharacters($characters);

?>

<html lang="es">
<head>
    <title>RMDB</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
            crossorigin="anonymous"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <form class="d-flex" action="main.php">
                <select class="form-control me-2 form-select" aria-label="Sorting criteria" name="sortingCriteria">
                    <option <?php echo($sortingCriteria == "" ? "selected" : "") ?> value="unsorted">Sorting criteria
                    </option>
                    <option <?php echo($sortingCriteria == "id" ? "selected" : "") ?> value="id">Id</option>
                    <option <?php echo($sortingCriteria == "origin" ? "selected" : "") ?> value="origin">Origin</option>
                    <option <?php echo($sortingCriteria == "status" ? "selected" : "") ?> value="status">Status</option>
                </select>
                <button class="btn btn-outline-success" type="submit">Sort</button>
            </form>
        </div>
    </div>
</nav>
<main role="main">
    <div class="py-5 bg-light">
        <div class="container">

            <div class="row">
                <?php

                /*foreach ($charactersmapp as $i => $key) {
                    render($key);
                }*/

                for($i=0;$i<count($characters);$i++) {
                    /*echo "<div class='col-md-4 col-sm-12 col-xs-12'>";
                        echo "<div class='card mb-4 box-shadow bg-light'>";
                            echo "<img class='card-img-top' src='".$characters[$i]["image"]."'>";
                                echo "<div class='card-body'>";
                                    echo "<h5 class='card-title'>'".$characters[$i]["name"]."'</h5>";
                                        echo "<div class='alert alert-warning' style='padding:0;' role='alert'>";
                                            echo $characters[$i]['status']."-".$characters[$i]['species'];
                                        echo "</div>";
                                        echo "<form>";
                                            echo "<div class='mb-3' style='margin-bottom:0!important;'>";
                                                echo "<label class='form-label' for='exampleInputEmail1' style='margin-bottom: 0;'>";
                                                    echo "<strong>";
                                                        echo "Origin:";
                                                    echo "</strong>";
                                                echo "</label>";
                                                echo "<div id='emailHelp' class='form-text' style='margin-top:0;' >";
                                                    //echo ;
                                                echo "</div>";
                                            echo "</div>";
                                            echo "<div class='mb-3'>";
                                            echo "</div>";
                                        echo "<form>";
                    echo "</div>";
                    echo "</div>";
                    echo "</div>";*/
                    echo "<div class='col-md-4 col-sm-12 col-xs-12'>";
                    echo "<div class='card mb-4 box-shadow bg-light'>";
                    echo "<img class='card-img-top' src=" . $characters[$i]['image'] . "></img>";
                    echo "<div class='card-body'>";
                    echo "<h5 class='card-title'>" . $characters[$i]['name'] . "</h5>";
                    echo "<div class='alert alert-success' style='padding:0;' role='alert'>" . $characters[$i]['status'] . " - " . $characters[$i]['species'] . "</div>";
                    echo "<form>";
                    echo "<div class='mb-3' style='margin-bottom:0!important;'>";
                    echo "<label class='form-label' for='exampleInputEmail1' style='margin-bottom: 0;'>";
                    echo "<strong>Origin</strong>";
                    echo "</label>";
                    echo "<div id='emailHelp' class='form-text' style='margin-top:0;'>";

                    echo $characters[$i]['origin'];

                    echo "</div>";
                    echo "</div>";
                    echo "<label class='form-label' for='exampleInputEmail1' style='margin-bottom: 0;'>";
                    echo "<strong>Last Known Location</strong>";
                    echo "</label>";
                    echo "<div id='emailHelp' class='form-text' style='margin-top:0;'>";
                    echo $characters[$i]['location'];
                    echo "</div>";
                    echo "</form>";
                    echo "</div>";
                    echo "</div>";
                    echo "</div>";
                }

                ?>
            </div>
        </div>
    </div>

</main>
</body>
</html>