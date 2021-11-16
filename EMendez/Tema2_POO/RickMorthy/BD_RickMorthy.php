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

$servername= "localhost";
$username="root"; //casa erikPhp //clase root
$password="Ageofempires2*";
$database="RickMorthy";

$conn = new mysqli($servername,$username,$password,$database);

if($conn->connect_error){
    die("Conexion fallida: ". $conn->connect_error);
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

    //Introduccion de FK a episodes y despues hice de location

//$sql="ALTER TABLE Characters ADD FOREIGN KEY(episodes) REFERENCES Episodes(id)";
//$sql = "ALTER TABLE Characters ADD FOREIGN KEY(location) REFERENCES Locations(id)";


/*$sql = "CREATE TABLE Episodes(
        id INT(5) NOT NULL PRIMARY KEY,
        name VARCHAR(100) NOT NULL,
        episode VARCHAR(15) NOT NULL,
        created VARCHAR(50) NOT NULL,
        characters INT(5)
        //FOREIGN KEY(characters) references Characters(id)
    )";*/


/*$sql= "CREATE TABLE EpsChars(
        idEps INT(10),
        idChars INT(10),
        PRIMARY KEY(idChars,idEps),
        FOREIGN KEY(idEps) references Episodes(id),
        FOREIGN KEY(idChars) references Characters(id)
)";*/

/*$sql="CREATE TABLE Locations(
    id INT(5) PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    type VARCHAR(20),
    dimension VARCHAR(50),
    created VARCHAR(50),
    residents int(5)
                     )";*/

/*$sql="CREATE TABLE LocsChars(
    idLocs INT(10),
    idChars INT(10),
    PRIMARY KEY(idLocs,idChars),
    FOREIGN KEY(idLocs) references Locations(id),
    FOREIGN KEY(idChars) references Characters(id)
)";*/

/*$sql="";

for($i=0;$i<count($characters);$i++){

    $name=[];
    $name[$i]=$conn->real_escape_string($name[$i]);

    $created=[];
    $created[$i]=$conn->real_escape_string($created[$i]);

    $sql.="INSERT INTO Characters(id,name,status,species,type,gender,origin,location,image,created) VALUES(";
    $sql.="'".$characters[$i]["id"]."'".","."'".$name[$i]."'".","."'".$characters[$i]["status"]."'".","."'".$characters[$i]["species"]."'".","."'".$characters[$i]["type"]."'".","."'".$characters[$i]["gender"]."'".",".$characters[$i]["origin"].",".$characters[$i]["location"].","."'".$characters[$i]["image"]."'".","."'".$created[$i]."'";
    $sql.=");";

    if($conn->query($sql) === TRUE){
        echo "bn";
    }else{
        echo "Error: "."$sql".$conn->error;
    }

}*/

/*$sql="DELETE FROM Characters ";

if($conn->multi_query($sql) === TRUE){
    echo "bn";
}else{
    echo "Error: ".$conn->error;
}*/

$conn->close();
?>