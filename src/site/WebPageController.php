<?hh // strict

use HHVM\UserDocumentation\BuildPaths;
use HHVM\UserDocumentation\UIGlyphIcon;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactaros\HtmlResponse;

abstract class WebPageController extends WebController {
  public abstract function getTitle(): Awaitable<string>;
  protected abstract function getBody(): Awaitable<\XHPRoot>;

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
    list($title, $content) = await \HH\Asio\va2(
      $this->getTitle(),
      $this->getContentPane()
    );
    $content->prependChild(<user-survey />);
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
            <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
            <link rel="shortcut icon" href="/favicon.png" />
            {$open_search}
            <x:comment>
              Build ID: {file_get_contents(BuildPaths::BUILD_ID)}
            </x:comment>
            <static:stylesheet
              path="/css/main.css"
              media="screen"
            />
            <static:stylesheet
              path="/css/syntax-highlighting.css"
            />
            <link
              href="https://fonts.googleapis.com/css?family=Open+Sans:400,400italic,700,700italic|Roboto:700"
              rel="stylesheet"
              type="text/css"
            />
            <link
             rel="stylesheet"
             type="text/css"
             href="//cdn.jsdelivr.net/font-hack/2.015/css/hack-extended.min.css"
            />
            <script src="https://fb.me/react-0.14.2.min.js" />
            <script src="https://fb.me/react-dom-0.14.2.min.js" />
            {$google_analytics}
          </head>
          <body class={$body_class}>
            {$this->getHeader()}
            {$this->getSideNav()}
            {$content}
          </body>
        </html>
      </x:doctype>;
    $xhp->setContext('ServerRequestInterface', $this->request);
    $html = await $xhp->asyncToString();

    $response = Response::newWithStringBody($html)
      ->withStatus($this->getStatusCode());

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

  final public async function getContentPane(): Awaitable<XHPRoot> {
    list($title, $body) = await \HH\Asio\va2(
      $this->getTitle(),
      $this->getBody(),
    );
    return (
      <div class="mainContainer">
        {$this->getBreadcrumbs()}
        {$this->getTitleContent($title)}
        <div class="widthWrapper flexWrapper">
          <div class="mainWrapper">
            {$body}
          </div>
        </div>
      </div>
    );
  }

  private function getBodyClass(?string $extra_class): string {
    $class = 'bodyClass'.ucwords($this->getOptionalStringParam('product'));
    if ($extra_class !== null) {
      $class = $class.' '.$extra_class;
    }
    return $class;
  }

  private function getTitleContent(string $title): XHPRoot {
    $title_class =
      "mainTitle mainTitle".$this->getOptionalStringParam('product');
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

  protected function getBreadcrumbs(): ?:ui:breadcrumbs {
    return null;
  }

  protected function getHeader(): XHPRoot {
    $header_class =
      "header headerType".$this->getOptionalStringParam('product');
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
        </div>
      </footer>;
  }
}
