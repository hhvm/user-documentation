// WARNING: Contains some auto-generated boilerplate code, see:
// HHVM\UserDocumentation\MarkdownExt\ExtractedCodeBlocks\FilterBase::addBoilerplate

namespace HHVM\UserDocumentation\Guides\Hack\XHP\Interfaces\Md;

use namespace Facebook\XHP;

/* YOU PROBABLY SHOULDN'T DO THIS
 *
 * Even with a scary (and accurate) name, it tends to be over-used.
 * See below for an alternative.
 */
class ExamplePotentialXSSSecurityHole implements XHP\UnsafeRenderable {
  public function __construct(private string $html) {
  }

  public async function toHTMLStringAsync(): Awaitable<string> {
    return $this->html;
  }
}
