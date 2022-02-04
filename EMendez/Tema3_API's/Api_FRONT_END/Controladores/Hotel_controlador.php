<?php

$api="http://localhost/EMendez/Tema3_API's/Api_BACK_END/Controladores/Hotel_controlador.php";
$hotelApi=json_decode(file_get_contents($api),true);

var_dump($hotelApi);

?>