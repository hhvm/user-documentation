<?hh // partial

function intro_examples_avoid_xss_using_string(string $could_be_bad): void {
  // Could call htmlspecialchars() here
  echo '<html><head/><body> '.$could_be_bad.'</body></html>';
}

function intro_examples_avoid_xss_using_xhp(string $could_be_bad): void {
  // The string $could_be_bad will be escaped to HTML entities like:
  // <html><head></head><body>&lt;blink&gt;Ugh&lt;/blink&gt;</body></html>
  echo
    <html>
      <head />
      <body>{$could_be_bad}</body>
    </html>;
}

function intro_examples_avoid_xss_run(string $could_be_bad): void {
  intro_examples_avoid_xss_using_string($could_be_bad);
  echo PHP_EOL.PHP_EOL;
  intro_examples_avoid_xss_using_xhp($could_be_bad);
}

<<__EntryPoint>>
function intro_examples_avoid_xss_main(): void {
  \__init_autoload();
  intro_examples_avoid_xss_run('<blink>Ugh</blink>');
}
