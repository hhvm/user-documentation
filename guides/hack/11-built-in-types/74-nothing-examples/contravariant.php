<?hh

namespace Hack\UserDocumentation\Types\Nothing\Examples\Contravariant;

final class MyClass<-T> {
  public function consume(T $value): void {}
  public function someOtherMethod(): void {}
}

// We don't use the `T` from `->consume(T): void` in the function,
// so we can use `nothing` for the generic and accept any and all MyClass instances.
function some_function(MyClass<nothing> $a, MyClass<nothing> $b): void {
  if ($a !== $b) {
    $b->someOtherMethod();
    echo "different\n";
  }
}

<<__EntryPoint>>
async function main_async(): Awaitable<void> {
  \init_docs_autoloader();

  $my_class_int = new MyClass<int>();
  $my_class_string = new MyClass<string>();

  some_function($my_class_int, $my_class_string);
}
