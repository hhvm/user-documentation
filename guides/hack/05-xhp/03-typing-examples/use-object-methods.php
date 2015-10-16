<?hh

namespace Hack\UserDocumentation\XHP\Typing\Examples\ObjectMethods;

require __DIR__ . "/../../../../vendor/autoload.php";

function use_object_methods(Vector<int> $ids, string $text,
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

function run(): void {
  $ids = Vector {100, 200, 300};
  $elem = use_object_methods($ids, "These are the initial IDs", "User IDs");
  var_dump($elem->getChildren("p")); // Get all the paragraph children
}

run();
