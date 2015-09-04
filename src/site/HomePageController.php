<?hh // strict

final class HomePageController extends WebPageController {
  protected async function getTitle(): Awaitable<string> {
    return 'HHVM and Hack Documentation';
  }

  protected async function getBody(): Awaitable<XHPRoot> {
    return <div />;
  }
}
