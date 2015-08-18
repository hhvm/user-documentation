<?hh

namespace Hack\UserDocumentation\Attributes\Intro\Examples\Simple;

<<ClassOwner("Joel Marcey"), Description("This class does nothing")>>
class Simple {}

function get_attributes(): void {
  $rc = new \ReflectionClass(
    "Hack\UserDocumentation\Attributes\Intro\Examples\Simple\Simple"
  );
  var_dump($rc->getAttributes());
}

get_attributes();
