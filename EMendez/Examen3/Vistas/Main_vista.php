<?php
error_reporting(0);
?>
<!DOCTYPE html>
<html lang="es">
<head>
<title>
    CONQUISTA
</title>
    <style>
        table,tr,td,th{
            border-collapse: collapse;
            border:1px solid black;
        }
    </style>
</head>
<body>
<h1>Countries</h1>

<h2>My countries</h2>
<table>
    <tr>
        <th>Code</th>
        <th>Name</th>
        <th>Population</th>
        <th>GNP</th>
        <th>NumLanguages</th>
        <th>NumCities</th>
        <th>Owner</th>
    </tr>
    <tr>
    <?php foreach ($countryObjArr as $country) {?>
        <td><?php echo $country->getCode(); ?></td>
        <td><?php echo $country->getName(); ?></td>
        <td><?php echo $country->getPopulation(); ?></td>
        <td><?php echo $country->getGNP(); ?></td>
        <td><?php
            $contadorL=0;
            foreach ( $country->getLenguage() as $lenguage){
                $contadorL++;
                if($lenguage["lenguage"]==null){
                    $contadorL=0;
                }
            }
            echo $contadorL;
            ?>
        </td>
        <td><?php
            $contadorC=0;
            foreach ( $country->getCities() as $cities){
                $contadorC++;
                //$cities["nameCities"];
                if($cities["nameCities"]==null){
                    $contadorC=0;
                }
            }
            echo $contadorC;
            ?>
        </td>
    <?php }?>
        <td> <?php echo $_SESSION["user"] ?></td>
    </tr>
</table>

<h2>Other Countries</h2>
<table>
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
    <?php foreach ($countriesObjArr as $countries){?>
    <tr>
        <td><?php echo $countries->getCode(); ?></td>
        <td><?php echo $countries->getName(); ?></td>
        <td><?php echo $countries->getPopulation(); ?></td>
        <td><?php echo $countries->getGNP(); ?></td>
        <td><?php
            $contadorL=0;
            foreach ( $countries->getLenguage() as $lenguage){
                $contadorL++;
                if($lenguage["lenguage"]==null){
                    $contadorL=0;
                }
                //$lenguage["lenguage"];
            }
            echo $contadorL;
            ?>
        </td>
        <td><?php
            $contadorC=0;
            foreach ( $countries->getCities() as $cities){
                $contadorC++;
                if($cities["nameCities"]==null){
                    $contadorC=0;
                }
            }
            echo $contadorC;
            ?>
        </td>
        <td><?php
            $user=$conn->getUserT($countries->getUserid());
            foreach($user as $usr ){
               echo $usr->getMail();
            } ?></td>
        <td><a href="">¡Ataque!</a></td>
    </tr>
    <?php }?>
</table>

</body>
</html>