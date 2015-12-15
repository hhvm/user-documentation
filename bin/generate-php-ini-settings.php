<?hh

function generate(): void {
  $ini_page = file_get_contents('http://php.net/manual/en/ini.list.php');
  $lines = explode("\n", $ini_page);
  $start = false;
  $row = false;
  $item = false;
  $settings = '';
  foreach ($lines as $line) {
    if (strpos($line, '<tbody')) {
      $start = true;
    } else if ($start && strpos($line, '<tr>') !== false) {
      $row = true;
    } else if (
      $start &&
      $row &&
      strpos($line, '<td>') !== false) {
      $match = array();
      if (preg_match("/<a .*?>(.*?)<\/a>/", $line, $match) !== 0) {
        $settings .= $match[1] . "\n";
      } else if (preg_match("/<td>(.*?)<\/td>/", $line, $match) !== 0) {
        $settings .= $match[1] . "\n";
      }
      $row = false;
    } else if (strpos($line, '</tbody') !== false) {
      break;
    }
  }
  file_put_contents('../support-data/php-ini.txt', $settings);
}

generate();
