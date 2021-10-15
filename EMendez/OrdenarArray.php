<?php

    $nums=[
        $a=['7','augusto'],
        $b=['5','augusto'],
        $l=['12','augusto'],
        $c=['3','augusto'],
        $d=['9','augusto'],
        $m=['13','augusto'],
        $e=['1','augusto'],
        $f=['0','augusto'],
        $k=['11','augusto'],
        $g=['8','augusto'],
        $n=['14','augusto'],
        $h=['6','augusto'],
        $i=['2','augusto'],
        $j=['10','augusto']

    ];

    for($i=0;$i<count($nums);$i++){

      for($j=0;$j<count($nums);$j++){
          if($nums[$i]<$nums[$j]){
              $aux=$nums[$i];
              $nums[$i]=$nums[$j];
              $nums[$j]=$aux;
          }

      }

    }

    foreach (){

    }

?>