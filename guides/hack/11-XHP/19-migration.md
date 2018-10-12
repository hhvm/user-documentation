It is definitely possible that you have code that you would like to convert to XHP. You can do this piece meal in a few different ways.

The basis for all these possibilities is this function:

```Hack
function render_component($text, $uri) {
  $uri = htmlspecialchars($uri);
  $text = htmlspecialchars($text);
  return "<a href=\"$uri\">$text</a>";
}
```

This could be called from many places.

## Convert Leaf Functions

You can simply use XHP in `render_component`:

```Hack
function render_component($text, $uri) {
  $link = <a href={$uri}>{$text}</a>;
  return $link->toString();
}
```

You are converting `render_component` into a safer function without the need for explicit escaping, etc. But you are still passing 
strings around in the end.

## Use a Class

You could make `render_component` into a class:

```Hack
// Assume class Uri
class :ui:component-link extends :x:element {
  attribute Uri $uri @required;
  attribute string $text @required;
  protected function render(): XHPRoot {
    return 
      <a href={$this->:uri}>{$this->:text}</a>;
  }
}
```

Keep a legacy `render_component` around while you are converting the old code that uses `render_component` to use the class.

```Hack
function render_component(string $text, Uri $uri): string {
  return (<ui:component-link uri={$uri} text={$text} />)->toString();
}
```
