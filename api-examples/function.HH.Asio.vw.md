```basic-usage.php
async function one(): Awaitable<int> {
  return 1;
}

<<__EntryPoint>>
async function basic_usage_main(): Awaitable<void> {
  $mcr = \MCRouter::createSimple(ImmVector {});

  $handles = \HH\Asio\vw(Vector {
    // This will throw an exception, since there's no servers to speak to
    $mcr->get("no-such-key"),

    // While this will obviously succeed
    one(),
  });

  $results = await $handles;
  foreach ($results as $result) {
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
