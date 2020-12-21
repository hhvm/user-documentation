// WARNING: Contains some auto-generated boilerplate code, see:
// HHVM\UserDocumentation\MarkdownExt\ExtractedCodeBlocks\FilterBase::addBoilerplate

namespace HHVM\UserDocumentation\Guides\Hack\Generics\ReifiedGenerics\TypeTesting;

function filter<<<__Enforceable>> reify T>(vec<mixed> $list): vec<T> {
  $ret = vec[];
  foreach ($list as $elem) {
    if ($elem is T) {
      $ret[] = $elem;
    }
  }
  return $ret;
}

<<__EntryPoint>>
function main(): void {
  \init_docs_autoloader();

  filter<int>(vec[1, "hi", true]);
  // => vec[1]
  filter<string>(vec[1, "hi", true]);
  // => vec["hi"]
}
