<?hh

namespace Hack\UserDocumentation\Types\TypeSystem\Examples\Enum;

enum Color: string {
  BLUE = "blue";
  RED = "red";
  GREEN = "green";
}

// Enums can be used as type annotations just like any other type.
function render_color(Color $c): void {
  echo $c;
}

render_color(Color::BLUE); // "blue"
render_color(Color::RED); // "red"
