You can incrementally port code to use XHP.

Assume your output is currently handled by the following function, which might
be called from many places.

```Hack
function render_component($text, $uri) {
  $uri = htmlspecialchars($uri);
  $text = htmlspecialchars($text);
  return "<a href=\"$uri\">$text</a>";
}
```

## Convert Leaf Functions

You can start by simply using XHP in `render_component`:

```Hack
async function render_component($text, $uri) {
  $link = <a href={$uri}>{$text}</a>;
  return await $link->toStringAsync();
  // or HH\Asio\join if converting all callers to async is hard
}
```

You are converting `render_component` into a safer function without the need for explicit escaping, etc. But you are still passing
strings around in the end.

## Use a Class

You could make `render_component` into a class:

```Hack
namespace ui;

class link extends x\element {
  attribute Uri $uri @required;  // Assume class Uri
  attribute string $text @required;
  protected async function renderAsync(): Awaitable<x\node> {
    return
      <a href={$this->:uri}>{$this->:text}</a>;
  }
}
```

Keep a legacy `render_component` around while you are converting the old code that uses `render_component` to use the class.

```Hack
async function render_component(string $text, Uri $uri): Awaitable<string> {
  return await (<ui:link uri={$uri} text={$text} />)->toStringAsync();
}
```
