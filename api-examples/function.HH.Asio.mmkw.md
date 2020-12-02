```basic-usage.php
<<__EntryPoint>>
async function basic_usage_main(): Awaitable<void> {
  // Map a vector of numbers to their value divided by their index
  // throwing on division by zero.
  $quotients = await \HH\Asio\mmkw(
    Map {
      1 => 1,
      0 => 2,
      2 => 6,
      3 => 12,
    },

    async ($div, $val) ==> {
      if ($div != 0) {
        return $val / $div;
      } else {
        throw new \Exception(
          "Division by zero: ".\print_r($val, true).'/'.\print_r($div, true),
        );
      }
    },
  );

  foreach ($quotients as $result) {
    if ($result->isSucceeded()) {
      echo " Success: ";
      \var_dump($result->getResult());
    } else {
      echo "Failed: ";
      \var_dump($result->getException()->getMessage());
    }
  }
}
```
