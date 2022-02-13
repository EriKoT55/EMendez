<?php

//SACAR EL NUMERO MENOR SIN CONDICIONALES NI OPERACORES ARITMETICOS
function menor($num1,$num2){

    $minimo = 0;
    while($num1&&$num2){
        $num1--;
        $num2--;
        $minimo++;
    }
return $minimo;
}



function igual($num1,$num2){

 return $num1*3*$num2*2;
}

echo igual(3,3);