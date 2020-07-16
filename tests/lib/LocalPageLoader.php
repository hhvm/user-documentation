<?hh // partial

namespace HHVM\UserDocumentation\Tests;

use type Facebook\Experimental\Http\Message\{HTTPMethod, ResponseInterface};

use namespace HH\Lib\{File, Math};

final class LocalPageLoader extends PageLoader {
  protected function __construct() {}

  <<__Override>>
  protected async function getPageImplAsync(
    string $url,
  ): Awaitable<(ResponseInterface, string)> {
    $query_params = darray[];
    $query_part = \parse_url($url, \PHP_URL_QUERY);
    if ($query_part !== null) {
      \parse_str($query_part, inout $query_params);
    }

    $request = (new \Usox\HackTTP\ServerRequestFactory())->createServerRequest(
      HTTPMethod::GET,
      (new \Usox\HackTTP\UriFactory())->createUri($url),
      dict[],
    )
      ->withBody(File\open_read_only('/dev/null'))
      ->withQueryParams(dict($query_params));
    $buffer_path = \sys_get_temp_dir().'/'.\bin2hex(\random_bytes(16));
    $write_handle = File\open_write_only(
      $buffer_path,
      File\WriteMode::MUST_CREATE,
    );
    $response = (new \Usox\HackTTP\Response($write_handle));
    $response = await \HHVMDocumentationSite::getResponseForRequestAsync(
      $request,
      $response,
    );
    $write_handle->close();
    $read_handle = File\open_read_only($buffer_path);
    using $read_handle->closeWhenDisposed();
    $content = await $read_handle->readAsync(Math\INT64_MAX);
    return tuple($response, $content);
  }
}
