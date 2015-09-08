<?hh // strict

abstract class HTTPException extends \Exception {
  abstract public function respond(): void;
}
abstract class RoutingException extends HTTPException {}

final class HTTPNotFoundException extends RoutingException {
  public function respond(): void {
    header('HTTP/1.0 404 Not Found');
  }
}

final class HTTPMethodNotAllowedException extends RoutingException {
  public function respond(): void {
    header('HTTP/1.0 405 Method Not Allowed');
  }
}

final class RedirectException extends HTTPException {
  public function __construct(
    private string $destination,
  ) {
    parent::__construct();
  }

  public function respond(): void {
    header('Location: '.$this->destination, true, 301);
  }
}
