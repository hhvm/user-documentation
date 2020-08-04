<?hh // partial

<<__EntryPoint>>
async function extending_examples_good_attribute_transfer_run(
): Awaitable<void> {
  \init_docs_autoloader();
  $my_box = <ui_my_good_box title="My Good box" />;
  echo await $my_box->toStringAsync();
}
