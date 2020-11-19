<?hh

namespace Hack\UserDocumentation\API\Examples\Set\FromKeysOf\Strings;

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

  // Create a Set from the keys of a Map
  $fruit_names = Set::fromKeysOf($fruit_calories);
  \var_dump($fruit_names);

  // Create a Set from the keys of an associative array
  $vegetable_names = Set::fromKeysOf($vegetable_calories);
  \var_dump($vegetable_names);
}
