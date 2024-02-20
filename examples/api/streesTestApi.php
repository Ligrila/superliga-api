<?php

for($i=0;$i<1000;$i++){
    var_dump($i);
    $handle = popen('php ./statistics.php >> streessOutput.txt', 'r');

}

