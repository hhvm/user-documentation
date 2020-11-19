<?hh // partial

namespace Hack\UserDocumentation\API\Examples\Vector\FromKeysOf\Strings;

<<__EntryPoint>>
function string_keys_main(): void {
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
}
