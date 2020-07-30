<?hh // strict

use namespace HH\Lib\Str;

<<__EntryPoint>>
async function site_main_async(): Awaitable<void> {
  require_once(__DIR__.'/../vendor/autoload.hack');
  \Facebook\AutoloadMap\initialize();
  $request = Usox\HackTTP\create_server_request_from_globals();
  // header is of the form HOST:PORT - for `parse_url`, we need
  // `http://HOST:port/` as `parse_url()` is unable to parse IPv6
  // strings like `[::1]:8080

  $server = HHVM\UserDocumentation\_Private\SuperGlobals\server_variables();
  $dummy_uri = 'http://'.$server['HTTP_HOST'].'/';
  $host = \parse_url($dummy_uri, PHP_URL_HOST);
  $port = \parse_url($dummy_uri, PHP_URL_PORT);
  // We just use this to figure out if we should do a redirect - if we were
  // doing something more important, we should make sure that the remote end
  // is from a local-use IP range.
  $https = $server['HTTP_X_FORWARDED_PROTO'] ??
    $server['HTTPS'] ??
    $server['https'] ??
    false;
  if ($https is string) {
    $https = Str\lowercase((string)$https);
    $https = $https === 'on' ||
      $https === 'true' ||
      $https === 'yes' ||
      $https === 'https';
  }
  $scheme = ($https as bool) ? 'https' : 'http';
  $request = $request->withUri(
    $request->getUri()->withHost($host)->withPort($port)->withScheme($scheme),
  );

  await HHVMDocumentationSite::respondToAsync($request);
  exit(0);

}
