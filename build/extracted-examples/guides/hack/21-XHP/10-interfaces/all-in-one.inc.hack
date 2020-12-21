// WARNING: Contains some auto-generated boilerplate code, see:
// HHVM\UserDocumentation\MarkdownExt\ExtractedCodeBlocks\FilterBase::addBoilerplate

namespace HHVM\UserDocumentation\Guides\Hack\XHP\Interfaces\AllInOne;

use namespace Facebook\XHP;

final class XHPUnsafeExample implements XHP\UnsafeRenderable {
  public async function toHTMLStringAsync(): Awaitable<string> {
    /* HH_FIXME[2050] $_GET is not recognized by the typechecker */
    return '<script>'.$_GET['I_LOVE_XSS'].'</script>';
  }
}
