<?hh // partial

use type Facebook\XHP\HTML\{body, head, html};

function intro_examples_avoid_xss_using_string(string $could_be_bad): void {
  // Could call htmlspecialchars() here
  echo '<html><head/><body> '.$could_be_bad.'</body></html>';
}

async function intro_examples_avoid_xss_using_xhp(
  string $could_be_bad,
): Awaitable<void> {
  // The string $could_be_bad will be escaped to HTML entities like:
  // <html><head></head><body>&lt;blink&gt;Ugh&lt;/blink&gt;</body></html>
  $xhp =
    <html>
      <head />
      <body>{$could_be_bad}</body>
    </html>;
  echo await $xhp->toStringAsync();
}

async function intro_examples_avoid_xss_run(
  string $could_be_bad,
): Awaitable<void> {
  intro_examples_avoid_xss_using_string($could_be_bad);
  echo PHP_EOL.PHP_EOL;
  await intro_examples_avoid_xss_using_xhp($could_be_bad);
}

<<__EntryPoint>>
async function intro_examples_avoid_xss_main(): Awaitable<void> {
  \init_docs_autoloader();
  await intro_examples_avoid_xss_run('<blink>Ugh</blink>');
}
