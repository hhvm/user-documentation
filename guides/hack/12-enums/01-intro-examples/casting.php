<?hh

namespace Hack\UserDocumentation\Enums\Intro\Examples\Casting;

enum Size : string {
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
  // We need a cast here because say_greeting_with_size is expecting a string
  // and it is incompatible with the value of an enum (even though it is a
  // string underlying).
  say_greeting_with_size((string) Size::SMALL);
  // To go from the underlying type to the enum type, Hack provides builtin
  // enum functions to help you. The assert function basically tells the
  // typechecker that you are NOT going to give it a value that doesn't exist
  // in the enum.
  give_shirt(Size::assert("small"));
}

sales();
