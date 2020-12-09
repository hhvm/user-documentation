<?hh

// WARNING: Contains some auto-generated boilerplate code, see:
// HHVM\UserDocumentation\MarkdownExt\ExtractedCodeBlocks\FilterBase::addBoilerplate

namespace HHVM\UserDocumentation\Guides\Hack\FunctionHHAsioMm\BasicUsage;

/**
 * Query an arbitrary number of URLs in parallel
 * returning them as a Map of string responses.
 *
 * Refer to \HH\Asio\m() for a more verbose version of this.
 */
async function get_urls(
  \ConstMap<string, string> $urls,
): Awaitable<Map<string, string>> {

  // Invoke \HH\Asio\curl_exec for each URL,
  // then await on each in parallel
  return await \HH\Asio\mm($urls, fun("\HH\Asio\curl_exec"));
}

<<__EntryPoint>>
async function basic_usage_main(): Awaitable<void> {
  \init_docs_autoloader();

  $urls = ImmMap {
    'com' => "http://example.com",
    'net' => "http://example.net",
    'org' => "http://example.org",
  };

  $pages = await get_urls($urls);
  foreach ($pages as $name => $page) {
    echo $name, ': ';
    echo \substr($page, 0, 15).' ... '.\substr($page, -8);
  }
}
