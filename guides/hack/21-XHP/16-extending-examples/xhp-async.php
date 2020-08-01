<?hh // partial

<<__EntryPoint>>
async function extending_examples_async_run(): Awaitable<void> {
  \__init_autoload();
  $status = <ui:get-status />;
  $html = await $status->asyncToString();
  // This can be long, so just show a bit for illustrative purposes
  $sub_status = substr($html, 0, 100);
  var_dump($sub_status);
}
