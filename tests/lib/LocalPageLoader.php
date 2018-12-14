<?hh

namespace HHVM\UserDocumentation\Tests;

use type Facebook\Experimental\Http\Message\{HTTPMethod, ResponseInterface};

use namespace HH\Lib\Math;
use namespace HH\Lib\Experimental\{Filesystem, IO};

final class LocalPageLoader extends PageLoader {
  protected function __construct() {}

  <<__Override>>
  protected async function getPageImplAsync(
    string $url,
  ): Awaitable<(ResponseInterface, string)> {
    $query_params = [];
    $query_part = \parse_url($url, \PHP_URL_QUERY);
    if ($query_part !== null) {
      \parse_str($query_part, &$query_params);
    }

    $request = (new \Usox\HackTTP\ServerRequestFactory())->createServerRequest(
      HTTPMethod::GET,
      (new \Usox\HackTTP\UriFactory())->createUri($url),
      dict[],
    )
      ->withBody(Filesystem\open_read_only_non_disposable('/dev/null'))
      ->withQueryParams(dict($query_params));
    $buffer_path = \sys_get_temp_dir().'/'.\bin2hex(\random_bytes(16));
    $write_handle = Filesystem\open_write_only_non_disposable(
      $buffer_path,
      Filesystem\FileWriteMode::MUST_CREATE,
    );
    $response = (new \Usox\HackTTP\Response($write_handle));
    $response = await \HHVMDocumentationSite::getResponseForRequestAsync(
      $request,
      $response,
    );
    await $write_handle->closeAsync();
    await using ($read_handle = Filesystem\open_read_only($buffer_path));
    $content = await $read_handle->readAsync(Math\INT64_MAX);
    return tuple($response, $content);
  }
}
