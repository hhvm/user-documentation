<?hh // partial

<<__EntryPoint>>
function extending_examples_bad_attribute_transfer_run(): void {
  \init_docs_autoloader();
  $my_box = <ui_my_box title="My box" />;
  // This will only bring <div class="my-box"></div> ... title= will be
  // ignored.
  echo $my_box->toString();
}
