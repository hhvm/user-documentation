<?hh

// Namespaces and XHP have issues right now

require __DIR__ . "/../../../../vendor/hh_autoload.php";

// A custom class extends :x:element and has a render method that returns
// XHPRoot so that you can do something like echo "<custom-class />;" This
// automatically calls the render method
class :ts-simple-xhp extends :x:element {
  public function render(): XHPRoot {
    return <b>Simple</b>;
  }
}

class TSPage {
  protected string $link;
  protected string $title;

  public function __construct(string $title, string $link) {
    $this->link = $link;
    $this->title = $title;
  }

  // return XHPChild when rendering a UI element and the elements
  // of that render are valid for XHP (e.g., strings, arrays of ints, etc.)
  public function render_page(): XHPChild {
    return <div>{$this->title}...{$this->link}</div>;
  }

  public function get_simple(): XHPRoot {
    return <ts-simple-xhp />;
  }
}

function ts_xhp_sample(): void {
  $p = new TSPage("Test XHP", "http://internet.org");
  echo $p->render_page();
  echo PHP_EOL;
  echo $p->get_simple();
}

ts_xhp_sample();
