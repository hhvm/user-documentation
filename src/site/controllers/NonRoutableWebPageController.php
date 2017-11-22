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

use HHVM\UserDocumentation\LocalConfig;
use HHVM\UserDocumentation\UIGlyphIcon;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactaros\HtmlResponse;

use namespace HH\Lib\C;

abstract class NonRoutableWebPageController extends WebController {
  protected abstract function getTitle(): Awaitable<string>;
  protected abstract function getBody(): Awaitable<\XHPRoot>;

  protected function getHeading(): Awaitable<string> {
    return $this->getTitle();
  }

  protected function getExtraBodyClass(): ?string {
    return null;
  }

  protected function getGithubIssueTitle(): ?string {
    /* Bad automatic title: "Issue with /foo/bar"
     * Good automatic title: "404: /foo/bar"
     *
     * There isn't a general way to create a good title, so leave it blank and
     * hope the user picks something decent. We get the URL in the
     * automatically-appended metadata anyway.
     *
     * "Issue with /foo/bar" is 'bad' because we will want to rename any issues
     * with that title during triage to something more descriptive.
     */

    return null;
  }

  protected function getGithubIssueBody(): string {
    return <<<EOF
Please complete the information below:

# Where is the problem?

- - - eg "The section describing how widgets work" - - -

# What is the problem?

- - - eg "It doesn't explain that widgets are singletons" - - -
EOF;
  }

  final public async function getResponse(): Awaitable<ResponseInterface> {
    list($title, $content) = await \HH\Asio\va(
      $this->getTitle(),
      $this->getContentPane()
    );
    $content->appendChild($this->getFooter());

    $extra_class = $this->getExtraBodyClass();
    $body_class = $this->getBodyClass($extra_class);
    $google_analytics = null;
    $open_search = null;
    $require_secure = false;

    switch ($this->getRequestedHost()) {
      case 'beta.docs.hhvm.com':
        throw new RedirectException(
          'http://docs.hhvm.com'.$this->getRequestedPath()
        );
      case 'docs.hhvm.com':
        $google_analytics =
          <script:google-analytics trackingID="UA-49208336-3" />;
        $open_search =
          <link
            rel="search"
            type="application/opensearchdescription+xml"
            href="/search.xml"
          />;
          $require_secure = true;
        break;
      case 'staging.docs.hhvm.com':
        $require_secure = true;
        break;
    }

    if ($require_secure) {
      $this->requireSecureConnection();
    }

    $xhp =
      <x:doctype>
        <html>
          <head>
            <title>{$title}</title>
            <meta charset="utf-8" />
            <meta
              name="viewport"
              content="width=device-width, initial-scale=1.0"
            />
            <link rel="shortcut icon" href="/favicon.png" />
            {$open_search}
            <x:comment>
              Build ID: {LocalConfig::getBuildID()}
            </x:comment>
            <static:stylesheet
              path="/css/main.css"
              media="screen"
            />
            <link
              href="https://fonts.googleapis.com/css?family=Open+Sans:400,400italic,700,700italic|Roboto:700"
              rel="stylesheet"
              type="text/css"
            />
            {$google_analytics}
          </head>
          <body class={$body_class}>
            {$this->getHeader()}
            {$this->getSideNav()}
            {$content}
            {$this->getEagerFetchScript()}
          </body>
        </html>
      </x:doctype>;
    $xhp->setContext('ServerRequestInterface', $this->request);
    $html = await $xhp->asyncToString();

    $response = Response::newWithStringBody($html)
      ->withStatus($this->getStatusCode())
      ->withHeader('Cache-Control', 'max-age=60'); // enough for pre-fetching :)

    if ($require_secure) {
      $response = $response->withHeader(
        'Strict-Transport-Security', 'max-age='.(60 * 60  * 24 * 28), // 4 weeks
      );
    }

    return $response;
  }

  protected function getStatusCode(): int {
    return 200;
  }

  final protected async function getContentPane(): Awaitable<XHPRoot> {
    list($heading, $body) = await \HH\Asio\va(
      $this->getHeading(),
      $this->getBody(),
    );

    $breadcrumbs = $this->getBreadcrumbs();
    if ($breadcrumbs !== null) {
      invariant(
        !C\is_empty($breadcrumbs),
        'If using breadcrumbs, specify at least one',
      );
      $breadcrumbs = <ui:breadcrumbs stack={$breadcrumbs} />;
    }
    return (
      <div class="mainContainer">
        {$breadcrumbs}
        {$this->getTitleContent($heading)}
        <div class="widthWrapper flexWrapper">
          <div class="mainWrapper">
            {$body}
          </div>
        </div>
      </div>
    );
  }

  private function getBodyClass(?string $extra_class): string {
    $class = 'bodyClass'.ucwords($this->getRawParameter_UNSAFE('product'));
    if ($extra_class !== null) {
      $class = $class.' '.$extra_class;
    }
    if ($this->isFacebookIP()) {
      $class .= ' isFbViewer';
    } else {
      $class .= ' isNotFbViewer';
    }
    return $class;
  }

  private function getTitleContent(string $title): XHPRoot {
    $title_class =
      "mainTitle mainTitle".$this->getRawParameter_UNSAFE('product');
    return
      <div class={$title_class}>
        <div class="widthWrapper">
          <h1 class="pageTitle">{$title}</h1>
        </div>
      </div>;
  }

  protected function getSideNav(): XHPRoot {
    return <x:frag />;
  }

  protected function getBreadcrumbs(
  ): ?vec<(string, ?string)> {
    return null;
  }

