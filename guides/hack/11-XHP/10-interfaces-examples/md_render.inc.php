<?hh // partial

namespace HHVM\UserDocumentation\XHP\Examples;

function md_render(string $md_source): string {
  return \htmlspecialchars($md_source);
}
