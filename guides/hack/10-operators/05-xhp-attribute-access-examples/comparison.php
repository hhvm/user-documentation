<?hh

// For XHP library, etc.
require __DIR__ . "/../../../../vendor/autoload.php";

class :comparison:greeting extends :x:element {
  attribute string first = "Good";
  attribute string last = "Afternoon";
  public function render(): XHPRoot {
    // Using getattribute()
    $ret = $this->getAttribute("first");
    // using ->:
    $ret .= $this->:last;
    return <x:frag>{$ret}</x:frag>;
  }
}

echo <comparison:greeting />;
