<?hh // partial

namespace Hack\UserDocumentation\XHP\MarkdownWrapper;

function md_render(string $md_source): string {
  return \htmlspecialchars($md_source);
}
