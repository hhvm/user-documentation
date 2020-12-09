<?hh

// WARNING: Contains some auto-generated boilerplate code, see:
// HHVM\UserDocumentation\MarkdownExt\ExtractedCodeBlocks\FilterBase::addBoilerplate

namespace HHVM\UserDocumentation\Guides\Hack\XHP\Extending\Categories;

use type Facebook\XHP\HTML\em;

<<__EntryPoint>>
async function extending_examples_categories_run(): Awaitable<void> {
  \init_docs_autoloader();

  $my_text = <my_text />;
  $my_text->appendChild(<em>"Hello!"</em>); // This is a Category\Phrase
  echo await $my_text->toStringAsync();

  $my_text = <my_text />;
  $my_text->appendChild("Bye!"); // This is pcdata, not a phrase
  // Won't print out "Bye!" because render is only returing Phrase children
  echo await $my_text->toStringAsync();
}
