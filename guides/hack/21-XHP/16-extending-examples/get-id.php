<?hh // partial

<<__EntryPoint>>
async function extending_examples_get_id_run(): Awaitable<void> {
  \init_docs_autoloader();
  $with_id = <my_id />;
  echo 'ID: '.$with_id->getID()."\n";
  echo await $with_id->toStringAsync()."\n";

  $without_id = <my_id />;
  echo await $without_id->toStringAsync()."\n";
}
