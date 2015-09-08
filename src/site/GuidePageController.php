<?hh // strict

use HHVM\UserDocumentation\BuildPaths;
use HHVM\UserDocumentation\GuidesIndex;
use HHVM\UserDocumentation\HTMLFileRenderable;

final class GuidePageController extends WebPageController {
  protected async function getTitle(): Awaitable<string> {
    $guide = $this->getRequiredStringParam('guide');
    $page = $this->getRequiredStringParam('page');
    return ucwords(strtr($guide.': '.$page, '-', ' '));
  }

  protected async function getBody(): Awaitable<XHPRoot> {
    $path = GuidesIndex::getFileForPage(
      $this->getRequiredStringParam('product'),
      $this->getRequiredStringParam('guide'),
      $this->getRequiredStringParam('page'),
    );
    return <div>{new HTMLFileRenderable($path)}</div>;
  }
}
