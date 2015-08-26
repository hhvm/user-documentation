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
  // enum functions to help you. The assert function basically tells the
  // typechecker that you are NOT going to give it a value that doesn't exist
  // in the enum.
  give_shirt(Size::assert("small"));
}

sales();
