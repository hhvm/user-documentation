```basic-usage.php
<<__EntryPoint>>
async function basic_usage_main(): Awaitable<void> {
  // Return all non-negative odd numbers
  // Positive evens filtered out,
  // Negatives and zero cause exception
  $odds = await \HH\Asio\mfw(
    Map {
      '-one' => -1,
      'zero' => 0,
      'one' => 1,
      'two' => 2,
      'three' => 3,
      'four' => 4,
    },

    async ($val) ==> {
      if ($val <= 0) {
        throw new \Exception("$val is non-positive");
      } else {
        return ($val % 2) == 1;
      }
    },
  );

  foreach ($odds as $num => $result) {
    if ($result->isSucceeded()) {
      echo "$num Success: ";
      \var_dump($result->getResult());
    } else {
      echo "$num Failed: ";
      \var_dump($result->getException()->getMessage());
    }
  }
}
```
