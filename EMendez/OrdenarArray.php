<?php

    $nums=[7,5,3,9,1,0,8,6,2];

    for($i=0;$i<count($nums);$i++){

      for($j=0;$j<count($nums);$j++){
          if($nums[$i]<$nums[$j]){
              $aux=$nums[$i];
              $nums[$i]=$nums[$j];
              $nums[$j]=$aux;
          }

      }
        var_dump($nums);
    }


?>