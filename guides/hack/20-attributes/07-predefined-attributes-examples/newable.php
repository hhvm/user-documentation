<?hh

function f<<<__Newable>> reify T as A>(): T {
  return new T();
}
