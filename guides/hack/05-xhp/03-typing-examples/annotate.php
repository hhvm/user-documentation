<?hh

require __DIR__ . "/../../../../vendor/autoload.php";

class typing_examples_annotate_WebPage {
  public function getTitle(): string {
    return "Title";
  }

  public function getURI(): string {
    return "http://uri.com";
  }
}

function typing_examples_annotate_get_link(
  typing_examples_annotate_WebPage $p,
  bool $title_only = false): \XHPChild {
  if ($title_only) {
    return $p->getTitle();
  }
  return <a href={$p->getURI()}>{$p->getTitle()}</a>;
}

function typing_examples_annotate_create_xhp_fragment(\XHPChild $xc): \XHPRoot {
  // XHPChild can be wrapped around an x:frag in order to create
  // an XHPRoot
  return
    <x:frag>
      {$xc}
    </x:frag>;
}

function typing_examples_annotate_run(): void {
  $p = new typing_examples_annotate_WebPage();

  // Get an XHP Object back
  $xc1 = typing_examples_annotate_get_link($p, false);
  var_dump($xc1);
  var_dump($xc1 instanceof \XHPChild);
  var_dump($xc1 instanceof \XHPRoot); // true

  // Get a normal string back
  $xc2 = typing_examples_annotate_get_link($p, true);
  var_dump($xc2);
  // Even though this is a normal string, it is an instance of XHPChild
  var_dump($xc2 instanceof \XHPChild);
  var_dump($xc2 instanceof \XHPRoot); // false. string, int, etc. are not

  // Call a function that takes an XHPChild and returns an XHPRoot
  $root = typing_examples_annotate_create_xhp_fragment($xc1);
  var_dump($root);
  var_dump($root instanceof \XHPRoot);
  var_dump($root instanceof \XHPChild);

}

typing_examples_annotate_run();
