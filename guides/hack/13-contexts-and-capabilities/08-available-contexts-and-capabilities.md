# This is a new feature which must be enabled in your projects' configuration

The following contexts and capabilities are implemented at present.

## Capabilities

### Output

This gates the ability to use the `echo` and `print` intrinsics within function bodies.

```hack
function does_echo_and_print(): void {
  echo 'like this';
  print 'or like this';
}
```

Additionally, stdlib functions that perform output operations such as file writes will require this capablity.

### WriteProperty

This gates the ability to modify objects within function bodies.

At present, all constructors have the ability to modify `$this`. Note that this does *not* imply that constructors can call functions requiring the WriteProperty capability.

```hack
Class SomeClass {
  public string $s = '';
  public function modifyThis(): void {
    $this->s = 'this applies as well';
  }
}

function modify_objects(SomeClass $sc): void {
  $sc->s = 'like this';
  $sc2 = new SomeClass();
  $sc2->s = 'or like this';
}
```

Hack Collections, being objects, require this capability to use the array access operator in a write context.

```hack
function modify_collection(): void {
  $v = Vector {};
  $v[] = 'like this';
  $m = Map {};
  $m['or'] = 'like this';
}
```

stdlib functions that modify their inputs or methods that modify `$this` will require this capability.

### AccessStaticVariable

This gates the ability to access static variables and globals.

```hack
Class SomeClass {
  public static string $s = '';
  public function modifyThis(): void {
    $this::$s; // like this
  }
}

function access_statics(SomeClass $sc): void {
  SomeClass::$s; // or like this  
}
```

stdlib functions that make use of mutable global state or expose the php-style superglobals will require this capability.

## Contexts

### Defaults

`defaults` represents the capability set {Output, WriteProperty, AccessStaticVariable}.

### Local

`local` represents the capability set {WriteProperty}.

### The Empty List

The empty context list, `[]`, has no capabilities. A function with no capabilities is the closest thing Hack has to 'pure' functions. As additional capabilities are added to Hack in the future, the restriction on these functions will increase.

As such, this is sometimes referred to as the 'pure context'.