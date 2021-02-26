// WARNING: Contains some auto-generated boilerplate code, see:
// HHVM\UserDocumentation\MarkdownExt\ExtractedCodeBlocks\FilterBase::addBoilerplate

namespace HHVM\UserDocumentation\Guides\Hack\Classes\UsingATrait\Traitparent;

trait T {
  const FOO = 'trait';
}

class B {
  const FOO = 'parent';
}

class A extends B { use T; }

<<__EntryPoint>>
function main() : void {
  \init_docs_autoloader();

  \var_dump(A::FOO);
}
