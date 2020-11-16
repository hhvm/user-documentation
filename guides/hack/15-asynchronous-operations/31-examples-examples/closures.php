<?hh

// WARNING: Contains some auto-generated boilerplate code, see:
// HHVM\UserDocumentation\MarkdownExt\ExtractedCodeBlocks\FilterBase::addBoilerplate

namespace HHVM\UserDocumentation\Guides\Hack\AsynchronousOperations\Examples\Closures;

<<__EntryPoint>>
async function closure_async(): Awaitable<void> {
  \init_docs_autoloader();

  // closure
  $hello = async function(): Awaitable<string> {
    return 'Hello';
  };
  // lambda
  $bye = async ($str) ==> $str;

  // The call style to either closure or lambda is the same
  $rh = await $hello();
  $rb = await $bye("bye");

  echo $rh." ".$rb.\PHP_EOL;
}
