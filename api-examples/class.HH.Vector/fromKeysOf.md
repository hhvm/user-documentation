This example adds `string` keys from a `Map` to a `Vector` as its values:

```string-keys.php
$fruit_calories = Map {
  'apple' => 95,
  'orange' => 45,
};

$vegetable_calories = darray[
  'cabbage' => 176,
  'potato' => 163,
];

// Create a Vector from the keys of a Map
$fruit_names = Vector::fromKeysOf($fruit_calories);
\var_dump($fruit_names);

// Create a Vector from the keys of an associative array
$vegetable_names = Vector::fromKeysOf($vegetable_calories);
\var_dump($vegetable_names);
```

This example creates new `Vector`s from an int-keyed `Map` and an associative array:

```int-keys.php
$uploaders_by_id = Map {
  4993063 => 'Amy Smith',
  9361760 => 'John Doe',
};

$commenters_by_id = darray[
  7424854 => 'Jane Roe',
  5740542 => 'Joe Bloggs',
];

// Create a Vector from the integer keys of a Map
$uploader_ids = Vector::fromKeysOf($uploaders_by_id);
\var_dump($uploader_ids); // $uploader_ids contains 4993063, 9361760

// Create a Vector from the integer keys of an associative array
$commenter_ids = Vector::fromKeysOf($commenters_by_id);
\var_dump($commenter_ids); // $commenter_ids contains 7424854, 5740542
```
