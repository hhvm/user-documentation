<?hh // strict

final class GuidesListController extends WebPageController {
  protected async function getTitle(): Awaitable<string> {
    return 'HHVM and Hack Documentation';
  }

  protected async function getBody(): Awaitable<XHPRoot> {
    return <div />;
  }
}
