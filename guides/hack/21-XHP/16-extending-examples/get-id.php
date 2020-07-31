<?hh // partial

class :my-id extends :x:element {
  attribute string id;
  use XHPHelpers;
  protected function render(): \XHPRoot {
    return <span id={$this->getID()}>This has a random id</span>;
  }
}

<<__EntryPoint>>
function extending_examples_get_id_run(): void {
  \__init_autoload();
  // This will print something like:
  // <span id="8b95a23bc0">This has a random id</span>
  echo <my-id />;
}
