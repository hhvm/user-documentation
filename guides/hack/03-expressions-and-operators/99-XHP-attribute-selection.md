When working with [XHP](/hack/XHP/introduction), use the `->:` operator to retrieve an XHP Class [attribute](/hack/XHP/basic-usage#attributes) value.

You can also use `$this->:` in place of the named class instance.

```required-attributes.inc.hack
use namespace Facebook\XHP\Core as x;

final xhp class user_info extends x\element {
  attribute int userid @required;
  attribute string name = "";

  protected async function renderAsync(): Awaitable<x\node> {
    return
      <x:frag>User with id {$this->:userid} has name {$this->:name}</x:frag>;
  }
}
```