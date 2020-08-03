<?hh // partial

class :ui:get-status extends :x:element {

  use XHPAsync;

  protected async function asyncRender(): Awaitable<\XHPRoot> {
    $ch = curl_init('https://developers.facebook.com/status/');
    curl_setopt($ch, CURLOPT_USERAGENT, 'hhvm/user-documentation example');
    $status = await HH\Asio\curl_exec($ch);
    return <x:frag>Status is: {$status}</x:frag>;
  }
}
