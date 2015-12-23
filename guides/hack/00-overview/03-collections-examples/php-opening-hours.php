<?php

namespace Hack\UserDocumentation\Overview\Collections\Examples\PHPOpeningHours;

function getOpeningHours($x) {
  $opening_hours = array(
    "9-5",
    "9-5",
    "9-9",
    "9-9",
    "9-9",
    "9-6",
    "12-5",
  );
  return $opening_hours[$x]; 
}

echo getOpeningHours(3);
