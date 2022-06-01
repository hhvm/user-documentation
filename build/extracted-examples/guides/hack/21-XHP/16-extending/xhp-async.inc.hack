// WARNING: Contains some auto-generated boilerplate code, see:
// HHVM\UserDocumentation\MarkdownExt\ExtractedCodeBlocks\FilterBase::addBoilerplate

namespace HHVM\UserDocumentation\Guides\Hack\XHP\Extending\XhpAsync;

use namespace Facebook\XHP\Core as x;

final xhp class ui_get_status extends x\element {

  protected async function renderAsync(): Awaitable<x\node> {
    $ch = \curl_init('https://status.fb.com/graph-api');
    \curl_setopt($ch, \CURLOPT_USERAGENT, 'hhvm/user-documentation example');
    $status = await \HH\Asio\curl_exec($ch);
    return <x:frag>Status is: {$status}</x:frag>;
  }
}
