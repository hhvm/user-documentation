<?hh // partial

<<__EntryPoint>>
async function intro_examples_allowed_tag_validation_run(): Awaitable<void> {
  \init_docs_autoloader();
  intro_examples_allowed_tag_validation_using_string();
  echo \PHP_EOL.\PHP_EOL;
  await intro_examples_allowed_tag_validation_using_xhp();
}
