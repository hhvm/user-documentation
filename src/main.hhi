<?hh // strict

/** This declaration exists so that contributors get a typechecker error if they
 * add a function called \main() to the guides examples.
 *
 * This is especially likely for XHP, as namespaces are not currently supported.
 */

/*
TODO: Uncomment this after usox/hackttp no longer declares \main().
For now, \main() from usox/hackttp achieves effectively the same outcome.

<<__Deprecated("I am not a main function, I am just a tribute")>>
function main(): void {
}
*/