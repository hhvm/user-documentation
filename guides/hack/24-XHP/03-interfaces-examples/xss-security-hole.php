<?hh
require __DIR__ . "/../../../../vendor/autoload.php";

require_once __DIR__ . '/md_render.inc.php';

/* YOU PROBABLY SHOULDN'T DO THIS
 *
 * Even with a scary (and accurate) name, it tends to be over-used.
 * See below for an alternative.
 */
class ExamplePotentialXSSSecurityHole implements XHPUnsafeRenderable {
  public function __construct(
    private string $html,
  ) {
  }

  public function toHTMLString(): string {
    return $this->html;
  }
}

echo (
  <div class="markdown">
    {new ExamplePotentialXSSSecurityHole(
      HHVM\UserDocumentation\XHP\Examples\md_render('Markdown goes here')
    )}
  </div>
)."\n";
