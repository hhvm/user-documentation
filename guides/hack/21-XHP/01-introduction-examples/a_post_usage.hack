<?hh

// WARNING: Contains some auto-generated boilerplate code, see:
// HHVM\UserDocumentation\MarkdownExt\ExtractedCodeBlocks\FilterBase::addBoilerplate

namespace HHVM\UserDocumentation\Guides\Hack\XHP\Introduction\APostUsage;

use type Facebook\XHP\HTML\a;
use type HHVM\UserDocumentation\a_post;

<<__EntryPoint>>
async function intro_examples_a_a_post(): Awaitable<void> {
  \init_docs_autoloader();

  $get_link = <a href="http://www.example.com">I'm a normal link</a>;
  $post_link =
    <a_post href="http://www.example.com">I make a POST REQUEST</a_post>;

  echo await $get_link->toStringAsync();
  echo "\n";
  echo await $post_link->toStringAsync();
}
