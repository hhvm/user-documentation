<?hh // partial

<<__EntryPoint>>
function basic_usage_examples_basic_xhp(): void {
  \init_docs_autoloader();
  var_dump(
    <div>
      My Text
      <strong>My Bold Text</strong>
      <i>My Italic Text</i>
    </div>,
  );
}
