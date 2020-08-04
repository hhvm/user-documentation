<?hh // partial

<<__EntryPoint>>
async function startHere(): Awaitable<void> {
  \init_docs_autoloader();
  await guidelines_examples_context_run('No');
  echo "\n\n";
  await guidelines_examples_context_run('Yes');
}
