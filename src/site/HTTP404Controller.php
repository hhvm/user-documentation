<?hh // strict

final class HTTP404Controller extends WebPageController {
  public async function getTitle(): Awaitable<string> {
    return 'Page Not Found';
  }
  
  public function getExtraBodyClass(): ?string {
    return 'notFoundErrorPage';
  }

  public async function getBody(): Awaitable<\XHPRoot> {
    return
      <x:frag>
        <div class="notFoundIcon">
          <span class="logoCSS notFoundIconCSS notFound_4_IconCSS">
            <i class="logoPolygon a a1" />
            <i class="logoPolygon a a2" />
            <i class="logoPolygon a a3" />
            <i class="logoPolygon a a4" />
            <i class="logoPolygon b b1" />
            <i class="logoPolygon b b2" />
            <i class="logoPolygon b b3" />
          </span>
          <span class="logoCSS notFoundIconCSS notFound_0_IconCSS">
            <i class="logoPolygon a a1" />
            <i class="logoPolygon a a2" />
            <i class="logoPolygon a a3" />
            <i class="logoPolygon b b1" />
            <i class="logoPolygon b b2" />
            <i class="logoPolygon b b3" />
          </span>
          <span class="logoCSS notFoundIconCSS notFound_4_IconCSS">
            <i class="logoPolygon a a1" />
            <i class="logoPolygon a a2" />
            <i class="logoPolygon a a3" />
            <i class="logoPolygon a a4" />
            <i class="logoPolygon b b1" />
            <i class="logoPolygon b b2" />
            <i class="logoPolygon b b3" />
          </span>
        </div>
        <p class="notFoundMessage">
          The page you requested can't be found.
        </p>
        <p class="notFoundMessage">
          You might want to try finding it from <a href="/">the front page</a> 
          or the Hack or HHVM links above.
        </p>
        <p class="notFoundMessage">
          If you think you're seeing this page in error, please 
          <a href="https://github.com/hhvm/user-documentation/issues" target="_blank">
            file an issue.
          </a>
        </p>
      </x:frag>;
  }
}
