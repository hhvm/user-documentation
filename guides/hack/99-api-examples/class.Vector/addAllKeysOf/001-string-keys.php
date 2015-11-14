<?hh

$fruit_calories = Map {
  'apple' => 95,
  'orange' => 45,
};

$vegetable_calories = array(
  'cabbage' => 176,
  'potato' => 163,
);

$food_names = Vector {};

// Add the keys from a Map
$food_names->addAllKeysOf($fruit_calories);

// Add the keys from an associative array
$food_names->addAllKeysOf($vegetable_calories);

// Vector contains 'apple', 'orange', 'cabbage', 'potato'
var_dump($food_names);
