This example creates new `Set`s from a string-keyed `Map` and associative array:

```string-keys.php
$fruit_calories = Map {
  'apple' => 95,
  'orange' => 45,
};

$vegetable_calories = darray[
  'cabbage' => 176,
  'potato' => 163,
];

// Create a Set from the keys of a Map
$fruit_names = Set::fromKeysOf($fruit_calories);
\var_dump($fruit_names);

// Create a Set from the keys of an associative array
$vegetable_names = Set::fromKeysOf($vegetable_calories);
\var_dump($vegetable_names);
```

This example creates new `Set`s from an int-keyed `Map` and associative array:

```int-keys.php
$uploaders_by_id = Map {
  4993063 => 'Amy Smith',
  9361760 => 'John Doe',
};

$commenters_by_id = darray[
  7424854 => 'Jane Roe',
  5740542 => 'Joe Bloggs',
];

// Create a Set from the integer keys of a Map
$uploader_ids = Set::fromKeysOf($uploaders_by_id);
\var_dump($uploader_ids); // $uploader_ids contains 4993063, 9361760

// Create a Set from the integer keys of an associative array
$commenter_ids = Set::fromKeysOf($commenters_by_id);
\var_dump($commenter_ids); // $commenter_ids contains 7424854, 5740542
```
