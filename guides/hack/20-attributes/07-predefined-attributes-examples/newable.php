<?hh

namespace Hack\Attributes\Newable;

final class A {}

function f<<<__Newable>> reify T as A>(): T {
  return new T();
}
