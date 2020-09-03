<?hh // strict
/*
 *  Copyright (c) 2004-present, Facebook, Inc.
 *  All rights reserved.
 *
 *  This source code is licensed under the BSD-style license found in the
 *  LICENSE file in the root directory of this source tree. An additional grant
 *  of patent rights can be found in the PATENTS file in the same directory.
 *
 */

use namespace HH\Lib\C;
use namespace Facebook\XHP\Core as x;
use type Facebook\XHP\HTML\{a, div, i, p, span};
use type HHVM\UserDocumentation\{
  APILegacyRedirectData,
  JumpIndexData,
  LegacyRedirects,
  github_issue_link,
};

final class HTTP404Controller extends NonRoutableWebPageController {
  <<__Override>>
  public async function getTitleAsync(): Awaitable<string> {
    return 'Page Not Found';
  }

  <<__Override>>
  public function getExtraBodyClass(): ?string {
    return 'notFoundErrorPage';
  }

  private function getSuggestedUrl(string $path): ?string {
    $url = idx(JumpIndexData::getIndex(), strtolower($path));
    if ($url !== null) {
      return $url;
    }

    $url = LegacyRedirects::getUrlForId($path);
    if ($url !== null) {
      return $url;
    }

    $candidates = darray[];
    foreach (APILegacyRedirectData::getIndex() as $id => $url) {
      if (stripos($id, $path) !== false) {
        $candidates[$url] = $url;
      }
    }

    if ($candidates) {
      uksort(
        inout $candidates,
        function(string $a, string $b): int {
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
      return C\first_key($candidates);
    }

    return null;
  }

  <<__Override>>
  public async function getBodyAsync(): Awaitable<x\node> {
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
          <github_issue_link
            issueTitle={$this->getGithubIssueTitle()}
            issueBody={
              $this->getGithubIssueBody()
            }>file an issue</github_issue_link>.
        </p>
      </x:frag>;
  }

  protected function getNotFoundMessage(): x\node {
    $path = $this->getRequestedPath();
    $parts = explode('/', $path);

    if (count($parts) === 2) {
      $id = $parts[1];
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

  <<__Override>>
  protected function getStatusCode(): int {
    return 404;
  }

  <<__Override>>
  protected function getGithubIssueTitle(): string {
    $request_path = $this->getRequestedPath();
    return '404: '.$request_path;
  }

  <<__Override>>
  protected function getGithubIssueBody(): string {
    return <<<EOF
Please complete the information below:

# How I got to this page:

- - - eg "I clicked a link on <address of other site>" - - -

# What I expected to find here:

- - - eg "Documentation tell me how to <do something>" - - -
EOF;
  }

  <<__Override>>
  protected function requireSecureConnection(): void {
    /* No-op implementation so that the 404 handler doesn't throw a redirect
     * exception. If you need something similar, maybe add a
     * 'BypassHTTPSEnforcement' interface or similar, and check for that in the
     * superclass implementation.
     */
  }
}
