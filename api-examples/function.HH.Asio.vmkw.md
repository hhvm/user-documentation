```basic-usage.php
<<__EntryPoint>>
async function basic_usage_main(): Awaitable<void> {
  // Map a vector of numbers to their value divided by their index
  // throwing on division by zero.
  $quotients = await \HH\Asio\vmkw(
    Vector {1, 2, 6, 12},

    async ($idx, $val) ==> {
      if ($idx != 0) {
        return $val / $idx;
      } else {
        throw new \Exception(
          "Division by zero: ".\print_r($val, true).'/'.\print_r($idx, true),
        );
      }
    },
  );

  foreach ($quotients as $result) {
    if ($result->isSucceeded()) {
      echo "Success: ";
      \var_dump($result->getResult());
    } else {
      echo "Failed: ";
      \var_dump($result->getException()->getMessage());
    }
  }
}
```
