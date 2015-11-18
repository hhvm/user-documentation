<?hh // strict

use HHVM\UserDocumentation\BuildPaths;
use Psr\Http\Message\ServerRequestInterface;

abstract class WebPageController extends WebController {
  public abstract function getTitle(): Awaitable<string>;
  protected abstract function getBody(): Awaitable<\XHPRoot>;

  protected function getExtraBodyClass(): ?string {
    return null;
  }

  final public async function respond(): Awaitable<void> {
    list($title, $content) = await \HH\Asio\va2(
      $this->getTitle(),
      $this->getContentPane()
    );
    
    $extra_class = $this->getExtraBodyClass();
    
    $body_class = $this->getBodyClass($extra_class);

    $xhp =
      <x:doctype>
        <html>
          <head>
            <title>{$title}</title>
            <meta charset="utf-8" />
            <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
            <link rel="shortcut icon" href="/favicon.png" />
            <x:comment>
              Build ID: {file_get_contents(BuildPaths::BUILD_ID)}
            </x:comment>
            <static:stylesheet
              path="/main.css"
              media="screen"
            />
            <link 
              rel="stylesheet" 
              type="text/css" 
              href="//cloud.typography.com/7491092/608288/css/fonts.css" 
            />
            <link 
	           rel="stylesheet" 
             type="text/css" 
             href="//cdn.jsdelivr.net/font-hack/2.015/css/hack-extended.min.css"
            />
            <link 
              rel="stylesheet"
              href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css"
            />
            <script src="https://fb.me/react-0.14.2.min.js" />
            <script src="https://fb.me/react-dom-0.14.2.min.js" />
          </head>
          <body class={$body_class}>
            {$this->getHeader()}
            {$this->getSideNav()}
            {$content}
          </body>
        </html>
      </x:doctype>;
    $string = await $xhp->asyncToString();
    print($string);
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
          <h2 class="pageTitle">{$title}</h2>
        </div>
      </div>;
  }
  
  protected function getSideNav(): XHPRoot {
    return <x:frag />;
  }
  
  protected function getBreadcrumbs(): XHPRoot {
    return <x:frag />;
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
}
