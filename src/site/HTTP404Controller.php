<?hh // strict

final class HTTP404Controller extends WebPageController {
  public async function getTitle(): Awaitable<string> {
    return 'Page Not Found';
  }

  public async function getBody(): Awaitable<\XHPRoot> {
    return
      <x:frag>
        <p>
          The page you requested can't be found; you might want to try finding
          it from <a href="/">the front page</a> or the Hack or HHVM links
          above.
        </p>
      </x:frag>;
  }
}
