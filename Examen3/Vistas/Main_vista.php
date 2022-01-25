<?php
?>
<!DOCTYPE html>
<html lang="es">
<head>
<title>
    CONQUISTA
</title>
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
    <?php }?>
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
    <tr>
        <?php /** DATOS DEL USUSARIO */ ?>
    </tr>
</table>

</body>
</html>