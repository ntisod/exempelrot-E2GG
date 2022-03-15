<?php

$hs = array("Ben" => "3728", "Hue" => "8643", "Joe" => "4572", "RRRRRRR" => "9999", "\|¤_¤|/" => "5837");

arsort($hs);

foreach($hs as $x => $x_value) {
    echo $x, "   ---   ", $x_value;
    echo "<br>";
  }

echo "<ol>";
foreach($hs as $x => $x_value) {
    echo "<li>", $x, "   ---   ", $x_value, "</li>";
    echo "<br>";
}
echo "</ol>";
