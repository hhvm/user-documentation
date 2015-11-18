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
    $build_id = trim(file_get_contents(BuildPaths::BUILD_ID));
    $request_time = (new DateTime())
      ->setTimezone(new DateTimeZone('Etc/UTC'))
      ->format(DateTime::RFC2822);
    $request_path = $this->getRequestedPath();

    $issue_title = '404: '.$request_path;
    $issue_body = <<<EOF
Please complete the information below:

# How I got to this page:

- - - eg "I clicked a link on <address of other site>" - - - 

# What I expected to find here:

- - - eg "Documentation tell me how to <do something>" - - -

--------------------------------

Please don't change anything below this point.

--------------------------------

 - Build ID: $build_id
 - Page requested: $request_path
 - Page requested at: $request_time
EOF;

    $new_issue_prefill_url = sprintf(
      '%s?title=%s&body=%s',
      'https://github.com/hhvm/user-documentation/issues/new',
      urlencode($issue_title),
      urlencode($issue_body),
    );

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
          <a href={$new_issue_prefill_url} target="_blank">
            file an issue.
          </a>
        </p>
      </x:frag>;
  }
}
