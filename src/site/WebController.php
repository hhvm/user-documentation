<?hh // strict

<<__ConsistentConstruct>>
abstract class WebController {
  public function __construct(
    \Psr\Http\Message\ServerRequestInterface $request,
  ) {
  }

  abstract public function respond(): Awaitable<void>;
}
