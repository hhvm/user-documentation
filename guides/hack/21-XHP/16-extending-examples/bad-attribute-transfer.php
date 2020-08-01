<?hh // partial

<<__EntryPoint>>
function extending_examples_bad_attribute_transfer_run(): void {
  \__init_autoload();
  $my_box = <ui-my-box title="My box" />;
  // This will only bring <div class="my-box"></div> ... title= will be
  // ignored.
  echo $my_box->toString();
}
