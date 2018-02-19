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
  echo "Hello. We have size " . $size . \PHP_EOL;
}

function give_shirt(Size $size): void {
  echo "Here is your shirt of size " . $size . \PHP_EOL;
}

function sales(): void {
  // Implict casting at work
  $s = Size::SMALL;
  say_greeting_with_size($s);
  // No implicit casting this way though.
  // To go from the underlying type to the enum type, Hack provides builtin
  // enum functions to help you. The assert function basically tells the
  // typechecker that you are NOT going to give it a value that doesn't exist
  // in the enum.
  give_shirt(Size::assert("small"));
  
  // The downside to implicit casting is that many (if not most) enumerations
  // have a specific meaning that doesn't make sense to use in the context of
  // its most base type (int or string). For example, an ambiguously-named
  // variable, several lines down in a function, is easy to mistake for another:
  if (Str\contains($s, 'cash')) {
    // We will never enter this loop. The line above would have been an error
    // if Size had not been typed as a string.
    record_cash_payment();
  }
}

sales();
