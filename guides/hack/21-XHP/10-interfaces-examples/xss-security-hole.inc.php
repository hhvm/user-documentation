<?hh // partial

/* YOU PROBABLY SHOULDN'T DO THIS
 *
 * Even with a scary (and accurate) name, it tends to be over-used.
 * See below for an alternative.
 */
class ExamplePotentialXSSSecurityHole implements XHPUnsafeRenderable {
  public function __construct(private string $html) {
  }

  public function toHTMLString(): string {
    return $this->html;
  }
}
