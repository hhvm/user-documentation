// WARNING: Contains some auto-generated boilerplate code, see:
// HHVM\UserDocumentation\MarkdownExt\ExtractedCodeBlocks\FilterBase::addBoilerplate

namespace HHVM\UserDocumentation\Guides\Hack\BuiltInTypes\Dynamic\CoercionToDynamic;

function f(dynamic $d): void {}
function g(arraykey $a): void {}

function caller(int $i): void {
  f($i); // int ~> dynamic
  g($i); // int ~> arraykey by subtyping
}
