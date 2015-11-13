<?hh

require __DIR__ . "/../../../../vendor/autoload.php";

class :introduction extends :x:element {
  protected function render(): \XHPRoot {
    return <strong>Hello!</strong>;
  }
}

class :intro-plain-str extends :x:element {
  protected function render(): \XHPRoot {
    // Since this function returns an XHPRoot, if you want to return a primitive
    // like a string, wrap it around <x:frag>
    return <x:frag>Hello!</x:frag>;
  }
}

function extending_examples_basic_run(): void {
  echo <introduction />;
  echo PHP_EOL . PHP_EOL;
  echo <intro-plain-str />;
}

extending_examples_basic_run();
