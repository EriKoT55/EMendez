<?php
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        table, td, th {
            border: 1px solid black;
            border-collapse: collapse;
            text-align: center;
        }
    </style>
</head>
<body>
<h1>Countries</h1>

<h2>My countries</h2>
<table>
    <tbody>
    <tr>
        <th>Code</th>
        <th>Name</th>
        <th>Population</th>
        <th>GNP</th>
        <th>NumLanguages</th>
        <th>NumCities</th>
        <th>Owner</th>
    </tr>
    </tbody>

    <?php
    foreach( $objArrCountriesUsr as $countriesUsr ){ ?>

    <tr>
        <td> <?php
            echo $countriesUsr->Code ?>
        </td>
        <td> <?php
            echo $countriesUsr->Name ?></td>
        <td> <?php
            echo $countriesUsr->Population ?></td>
        <td> <?php
            echo $countriesUsr->GNP ?></td>
        <td> <?php
            $numLanguages = 0;
            foreach( $countriesUsr->Lenguage as $language ) {

                $numLanguages++;

            }
            echo $numLanguages;
            ?></td>
        <td> <?php

            $numCities = 0;
            foreach( $countriesUsr->CityName as $cities ) {

                $numCities++;

            }
            echo $numCities;

            ?></td>
        <td> <?php

            echo $_SESSION["mail"];

            ?></td>
    </tr>
   <?php }
    ?>

</table>

<h2>Other countries</h2>

<table>
    <tbody>
    <tr>
        <th>Code</th>
        <th>Name</th>
        <th>Population</th>
        <th>GNP</th>
        <th>NumLanguages</th>
        <th>NumCities</th>
        <th>Owner</th>
        <th>Action</th>
    </tr>
    <?php
    foreach( $objArrCountries as $countries ) {
        if( $countries->UserId!=$_SESSION["userID"] ) {
            ?>
            <tr>
                <td> <?php
                    echo $countries->Code ?></td>
                <td> <?php
                    echo $countries->Name ?></td>
                <td> <?php
                    echo $countries->Population ?></td>
                <td> <?php
                    echo $countries->GNP ?></td>
                <td> <?php
                    $numLanguages = 0;
                    foreach( $countries->Lenguage as $language ) {

                        $numLanguages++;

                    }
                    echo $numLanguages;
                    ?></td>
                <td> <?php

                    $numCities = 0;
                    foreach( $countries->CityName as $cities ) {

                        $numCities++;

                    }
                    echo $numCities;

                    ?></td>
                <td> <?php
                        foreach($countries->Owner as $owners){

                            echo $owners->Owner;

                        }
                    ?></td>
                <td><a href="?action=true&Code=<?php
                    echo $countries->Code ?>">ATTACK</a></td>
            </tr>
            <?php
        }
    } ?>
    </tbody>
</table>

</body>
</html>