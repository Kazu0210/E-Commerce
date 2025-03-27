<?php
for ($i=0; $i < 6; $i++) {
    $randomNum = random_int(0, 9);
    echo $randomNum;
    $randomNum .= $randomNum; // append to the string
}

?>