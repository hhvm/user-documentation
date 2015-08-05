<?hh

function curl_A(): mixed {
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, "http://www.immigration.govt.nz/");
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 0);
  return curl_exec($ch);
}

function curl_B(): mixed {
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, "http://www.gov.za/");
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 0);
  return curl_exec($ch);
}

function main(): void {
  $start = microtime(true);
  $a = curl_A();
  $b = curl_B();
  $end = microtime(true);
  echo "Total time taken: " . strval($end - $start) . " seconds" . PHP_EOL;
}

main();
