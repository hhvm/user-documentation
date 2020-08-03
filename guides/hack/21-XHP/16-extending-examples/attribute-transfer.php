<?hh // partial

<<__EntryPoint>>
function extending_examples_good_attribute_transfer_run(): void {
  \init_docs_autoloader();
  $my_box = <ui-my-good-box title="My Good box" />;
  echo $my_box->toString();
}
