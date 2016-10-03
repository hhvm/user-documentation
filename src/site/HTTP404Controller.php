<?hh // strict

use Psr\Http\Message\ServerRequestInterface;
use HHVM\UserDocumentation\APILegacyRedirectData;
use HHVM\UserDocumentation\BuildPaths;
use HHVM\UserDocumentation\JumpIndexData;
use HHVM\UserDocumentation\LegacyRedirects;
use HHVM\UserDocumentation\PHPDotNetArticleRedirectData;

require_once(BuildPaths::JUMP_INDEX);

final class HTTP404Controller extends NonRoutableWebPageController {
  public async function getTitle(): Awaitable<string> {
    return 'Page Not Found';
  }

  public function getExtraBodyClass(): ?string {
    return 'notFoundErrorPage';
  }

  private function getSuggestedUrl(
    string $path,
  ): ?string {
    $url = idx(JumpIndexData::getIndex(), strtolower($path));
    if ($url !== null) {
      return $url;
    }

    $url = LegacyRedirects::getUrlForId($path);
    if ($url !== null) {
      return $url;
    }

    $candidates = [];
    foreach (APILegacyRedirectData::getIndex() as $id => $url) {
      if (stripos($id, $path) !== false) {
        $candidates[$url] = $url;
      }
    }

    foreach (PHPDotNetArticleRedirectData::getIndex() as $id => $url) {
      if (stripos($id, $path) !== false) {
        $candidates[$url] = $url;
      }
    }

    if ($candidates) {
      uksort(
        $candidates,
        function (string $a, string $b): int {
          $a = strlen($a);
          $b = strlen($b);
          if ($a > $b) {
            return 1;
          } else if ($a < $b) {
            return -1;
          }
          return 0;
        },
      );
      return key($candidates);
    }

    return null;
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
        {$this->getNotFoundMessage()}
        <p class="notFoundMessage">
          You might want to try finding what you need from <a href="/">the
          front page</a> or the Hack or HHVM links above.
        </p>
        <p class="notFoundMessage">
          If you think you're seeing this page in error, please
          <github-issue-link
            issueTitle={$this->getGithubIssueTitle()}
            issueBody={$this->getGithubIssueBody()}
          >file an issue</github-issue-link>.
        </p>
      </x:frag>;
  }

  protected function getNotFoundMessage(): XHPRoot {
    $path = $this->getRequestedPath();
    $parts = explode('/', $path);

    if (count($parts) === 2) {
      list($_, $id) = $parts;
      $url = $this->getSuggestedUrl($id);
      if ($url !== null) {
        return (
          <p class="notFoundMessage">
            The page you requested does not exist; maybe you want
            <a href={$url}>{$url}</a> instead?
          </p>
        );
      }
    }

    return (
      <p class="notFoundMessage">
        The page you requested does not exist.
      </p>
    );
  }

  protected function getStatusCode(): int {
    return 404;
  }

  protected function getGithubIssueTitle(): string {
    $request_path = $this->getRequestedPath();
    return '404: '.$request_path;
  }

  protected function getGithubIssueBody(): string {
    return <<<EOF
Please complete the information below:

# How I got to this page:

- - - eg "I clicked a link on <address of other site>" - - -

# What I expected to find here:

- - - eg "Documentation tell me how to <do something>" - - -
EOF;
  }

  protected function requireSecureConnection(): void {
    /* No-op implementation so that the 404 handler doesn't throw a redirect
     * exception. If you need something similar, maybe add a
     * 'BypassHTTPSEnforcement' interface or similar, and check for that in the
     * superclass implementation.
     */
  }
}
