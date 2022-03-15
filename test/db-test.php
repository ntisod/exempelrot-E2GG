<?php

echo "<table style='border: solid 1px black;'>";
echo "<tr><th>Name</th><th>Score</th><th>Time</th></tr>";

class TableRows extends RecursiveIteratorIterator {
  function __construct($it) {
    parent::__construct($it, self::LEAVES_ONLY);
  }

  function current() {
    return "<td style='width:150px;border:1px solid black;'>" . parent::current(). "</td>";
  }

  function beginChildren() {
    echo "<tr>";
  }

  function endChildren() {
    echo "</tr>" . "\n";
  }
}

require("..\includes\settings.php");

try {
  $conn = new PDO("mysql:host=$servername;dbname=wsp1ex", $username, $password);
  // set the PDO error mode to exception
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  echo "Connected successfully";

  $stmt = $conn->prepare("SELECT name, score, time FROM scores ORDER BY time DESC");
  $stmt->execute();

  // set the resulting array to associative
  $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
  foreach(new TableRows(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
    echo $v;
  }

  //Stäng anslutningen.
  $conn = null;
  
} catch(PDOException $e) {
  echo "Connection failed: " . $e->getMessage();
}

echo "</table>";

?>