<?hh // strict

use Psr\Http\Message\ServerRequestInterface;
use HHVM\UserDocumentation\BuildPaths;

final class HTTP404Controller extends WebPageController {
  public async function getTitle(): Awaitable<string> {
    return 'Page Not Found';
  }
  
  public function getExtraBodyClass(): ?string {
    return 'notFoundErrorPage';
  }

  public async function getBody(): Awaitable<\XHPRoot> {
    $request_path = $this->getRequestedPath();
    $issue_title = '404: '.$request_path;
    $issue_body = <<<EOF
Please complete the information below:

# How I got to this page:

- - - eg "I clicked a link on <address of other site>" - - - 

# What I expected to find here:

- - - eg "Documentation tell me how to <do something>" - - -
EOF;

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
          <github-issue-link
            issueTitle={$issue_title}
            issueBody={$issue_body}
          >file an issue</github-issue-link>.
        </p>
      </x:frag>;
  }
}
