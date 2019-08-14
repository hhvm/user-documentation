require_once(__DIR__.'/../vendor/autoload.hack');
use function HH\Asio\{join};

<<__EntryPoint>>
function main(): void {
  \Facebook\AutoloadMap\initialize();
  join(async_curl());
}
