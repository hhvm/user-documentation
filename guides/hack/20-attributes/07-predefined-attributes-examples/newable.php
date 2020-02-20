<?hh

namespace Hack\Attributes\Newable;

function f<<<__Newable>> reify T as A>(): T {
  return new T();
}
