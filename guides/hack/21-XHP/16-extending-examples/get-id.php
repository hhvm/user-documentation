<?hh // partial

<<__EntryPoint>>
function extending_examples_get_id_run(): void {
  \init_docs_autoloader();
  // This will print something like:
  // <span id="8b95a23bc0">This has a random id</span>
  echo <my_id />;
}
