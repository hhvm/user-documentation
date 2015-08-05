<?hh

async function get_curl_data(string $url): string {
  return await HH\Asio\curl_exec($url);
}

function possible_side_effects(): int {
  sleep(1);
  echo "Output buffer stuff";
  return 4;
}

async function proximity(): Awaitable<void> {
  $handle = get_curl_data("http://cnn.com");
  possible_side_effects();
  await $handle; // instead you should await get_curl_data("....") here
}

HH\Asio\join(proximity());
