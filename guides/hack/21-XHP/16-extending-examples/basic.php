<?hh // partial

<<__EntryPoint>>
async function extending_examples_basic_run(): Awaitable<void> {
  \init_docs_autoloader();
  $xhp = <introduction />;
  echo await $xhp->toStringAsync()."\n";

  $xhp = <intro_plain_str />;
  echo await $xhp->toStringAsync()."\n";
}
