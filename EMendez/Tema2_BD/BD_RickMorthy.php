<?php

$seed = 3702; //TODO: LAST 4 NUMBERS OF YOUR DNI.
$api_url = "https://dawsonferrer.com/allabres/apis_solutions/rickandmorty/api.php?seed=" . $seed . "&data=";

$characters = json_decode(file_get_contents($api_url . "characters"), true);
$episodes = json_decode(file_get_contents($api_url . "episodes"), true);
$locations = json_decode(file_get_contents($api_url . "locations"), true);


/*
echo "<br>";
echo"<pre>";
var_dump($locations);
echo "</pre>";
*/


//Crear base de datos rick and morthy, añadir tablas e introducir datos en ellas.

$servername = "localhost";
$username = "root"; //casa erikPhp //clase root
$password = "Ageofempires2*";
$database = "RickMorthy";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Conexion fallida: " . $conn->connect_error);
}

/*$sql= "CREATE DATABASE RickMorthy";*/

//Fallo al referenciar la tabla, ya que no existe, pero debo crear una antes
//para que funcione debere crear una tabla sin FK y despues con un alter table
// introducir la FK

/*$sql = "CREATE TABLE Characters(
    id INT(10) PRIMARY KEY,
    name VARCHAR(50) NOT NULL,
    status VARCHAR(50),
    species VARCHAR(20) NOT NULL,
    type VARCHAR(25),
    gender VARCHAR(25),
    origin INT(5),
    location INT(5),
    image VARCHAR(100),
    created VARCHAR(50)
    
)";*/

//Esto lo pense yo, no funciona    //Introduccion de FK a episodes y despues hice de location
//$sql="ALTER TABLE Characters ADD FOREIGN KEY(episodes) REFERENCES Episodes(id)";
//$sql = "ALTER TABLE Characters ADD FOREIGN KEY(location) REFERENCES Locations(id)";


/*$sql = "CREATE TABLE Episodes(
        id INT(5) NOT NULL PRIMARY KEY,
        name VARCHAR(100) NOT NULL,
        air_date VARCHAR(25),
        episode VARCHAR(15) NOT NULL,
        created VARCHAR(50) NOT NULL

    )";*/

/*$sql= "CREATE TABLE EpsChars(
        id INT(5) PRIMARY KEY,
        idChars  INT(10),
        idEps INT(10),
        FOREIGN KEY(idChars) references Characters(id),
        FOREIGN KEY(idEps) references Episodes(id)
)";*/

/*$sql="CREATE TABLE Locations(
    id INT(5) PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    type VARCHAR(50),
    dimension VARCHAR(50),
    created VARCHAR(50)
                     )";*/

/*$sql="CREATE TABLE LocsChars(
    idLocs INT(10),
    idChars INT(10),
    PRIMARY KEY(idLocs,idChars),
    FOREIGN KEY(idLocs) references Locations(id),
    FOREIGN KEY(idChars) references Characters(id)
)";*/

//Insertar datos en Characters
/*for ($i = 0; $i < count($characters); $i++) {

    $name = $characters[$i]["name"];
    $name = $conn->real_escape_string($name);

    $sql = "INSERT INTO Characters(id,name,status,species,type,gender,origin,location,image,created)
       values('" . $characters[$i]["id"] . "','" . $name . "','" . $characters[$i]["status"] . "','" . $characters[$i]["species"] . "','" . $characters[$i]["type"] . "','" . $characters[$i]["gender"] . "','" . $characters[$i]["origin"] . "','" . $characters[$i]["location"] . "','" . $characters[$i]["image"] . "','" . $characters[$i]["created"] . "')  ";

    if ($conn->multi_query($sql) === TRUE) {
        echo "Se realizo correctamente";
    } else {
        echo "Error: " . $conn->error;
    }

}*/

//Insertar datos en episode
/*for($i=0;$i<count($episodes);$i++){

    $name= $episodes[$i]["name"];
    $name= $conn->real_escape_string($name);

    $sql="INSERT INTO Episodes(id,name,air_date,episode,created)
            VALUES ('".$episodes[$i]["id"]."','".$name."','".$episodes[$i]["air_date"]."','".$episodes[$i]["episode"]."','".$episodes[$i]["created"]."')";

    if ($conn->query($sql) === TRUE) {
        echo "Se realizo correctamente";
    } else {
        echo "Error: " . $conn->error;
    }

}*/

//Insertar datos en EpsChars
/*$contador=0;
for($i=0;$i<count($characters);$i++){

    for($j=0;$j<count($characters[$i]["episodes"]);$j++){
        $contador++;
        $sql="INSERT INTO EpsChars(id,idChars,idEps)
            VALUES('".($contador+1)."','".$characters[$i]["id"]."','".$characters[$i]["episodes"][$j]."')";

        if ($conn->query($sql) === TRUE) {
            echo "Se realizo correctamente";
        } else {
            echo "Error: " . $conn->error;
        }
    }
}*/

//Insertar datos en Locations

/*for($i=0;$i<count($locations);$i++){

    $name=$locations[$i]["name"];
    $name=$conn->real_escape_string($name);

    $sql="INSERT INTO Locations(id,name,type,dimension,created)
          VALUES('".$locations[$i]["id"]."','".$name."','".$locations[$i]["type"]."','".$locations[$i]["dimension"]."','".$locations[$i]["created"]."')";

    if ($conn->query($sql) === TRUE) {
        echo "Se realizo correctamente";
    } else {
        echo "Error: " . $conn->error;
    }

}*/


/*$sql="DELETE FROM EpsChars";
if ($conn->multi_query($sql) === TRUE) {
    echo "Se realizo correctamente";
} else {
    echo "Error: " . $conn->error;
}*/

$conn->close();
?>