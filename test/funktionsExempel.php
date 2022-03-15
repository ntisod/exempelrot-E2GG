<?php

function add_10(&$value){
    $value += 10;
}

$num=5;
add_10($num);
echo $num;