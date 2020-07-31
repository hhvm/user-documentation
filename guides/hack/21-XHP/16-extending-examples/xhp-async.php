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

<<__EntryPoint>>
async function extending_examples_async_run(): Awaitable<void> {
  \__init_autoload();
  $status = <ui:get-status />;
  $html = await $status->asyncToString();
  // This can be long, so just show a bit for illustrative purposes
  $sub_status = substr($html, 0, 100);
  var_dump($sub_status);
}