  protected function getHeader(): XHPRoot {
    $header_class =
      "header headerType".$this->getRawParameter_UNSAFE('product');
    return
      <div class={$header_class}>
        <div class="widthWrapper">
          <div class="headerLogo hackLogo">
            <a href="/hack/">
              <span class="logoCSS hackLogoCSS">
                <i class="logoPolygon a a1" />
                <i class="logoPolygon b b1" />
                <i class="logoPolygon b b2" />
                <i class="logoPolygon a a3" />
                <i class="logoPolygon b b3" />
                <i class="logoPolygon a a4" />
                <i class="logoPolygon b b4" />
              </span>
              <strong>Hack</strong>
            </a>
          </div>
          <div class="headerLogo hhvmLogo">
            <a href="/hhvm/">
              <span class="logoCSS hhvmLogoCSS">
                <i class="logoPolygon a a1" />
                <i class="logoPolygon b b1" />
                <i class="logoPolygon a a2" />
                <i class="logoPolygon b b2" />
                <i class="logoPolygon a a3" />
                <i class="logoPolygon b b3" />
                <i class="logoPolygon a a4" />
                <i class="logoPolygon b b4" />
              </span>
              <strong>HHVM</strong>
            </a>
          </div>
          <div class="headerElement githubIssueLink">
            <github-issue-link
              issueTitle={$this->getGithubIssueTitle()}
              issueBody={$this->getGithubIssueBody()}
              controller={static::class}>
              <ui:glyph icon={UIGlyphIcon::BUG} />
              report a problem or make a suggestion
            </github-issue-link>
          </div>
          <search-bar
            class="headerElement"
            placeholder="Search our Documentation"
          />
        </div>
      </div>;
  }

  /* If you're reading this, you probably want to remove 'final' so that you
   * can pull stuff out of $request or $parameters. Instead:
   *
   * - use getRequiredStringParam() and friends to get the data you need in a
   *   safe and abstracted way
   * - if there isn't an existing abstraction that fits your needs, add one
   */
  final public function __construct(
    ImmMap<string,string> $parameters,
    private ServerRequestInterface $request,
  ) {
    parent::__construct($parameters, $request);
  }

  private function getFeedbackFooter(): XHPRoot {
    return
      <div class="footerPanel footerPanelFullWidth">
        <h2>See something wrong?</h2>
        <ui:button
          className="gitHubIssueButton"
          glyph={UIGlyphIcon::BUG}>
          <span>
            <github-issue-link
              issueTitle={$this->getGithubIssueTitle()}
              issueBody={$this->getGithubIssueBody()}
              controller={static::class}>
              Report a problem or make a suggestion.
            </github-issue-link>
          </span>
        </ui:button>
      </div>;
  }

  private function getFooter(): :footer {
    $php_spec_link = 'https://github.com/php/php-langspec/' .
      'blob/master/spec/00-specification-for-php.md';
    $hack_spec_link = 'https://github.com/hhvm/hack-langspec/' .
      'blob/master/spec/00-specification-for-hack.md';
    return
      <footer class="footerWrapper">
        <div class="mainWrapper">
          {$this->getFeedbackFooter()}
          <div class="footerPanel">
            <h2>Hack</h2>
            <ul>
              <li><a href="/hack/overview/">Overview</a></li>
              <li><a href="/hack/getting-started/">Getting Started</a></li>
              <li><a href="/hack/tools/">Tools</a></li>
              <li><a href="/hack/FAQ/">FAQ</a></li>
              <li><a href="/hack/reference/">API Reference</a></li>
            </ul>
          </div>
          <div class="footerPanel">
            <h2>HHVM</h2>
            <ul>
              <li><a href="/hhvm/getting-started/">Getting Started</a></li>
              <li><a href="/hhvm/installation/">Installation</a></li>
              <li><a href="/hhvm/basic-usage/">Basic Usage</a></li>
              <li><a href="/hhvm/configuration/">Configuration</a></li>
            </ul>
          </div>
          <div class="footerPanel">
            <h2>Hack Community</h2>
            <ul>
              <li><a href="http://hacklang.org/">Website</a></li>
              <li><a href="https://twitter.com/hacklang">Twitter</a></li>
              <li>
                <a
                  href="https://github.com/facebook/hhvm/tree/master/hphp/hack">
                  GitHub
                </a>
              </li>
            </ul>
          </div>
          <div class="footerPanel">
            <h2>HHVM Community</h2>
            <ul>
              <li><a href="http://hhvm.com">Website</a></li>
              <li><a href="http://hhvm.com/blog">Blog</a></li>
              <li><a href="https://www.facebook.com/hhvm">Facebook</a></li>
              <li><a href="https://twitter.com/HipHopVM">Twitter</a></li>
            </ul>
          </div>
          <div class="footerPanel">
            <h2>Language Specs</h2>
            <ul>
              <li><a href={$php_spec_link}>PHP</a></li>
              <li><a href={$hack_spec_link}>Hack</a></li>
            </ul>
          </div>
        </div>
      </footer>;
  }

  private function getEagerFetchScript(): :script {
    $code = <<<EOF
// Prefetch pages on this site for performance
if (document.querySelectorAll) {
  var links = document.querySelectorAll(
    '.mainContainer a, .navOuterContainer a'
  );

  for (var i = 0; i < links.length; i++) {
    var link = links[i];
    if (link.pathname == window.location.pathname) {
      continue;
    }
    if (link.hostname !== window.location.hostname) {
      continue;
    }

    link.addEventListener(
      'mouseover',
      function() {
        var req = new XMLHttpRequest();
        req.open('GET', this.href, /* async = */ true);
        req.send();
      }.bind(link)
    );
  }
}
EOF;
    return <script language="javascript">{$code}</script>;
  }
}
