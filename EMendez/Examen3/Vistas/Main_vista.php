<?php
error_reporting(0);

?>
<html lang="en" data-lt-installed="true"><head>
    <meta charset="UTF-8">
    <title>World Game</title>
    <style>
        table, th, td {
            border: 1px solid black;
            border-collapse: collapse;
            padding: 5px;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
<h1>Countries</h1>
<br>
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
    <?php foreach($countriesUsr as $countryUsr){  ?>
        <tr>
            <td><?php echo $countryUsr->getCode() ?></td>
            <td><?php echo $countryUsr->getName() ?></td>
            <td><?php echo $countryUsr->getPopulation() ?></td>
            <td><?php echo $countryUsr->getGNP() ?></td>
            <td><?php $contL=0;
                foreach($countryUsr->getLanguages() as $lenguagesUsr){
                    if($lenguagesUsr==null){
                        $contL=0;
                    }
                    $contL++;
                }
                echo $contL;
                ?></td>
            <td><?php $contC=0;
                foreach($countryUsr->getCities() as $citiesUsr){
                    if($citiesUsr==null){
                        $contC=0;
                    }
                    $contC++;
                }
                echo $contC;
                ?></td>
            <td><?php $owner=$conn->userXcountry($_SESSION["userID"]);
                echo $owner ?></td>
        </tr>
    <?php }  ?>
</table>
<br>
<h2>Other countries</h2>
<br>
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
<?php foreach($countries as $country){
        if($country->getUserId()!=$_SESSION["userID"]){
    ?>
    <tr>
        <td><?php echo $country->getCode() ?></td>
        <td><?php echo $country->getName() ?></td>
        <td><?php echo $country->getPopulation() ?></td>
        <td><?php echo $country->getGNP() ?></td>
        <td><?php $contL=0;
            foreach($country->getLanguages() as $lenguages){
                if($lenguages==null){
                    $contL=0;
                }
                $contL++;
            }
            echo $contL;
            ?></td>
        <td><?php $contC=0;
            foreach($country->getCities() as $cities){
                if($cities==null){
                    $contC=0;
                }
                $contC++;
            }
            echo $contC;
            ?></td>
        <td><?php $owner=$conn->userXcountry($country->getUserId());
            echo $owner ?></td>
        <td><a href="?Ataque=true&Code=<?php echo $country->getCode() ?>">¡ATAQUE!</a></td>
    </tr>
<?php }
}  ?>
</table>

<a href="../Controladores/Logout_controlador.php">Logout</a>

</body></html>