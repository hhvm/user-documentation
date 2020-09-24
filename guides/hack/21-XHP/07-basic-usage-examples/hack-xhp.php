<?hh // partial

use type Facebook\XHP\HTML\{div, i, strong};

class MyBasicUsageExampleClass {
  public function getInt(): int {
    return 4;
  }
}

function basic_usage_examples_get_string(): string {
  return "Hello";
}

function basic_usage_examples_get_float(): float {
  return 1.2;
}

<<__EntryPoint>>
async function basic_usage_examples_embed_hack(): Awaitable<void> {
  \init_docs_autoloader();
  $xhp_float = <i>{basic_usage_examples_get_float()}</i>;

  $xhp =
    <div>
      {(new MyBasicUsageExampleClass())->getInt()}
      <strong>{basic_usage_examples_get_string()}</strong>
      {$xhp_float /* this embeds the <i /> element as a child of the <div /> */}
    </div>;
  echo await $xhp->toStringAsync();
}
