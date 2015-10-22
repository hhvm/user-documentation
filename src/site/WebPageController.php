<?hh // strict

use HHVM\UserDocumentation\BuildPaths;

abstract class WebPageController extends WebController {
  protected string $title = '';
  
  protected abstract function getTitle(): Awaitable<string>;
  protected abstract function getBody(): Awaitable<\XHPRoot>;

  final public async function respond(): Awaitable<void> {
    list($this->title, $body) = await \HH\Asio\va2(
      $this->getTitle(),
      $this->getBody(),
    );
    
    $body_class = 'bodyClass'.ucwords($this->getOptionalStringParam('product'));

    $xhp =
      <x:doctype>
        <html>
          <head>
            <title>{$this->title}</title>
            <meta name="viewport" content="width=device-width, initial-scale=1" />
            <link rel="shortcut icon" href="/favicon.png" />
            <x:comment>
              Build ID: {file_get_contents(BuildPaths::BUILD_ID)}
            </x:comment>
            <link 
              rel="stylesheet" 
              type="text/css" 
              media="screen" 
              href="/main.css"
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
          </head>
          <body class={$body_class}>
            {$this->getHeader()}
            {$this->getSideNav()}
            <div class="mainContainer">
              {$this->getBreadcrumbs()}
              {$this->getTitleContent()}
              <div class="widthWrapper flexWrapper">
                <div class="mainWrapper">
                  {$body}
                </div>
              </div>
            </div>
          </body>
        </html>
      </x:doctype>;
    $string = await $xhp->asyncToString();
    print($string);
  }
  
  protected function getTitleContent(): XHPRoot {
    $title_class = 
      "mainTitle mainTitle".$this->getOptionalStringParam('product');
    return
      <div class={$title_class}>
        <div class="widthWrapper">
          <h2 class="pageTitle">{$this->title}</h2>
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

}
