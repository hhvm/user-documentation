<?hh

namespace Hack\UserDocumentation\Attributes\Intro\Examples\Simple;

final class ClassOwner implements \HH\ClassAttribute {
  public function __construct(public string $value) {}
}

final class Description implements \HH\ClassAttribute {
  public function __construct(public string $value) {}
}

<<ClassOwner("Joel Marcey"), Description("This class does nothing")>>
class Simple {}

function get_attributes(): void {
  // Old API
  $rc = new \ReflectionClass(
    "Hack\UserDocumentation\Attributes\Intro\Examples\Simple\Simple"
  );
  \var_dump($rc->getAttributes()["Description"]);
  // New API
  \var_dump($rc->getAttributeClass(ClassOwner::class)?->value);
}

get_attributes();
