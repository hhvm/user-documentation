<?hh // strict

namespace Hack\UserDocumentation\PLAY\FormatStringUsage;

<<__EntryPoint>>
function main(): void {
  \printf("Hello, World!\n");
  \printf("Value is %d\n", 6 + 4);
  \printf("Decimal: %d, HEX: %X, Unsigned: %u\nBinary: %b\n", -1, -1, -1, -1);

//  \printf("Value is %d\n");						// Error: too few arguments
//  \printf("Values are %d and %d\n", 10, 20, 30);	// Error: too many arguments

//  $format = "Value is %d\n";
//  \printf($format, 6 + 4);	// Error, the format string must be a string literal

  \printf("Value is %d\n", 6.0 + 4.0);
  \printf("Value is %d\n", 6.901 + 4.123);

  \printf("Value is %d\n", false);		// outputs 0
  \printf("Value is %d\n", true);		// outputs 1
  \printf("Value is %d\n", 'abc');		// ??? get 0
  \printf("Value is %d\n", vec[]);		// outputs 0
  \printf("Value is %d\n", vec[10,20]);	// outputs 1

  \printf("Value is %f\n", false);		// outputs 0
  \printf("Value is %f\n", true);		// outputs 1
  \printf("Value is %f\n", 'abc');		// ??? get 0
  \printf("Value is %f\n", vec[]);		// outputs 0
  \printf("Value is %f\n", vec[10,20]);	// outputs 1f

//  \printf("Value is %d\n", new C());	// Error: class C could not be converted to int
}

class C {}