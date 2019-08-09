<?hh // partial

require __DIR__."/../../../../vendor/hh_autoload.php";

<<__EntryPoint>>
function basic_usage_examples_basic_xhp(): void {
  var_dump(
    <div>
      My Text
      <strong>My Bold Text</strong>
      <i>My Italic Text</i>
    </div>,
  );
}
