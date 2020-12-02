<?hh

// WARNING: Contains some auto-generated boilerplate code, see:
// HHVM\UserDocumentation\MarkdownExt\ExtractedCodeBlocks\FilterBase::addBoilerplate

namespace HHVM\UserDocumentation\Guides\Hack\ClassHHSetMethodFromArrays\BasicUsage;

<<__EntryPoint>>
function _main(): void {
  \init_docs_autoloader();

  $s = Set::fromArrays(
    varray['red'],
    varray['green', 'blue'],
    varray['yellow', 'red'], // Duplicate 'red' will be ignored
  );

  \var_dump($s);
}
