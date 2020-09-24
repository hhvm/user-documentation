<?hh // partial

namespace HHVM\UserDocumentation\Guides\Hack\XHP\Interfaces\Md;

function md_render(string $md_source): string {
  return \htmlspecialchars($md_source);
}
