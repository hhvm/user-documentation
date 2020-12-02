```basic-usage.php
<<__EntryPoint>>
async function basic_usage_main(): Awaitable<void> {
  // Map a vector of numbers to half integer half
  // throwing if they can't be divided evenly
  $halves = await \HH\Asio\vmw(
    Vector {1, 2, 3, 4},

    async ($val) ==> {
      if ($val % 2) {
        throw new \Exception("$val is an odd number");
      } else {
        return $val / 2;
      }
    },
  );

  foreach ($halves as $result) {
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
