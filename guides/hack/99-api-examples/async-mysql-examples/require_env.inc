<?hh

require __DIR__ . "/connect.inc";

if (!extension_loaded('mysql') || !function_exists('mysqli_connect')) {
  die('Skip');
}
list($h, $p, $u, $p, $d) = get_connection_info();
if (!mysqli_connect($h, $p, $d, $u, $p)) {
  die('Skip');
}

