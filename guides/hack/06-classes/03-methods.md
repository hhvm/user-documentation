A method is a function defined in a class.

```
class Person {
  public string $name;

  public function greeting(): string {
    return "Hi, my name is".$this->name;
  }
}
```

To call an instance method, use `->`.

```
$p = new Person();
echo $p->greeting();
```

You can access the current instance with `$this` inside a method.

## Static Methods

A static method is a function in a class that is called without an
instance. Since there's no instance, `$this` is not available.

```
class MyPerson {
  public static function typicalGreeting(): string {
    return "Hello";
  }
}
```

To call a static method, use `::`.

```
echo Person::typicalGreeting();
```
