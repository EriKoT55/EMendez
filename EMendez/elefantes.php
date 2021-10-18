<?php
//Obtenemos el contenido de la pagina web.
$contents = file_get_contents("https://dawsonferrer.com/allabres/apis_solutions/elephants.php");
//Descifra como si fuera un array.
$elephants = json_decode($contents, true);

function getSortedElephantsByNumber($elephants){
    //TODO: Return an array of elephants sorted by it's number (ascending order).
    //NOTES 1: You receive a elephants multidimensional array, you can view it's content with var_dump() function.
    //NOTES 2:You CAN'T use any sorting PHP built-in function.
    for ($i = 0; $i < count($elephants); $i++) {
        for ($j = 0; $j < count($elephants); $j++) {

            if ($elephants[$i]['number'] < $elephants[$j]['number']) {
                $aux = $elephants[$i];
                $elephants[$i] = $elephants[$j];
                $elephants[$j] = $aux;
            }
        }

    }
    return $elephants;

}
?>

<html lang="es">
<head>
    <title>Elephants</title>
    <style>
        table,td,th{
            border: 2px solid saddlebrown;
            padding-left: 5px;
            padding-right: 5px;
            padding-bottom: 2px;
            padding-top: 2px;
        }

        table {
            border-collapse: collapse;
        }
        thead {
            background-color: darkorange;
            color:black;
        }
        tbody {
            background-color: black;
            color:white;
        }
    </style>
</head>
<body>
<table>
    <thead>
    <tr>
        <th colspan="6">Elephants (

            <?php ////TODO: Logic to print the number of elephants.

                echo count($elephants);

             ?>)

        </th>
    </tr>
    <tr>
        <th colspan="3">Unsorted elephants</th>
        <th colspan="3">Sorted elephants</th>
    </tr>
    <tr>
        <th>Number</th>
        <th>Name</th>
        <th>Species</th>
        <th>Number</th>
        <th>Name</th>
        <th>Species</th>
    </tr>
    </thead>
    <tbody>
    <?php
    //TODO: Logic to print the table body.

    $arrayOrdenado=getSortedElephantsByNumber($elephants);
        for($i=0;$i<count($elephants);$i++){
            echo '<tr>';

                echo '<td>';
                echo $elephants[$i]['number'];
                echo '</td>';

                echo '<td>';
                echo $elephants[$i]['name'];
                echo '</td>';

                echo '<td>';
                echo $elephants[$i]['species'];
                echo '</td>';



                echo '<td>';
                echo $arrayOrdenado[$i]['number'];
                echo '</td>';

                echo '<td>';
                echo $arrayOrdenado[$i]['name'];
                echo '</td>';

                echo '<td>';
                echo $arrayOrdenado[$i]['species'];
                echo '</td>';



            echo '</tr>';


        }

    ?>
    </tbody>
</table>
</body>
</html>