// WARNING: Contains some auto-generated boilerplate code, see:
// HHVM\UserDocumentation\MarkdownExt\ExtractedCodeBlocks\FilterBase::addBoilerplate

namespace HHVM\UserDocumentation\Guides\Hack\TraitsAndInterfaces\UsingATrait\Traitinterface;

interface I1 {
  const FOO = 'one';
}

trait T implements I1 {}

interface I {
  const FOO = 'two';
}

class A implements I { use T; }

<<__EntryPoint>>
function main() : void {
  \init_docs_autoloader();

  \var_dump(A::FOO);
}
