<?hh // partial

namespace Hack\UserDocumentation\API\Examples\Set\AddAllKeysOf\Strings;

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

  $food_names = Set {};

  // Add the keys from a Map
  $food_names->addAllKeysOf($fruit_calories);

  // Add the keys from an associative array
  $food_names->addAllKeysOf($vegetable_calories);

  \var_dump($food_names);
}
