<?hh

// WARNING: Contains some auto-generated boilerplate code, see:
// HHVM\UserDocumentation\MarkdownExt\ExtractedCodeBlocks\FilterBase::addBoilerplate

namespace HHVM\UserDocumentation\Guides\Hack\ClassHHVectorMethodLazy\BasicUsage;

<<__EntryPoint>>
function _main(): void {
  \init_docs_autoloader();

  $vector = new Vector(\range(0, 1000000));

  $s = \microtime(true);
  $non_lazy = $vector->filter($x ==> $x % 2 === 0)->take(5);
  $e = \microtime(true);

  \var_dump($non_lazy);
  echo "Time non-lazy: ".\strval($e - $s).\PHP_EOL;

  // Using a lazy view of the vector can save us a bunch of time, possibly even
  // cutting this call time by 90%.
  $s = \microtime(true);
  $lazy = $vector->lazy()->filter($x ==> $x % 2 === 0)->take(5);
  $e = \microtime(true);

  \var_dump(new Vector($lazy));
  echo "Time lazy: ".\strval($e - $s).\PHP_EOL;
}
