<?php
?>

<html lang="en"><head>
    <meta charset="UTF-8">
    <title>Sakila</title>
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
<h1>Sakila</h1>
<br>
<h2>My rented films</h2>
<table>
    <tbody><tr>
        <th>Id</th>
        <th>Title</th>
        <th>Description</th>
        <th>Release year</th>
        <th>Language</th>
        <th>Length</th>
        <th>Rating</th>
        <th>Actors</th>
        <th>Categories</th>
        <th>Return</th>
    </tr>
    <?php foreach ($objArrFilmsUsr as $filmsUsr){?>
    <tr>
        <td><?php echo $filmsUsr->getFilmId()?></td>
        <td><?php echo $filmsUsr->getTitle()?></td>
        <td><?php echo $filmsUsr->getDescription()?></td>
        <td><?php echo $filmsUsr->getReleaseYear()?></td>
        <td><?php echo $filmsUsr->getLanguage()?></td>
        <td><?php echo $filmsUsr->getLength()?></td>
        <td><?php echo $filmsUsr->getRating()?></td>
        <td><?php foreach ($filmsUsr->getAcotores() as $actores){
                echo $actores["actores"];
            }?></td>
        <td><?php foreach ($filmsUsr->getCategory() as $category){
                echo $category["category"];
            } ?></td>
        <td><a href="?devolver=true&filmID= <?php echo $filmsUsr->getFilmId() ?>">Return</a></td>
    </tr>
    <?php } ?>
    </tbody>
</table>
<br>
<h2>Other films</h2>
<table>
    <tbody><tr>
        <th>Id</th>
        <th>Title</th>
        <th>Description</th>
        <th>Release year</th>
        <th>Language</th>
        <th>Length</th>
        <th>Rating</th>
        <th>Actors</th>
        <th>Categories</th>
        <th>Rent</th>
    </tr>
    <?php foreach ($objArrFilms as $films){
        if($films->getUserId() != $_SESSION["userID"]){
        ?>
    <tr>
        <td><?php echo $films->getFilmId()?></td>
        <td><?php echo $films->getTitle()?></td>
        <td><?php echo $films->getDescription()?></td>
        <td><?php echo $films->getReleaseYear()?></td>
        <td><?php echo $films->getLanguage()?></td>
        <td><?php echo $films->getLength()?></td>
        <td><?php echo $films->getRating()?></td>
        <td><?php foreach ($films->getAcotores() as $actores){
                echo $actores["actores"];
            }?></td>
        <td><?php foreach ($films->getCategory() as $category){
                echo $category["category"];
            } ?></td>
        <td><a href="?reserv=true&filmID=<?php echo $films->getFilmId() ?>">Reserva</a></td>
    </tr>
    <?php }
    }?>
    </tbody></table>
<span><a href="../Controladores/Logout_controlador.php">Logout</a></span>

</body></html>