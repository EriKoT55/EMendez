<?php
//Crear base de datos rick and morthy, añadir tablas e introducir datos en ellas.

$servername= "localhost";
$username="root";
$password="Ageofempires2*";
$database="RickMorthy";

$conn = new mysqli($servername,$username,$password,$database);

if($conn->connect_error){
    die("Conexion fallida: ". $conn->connect_error);
}

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
    created VARCHAR(50),
    episodes INT(5)
    
)";*/

    //Introduccion de FK a episodes
$sql = "ALTER TABLE Characters ADD FOREIGN KEY(location) REFERENCES Locations(id)";

/*$sql = "CREATE TABLE Episodes(
        id INT(5) NOT NULL PRIMARY KEY,
        name VARCHAR(100) NOT NULL,
        episode VARCHAR(15) NOT NULL,
        created VARCHAR(50) NOT NULL,
        characters INT(5),
        FOREIGN KEY(characters) references Characters(id)
    )";*/

/*$sql="CREATE TABLE Locations(
    id INT(5) PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    type VARCHAR(20),
    dimension VARCHAR(50),
    created VARCHAR(50),
    residents int(5),
    FOREIGN KEY(residents) references Characters(id)
                     )";*/

if($conn->query($sql) === TRUE){
    echo "Tabla creada en la BD satisfactoriamente";
}else{
    echo "Error al crear la Tabla: ". $conn->error;
}

$conn->close();
?>