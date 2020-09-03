<?hh // partial

use namespace Facebook\XHP;
use type Facebook\XHP\HTML\{i, ul};

function intro_examples_allowed_tag_validation_using_string(): void {
  echo '<ul><i>Item 1</i></ul>';
}

async function intro_examples_allowed_tag_validation_using_xhp(
): Awaitable<void> {
  try {
    $xhp = <ul><i>Item 1</i></ul>;
    echo await $xhp->toStringAsync();
  } catch (XHP\InvalidChildrenException $ex) {
    // We will get here because an <i> cannot be nested directly below a <ul>
    var_dump($ex->getMessage());
  }
}
