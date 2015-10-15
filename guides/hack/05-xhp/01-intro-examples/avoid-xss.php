<?hh

namespace Hack\UserDocumentation\XHP\Intro\Examples\AvoidXSS;

require __DIR__ . "/../../../../vendor/autoload.php";

function using_string(string $could_be_bad): void {
  // Could call htmlspecialchars() here
  echo '<html><head/><body> ' . $could_be_bad . '</body></html>';
}

function using_xhp(string $could_be_bad): void {
  // The string $could_be_bad will be escaped to HTML entities like:
  // <html><head></head><body>&lt;blink&gt;Ugh&lt;/blink&gt;</body></html>
  echo
    <html>
      <head/>
      <body>{$could_be_bad}</body>
    </html>;
}

function run(string $could_be_bad): void {
  using_string($could_be_bad);
  echo PHP_EOL . PHP_EOL;
  using_xhp($could_be_bad);
}

run('<blink>Ugh</blink>');
