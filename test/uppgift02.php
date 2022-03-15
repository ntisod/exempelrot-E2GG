<?php

define("cars", [
    "Alfa Romeo - Ett italienskt märke grundat 1910 mer känt för sin sportbilar.",
    "BMW - Tyskt märke som gör både bilar och motorcyklar. Grundat 1916.",
    "Toyota - Ett märke från Japan som tillverkar diverse fordon. Grundat 1937.",
    "Volvo - Svenskt bilmärke som har gjort diverse bilar men även lastbilar. Grundat 1927.",
    "Ford - Amerikansk biltillverkare grundat 1903. Gör diverse fordon.",
    "Buick - Märke som ägs av General Motors. Mer känt för sina äldre bilar från 1950.",
    "Cadillac - Etablerat 1903. Fokuserar mer på lyxigare bilar.",
    "Chevrolet - Grundat 1911 och har tillverkat diverse fordon."
  ]);
  echo cars[rand(0,7)];

  //Om man bara har php i koden ska man inte stänga php-taggen.