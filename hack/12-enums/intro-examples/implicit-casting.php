<?hh

namespace Hack\UserDocumentation\Enums\Intro\Examples\ImplicitCasting;

// We are now telling the typechecker that this enum is constrained to the
// underlying string type, and that implicit casts should be allowed.
enum Size : string as string {
  SMALL = "small" ;
  MEDIUM = "medium";
  LARGE = "large";
  X_LARGE = "x-large";
}

function say_greeting_with_size(string $size): void {
  echo "Hello. We have size " . $size . PHP_EOL;
}

function give_shirt(Size $size): void {
  echo "Here is your shirt of size " . $size . PHP_EOL;
}

function sales(): void {
  // Implict casting at work
  say_greeting_with_size(Size::SMALL);
  // No implicit casting this way though.
  // To go from the underlying type to the enum type, Hack provides builtin
  // enum functions to help you. The coerce function returns a nullable in case
  // you give it a value that doesn't exist in the enum; so assert that we are
  // giving it a proper value.
  $s = Size::coerce("small");
  invariant($s, "We know small is a value");
  give_shirt($s);
}

sales();
