## WARNING WARNING WARNING

This section is under active development and represents an unreleased feature

## Back to your regularly scheduled docs

The following contexts and capabilities are implemented at present.

## Capabities

### Output

This gates the ability to use the `echo` and `print` intrinsics within function bodies.

```
function does_echo_and_print(): void {
  echo 'like this';
  print 'or like this';
}
```

Additionally, stdlib functions that perform output operations such as file writes will require this capablity.

### WriteProperty

This gates the ability to modify objects within function bodies. At present, all constructors implicitly have this capability.

```
Class SomeClass {
  public string $s = '';
  public function modify_this(): void {
    $this->s = 'this applies as well';
  }
}

function modify_objects(SomeClass $sc): void {
  $sc->s = 'like this';
  $sc2 = new SomeClass();
  $sc2->s = 'or like this';
}
```

Hack Collections, being objects, require this capability to use the `[]` operator in a write context.

```
function modify_collection(): void {
  $v = Vector {};
  $v[]= 'like this';
  $m = Map {};
  $m['or'] = 'like this';
}
```

stdlib functions that modify their inputs or methods that modify `$this` will require this capability.

### AccessStaticVariable

This gates the ability to access static variables and globals.

```
Class SomeClass {
  public static string $s = '';
  public function modify_this(): void {
    $this::$s; // like this
  }
}

function access_statics(SomeClass $sc): void {
  SomeClass::$s; // or like this  
}
```

stdlib functions that make use of mutable global state or expose the php-style superglobals will require this capability.

## Contexts

It is worth noting here specifically that the empty context list `[]` trivially represents the empty capability set `{}`. This may be referred to as the "pure context."

### Defaults

`defaults` represents the capability set {Output, WriteProperty, AccessStaticVariable}.

### Local

`local` represents the capability set {WriteProperty}.
