<?php

/*Crear una nueva conexion en MYSQL, CASA*/
$servername="sql480.main-hosting.eu";//sql480.main-hosting.eu
$username="u850300514_emendez"; //u850300514_emendez //casa erikPhp // clase root
$password="x43233702G";//x43233702G
$database="u850300514_emendez";//RickMorthy_u850300514_emendez

//Creo la conexion
$conn = new mysqli($servername,$username,$password,$database);

// Me aseguro de si va bien la conexion
if($conn->connect_error){
    die("Conexion fallida: ". $conn->connect_error);
}





    $sql = "INSERT INTO Peliculas (ID,Nombre,IMG,Trailer,Duracion,Fecha_Salida,Calificacion,Sinopsis)
values(1,'Sin tiempo para morir','https://pics.filmaffinity.com/no_time_to_die-525355918-large.jpg','https://www.youtube.com/watch?v=c933JBJhKZE',163,'2021-04-02',7.4,'Una joven Madeleine Swann es testigo del asesinato de su madre por Lyutsifer Safin en un intento fallido de asesinar a su padre, el Sr. White. Madeleine dispara a Safin mientras la busca, pero sobrevive. Madeleine huye a un lago congelado cercano y cae a través del hielo, pero Safin la rescata.
Después de la captura de Ernst Stavro Blofeld, Madeleine está en Matera con James Bond. Los asesinos de Spectre emboscan a Bond cuando visita la tumba de Vesper Lynd. Aunque Bond y Madeleine superan a los asesinos, Bond cree que Madeleine lo ha traicionado a pesar de sus súplicas y la abandona.
Cinco años después, el científico del MI6, Valdo Obruchev, es secuestrado en un laboratorio del MI6. Aprobado por M, Obruchev ha desarrollado el <Proyecto Heracles>, un arma biológica que contiene nanobots que infectan como un virus al tacto y están codificados en el ADN específico de un individuo, haciéndolo letal para el objetivo pero inofensivo para otros. Bond se ha retirado a Jamaica, donde es contactado por el agente de la CIA Felix Leiter con su colega Logan Ash. Leiter pide ayuda para localizar a Obruchev, pero Bond se niega. La misma noche, Bond se encuentra con un agente del MI6 llamado Nomi que lo ha sucedido como el nuevo 007. Al ser informado por Nomi sobre el Proyecto Heracles, Bond posteriormente acepta ayudar a Leiter.
Bond va a Cuba y se encuentra con una agente de la CIA llamada Paloma que está aliada con Leiter. Bond y Paloma se infiltran en una reunión de Spectre para el cumpleaños de Blofeld para recuperar a Obruchev. Blofeld, que está usando un <ojo biónico> incorpóreo para dirigir la reunión mientras aún está encarcelado en el MI6, ordena a sus miembros que maten a Bond con los nanobots. En cambio, los nanobots matan a todos los miembros de Spectre, ya que Obruchev los había reprogramado para hacerlo por orden de Safin. Bond captura a Obruchev antes de conocer a Leiter y Ash. Sin embargo, se revela que Ash es un agente doble que trabaja para Safin mientras mata a Leiter y escapa con Obruchev.
Moneypenny y Q organizan una reunión entre Bond y Blofeld en prisión para tratar de localizar a Obruchev. Sin embargo, Safin visita y obliga a Madeleine a infectarse con nanobots para matar a Blofeld, ya que ha estado en contacto con él desde su encarcelamiento. Cuando Bond se encuentra con Madeleine en la celda de la prisión de Blofeld, la toca y, sin saberlo, se infecta antes de que ella se vaya. Durante el interrogatorio, Blofeld le confiesa a Bond que organizó la emboscada en la tumba de Vesper para parecer como si Madeline lo hubiera traicionado. Bond reacciona atacando a Blofeld, provocando involuntariamente que los nanobots lo infecten y lo maten.
Bond rastrea a Madeleine hasta la casa de su infancia en Noruega. Allí se entera de que Madeleine tiene una hija de cinco años llamada Mathilde, que, según ella, no es suya. Madeleine le confiesa a Bond que los padres de Safin fueron asesinados por el padre de Madeleine por orden de Blofeld cuando Safin era un niño, lo que lo llevó a buscar venganza contra Blofeld y Spectre. A pesar de haber logrado matar a Blofeld y destruir a Spectre, Safin continúa su alboroto mientras él, Ash y sus hombres se dirigen a capturar a Bond, Madeleine y Mathilde. Aunque Bond logra matar a Ash y a varios de los hombres de Safin, Safin captura con éxito a Madeleine y Mathilde.
Q, Bond y Nomi localizan a Safin en una base de la Segunda Guerra Mundial en una isla entre Japón y Rusia. Se infiltran en la sede de Safin y se enteran de que Safin ha convertido la base en una fábrica de nanobots, donde hace que Obruchev cree millones de nanobots para que pueda liberarlos a nivel mundial para matar a millones de personas y establecer un nuevo orden mundial para él. Bond mata a muchos de los hombres de Safin, mientras que Nomi mata a Obruchev empujándolo a una tina de nanobots. Después de rescatar a Madeleine y Mathilde, Bond hace que escapen con Nomi de la isla mientras él se queda atrás para abrir las puertas del silo de la isla, lo que permitiría un ataque con misiles del HMS Dragon para destruir a los nanobots.
Bond mata a los hombres restantes de Safin antes de enfrentarse al mismo Safin; luchan y Safin dispara a Bond antes de infectarlo con nanobots programados para matar a Madeleine y Mathilde. A pesar de sus heridas, Bond mata a Safin y abre los silos. Hablando por radio con Madeleine, Bond le dice que la ama y la anima a seguir adelante sin él, y ella confirma que Mathilde es su hija cuando Bond se despide. Bond acepta su destino cuando los misiles golpean la isla y destruyen la fábrica de nanobots.
En el MI6, M, Moneypenny, Q, Tanner y Nomi beben en honor a Bond. La película termina con Madeleine llevando a Mathilde a Matera cuando comienza a contarle sobre Bond.');";

    if ($conn->multi_query($sql) === TRUE) {
        echo "Se realizo correctamente";
    } else {
        echo "Error: " . $conn->error;
    }


?>