<?php

$namn=filter_input(INPUT_GET, 'namn');

$t = date("H");

if ($t < "10") {
  echo "God morgon, $namn!";
} 
elseif ($t < "12") {
  echo "God förmiddag, $namn!";
} 
elseif ($t = "12") {
echo "God dag, $namn!";
}
elseif ($t < "18") {
  echo "God eftermiddag, $namn!";
} 
elseif ($t < "21") {
    echo "God kväll, $namn!";
} 
else {
    echo "God natt, $namn!";
}

?>