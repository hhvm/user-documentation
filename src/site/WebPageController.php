<?hh // strict

abstract class WebPageController extends WebController {
  protected abstract function getTitle(): Awaitable<string>;
  protected abstract function getBody(): Awaitable<\XHPRoot>;

  final public async function respond(): Awaitable<void> {
    list($title, $body) = await \HH\Asio\va2(
      $this->getTitle(),
      $this->getBody(),
    );

    $xhp =
      <x:doctype>
        <html>
          <head>
            <title>{$title}</title>
            <meta name="viewport" content="width=device-width, initial-scale=1" />
            <link rel="shortcut icon" href="/favicon.png" />
            <link 
              rel="stylesheet" 
              type="text/css" 
              media="screen" 
              href="http://213.168.248.29/main.css"
            />
            <link rel="stylesheet" type="text/css" href="//cloud.typography.com/7491092/608288/css/fonts.css" />
            <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/font-hack/2.015/css/hack-extended.min.css" />
          </head>
          <body>
            {$this->getHeader()}
            <div class="mainContainer">
              <div class="widthWrapper flexWrapper">
                <div class="mainWrapper">
                  <h2 class="pageTitle">{$title}</h2>
                  {$body}
                </div>
                {$this->getSideNav()}
              </div>
            </div>
          </body>
        </html>
      </x:doctype>;
    $string = await $xhp->asyncToString();
    print($string);
  }
  
  protected function getSideNav(): XHPRoot {
    return <x:frag />;
  }
  
  protected function getHeader(): XHPRoot {
    $header_class = "header headerType" . $this->getStringParam('product');
    return 
      <div class={$header_class}>
        <div class="widthWrapper">
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
              HHVM
            </a>
          </div>
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
              Hack
            </a>
          </div>
        </div>
      </div>;
  }

}
