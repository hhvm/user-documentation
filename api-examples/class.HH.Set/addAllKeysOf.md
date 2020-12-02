This example adds `string` keys from a `Map` to a `Set` as its values:

```string-keys.php
$fruit_calories = Map {
  'apple' => 95,
  'orange' => 45,
};

$vegetable_calories = darray[
  'cabbage' => 176,
  'potato' => 163,
];

$food_names = Set {};

// Add the keys from a Map
$food_names->addAllKeysOf($fruit_calories);

// Add the keys from an associative array
$food_names->addAllKeysOf($vegetable_calories);

\var_dump($food_names);
```

This example adds `int` keys from a `Map` to a `Set` as its values:

```int-keys.php
$uploaders_by_id = Map {
  4993063 => 'Amy Smith',
  9361760 => 'John Doe',
};

$commenters_by_id = darray[
  4993063 => 'Amy Smith',
  7424854 => 'Jane Roe',
  5740542 => 'Joe Bloggs',
];

$all_ids = Set {};

// Add the keys from a Map
$all_ids->addAllKeysOf($uploaders_by_id);

// Add the keys from an associative array
$all_ids->addAllKeysOf($commenters_by_id);

\var_dump($all_ids);
```
