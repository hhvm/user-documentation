<?hh

// WARNING: Contains some auto-generated boilerplate code, see:
// HHVM\UserDocumentation\MarkdownExt\ExtractedCodeBlocks\FilterBase::addBoilerplate

namespace HHVM\UserDocumentation\Guides\Hack\ClassHHVectorMethodAdd\BasicUsage;

<<__EntryPoint>>
function _main(): void {
  \init_docs_autoloader();

  $v = Vector {};

  $v->add('red');
  \var_dump($v);

  // Vector::add returns the Vector so it can be chained
  $v->add('green')
    ->add('blue')
    ->add('yellow');
  \var_dump($v);
}
