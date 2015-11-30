<?hh

// For XHP library, etc.
require __DIR__ . "/../../../../vendor/autoload.php";

class :comparison:greeting extends :x:element {
  attribute string first = "Good";
  attribute string last = "Afternoon";

  public function render(): XHPRoot {
    // Using getattribute()
    $first = $this->getAttribute("first");
    // using ->:
    $last = $this->:last;

    $ret = $first.$last;

    /* To the typechecker:
     *
     * - $first has an unknown type, because the return type of getAttribute()
     *   varies.
     * - $last is a string because Hack understands that the ->: operator is
     *   fetching the 'last' attribute, which is in turn a string.
     * - $ret is a string because it is the result of concatenation.
     */
    return <x:frag>{$ret}</x:frag>;
  }
}

echo <comparison:greeting />;
