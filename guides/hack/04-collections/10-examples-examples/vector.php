<?hh

namespace Hack\UserDocumentation\Collections\Examples\Examples\Vec;

function use_vector(): void {
  $fruit_basket = Vector {'Banana', 'Apple'}; // initialize
  $fruit_basket[] = 'Orange'; // Add to the next available index, which is 2
  $fruit_basket[] = 'Banana'; // You can have duplicates
  var_dump($fruit_basket);
  try {
    // Can't use an explicit index that doesn't exist, even if it would be the
    // next available index.
    $fruit_basket[4] = 'Plum';
  } catch (\OutOfBoundsException $ex) {
    var_dump($ex->getMessage());
  }
  // Query the fruit at index 1
  var_dump($fruit_basket[1]);
  // Iterate over the entire fruit basket using foreach
  foreach ($fruit_basket as $fruit) {
    // This should only be a query. Do not add or remove from a Vector while
    // in a foreach
    var_dump($fruit);
  }
  // Iterate over some of the fruit basket using for and ints
  for ($i = 0; $i < $fruit_basket->count() - 2; $i++) {
    if ($i % 2 === 0) {
      // We can change the vector in a for loop by index
      $fruit_basket[$i] = 'Grape';
    }
  }
  var_dump($fruit_basket);
  // Remove an item
  $fruit_basket->removeKey(0);
  var_dump($fruit_basket);
}

use_vector();
