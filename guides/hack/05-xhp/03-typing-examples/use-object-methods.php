<?hh

require __DIR__ . "/../../../../vendor/autoload.php";

function typing_examples_use_object_methods_get_root(
  Vector<int> $ids,
  string $text,
  string $title): \XHPRoot {
  $para = <p />;
  $para->setAttribute("title", $title);
  $para->appendChild($text);

  $list = <ul />;
  foreach ($ids as $id) {
    $list->appendChild(<li>{$id}</li>);
  }

  $final = <html />;
  $final->appendChild(<head/>);
  $final->appendChild($para);
  $final->appendChild($list);

  return $final;
}

function typing_examples_use_object_methods_run(): void {
  $ids = Vector {100, 200, 300};
  $elem = typing_examples_use_object_methods_get_root(
    $ids,
    "These are the initial IDs",
    "User IDs");
  var_dump($elem->getChildren("p")); // Get all the paragraph children
}

typing_examples_use_object_methods_run();
